<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema; // Add this import
use Illuminate\Database\Schema\Blueprint; // Add this import
use App\Models\AllItem; // Add this import
use App\Models\Stock; // Add this import

class SupermarketController extends Controller
{
    public function __construct()
    {
        // Ensure the 'subtotal' column exists in the 'all_items' table
        if (!Schema::hasColumn('all_items', 'subtotal')) {
            Schema::table('all_items', function (Blueprint $table) {
                $table->decimal('subtotal', 10, 2)->after('total')->nullable();
            });
        }

        // Ensure the 'superinvoice' table exists
        if (!Schema::hasTable('superinvoice')) {
            Schema::create('superinvoice', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('branch_id');
                $table->string('barcode_number');
                $table->string('invoice');
                $table->string('item_name');
                $table->integer('quantity');
                $table->decimal('supermarket_purchase_price', 10, 2);
                $table->string('phone_number');
                $table->decimal('loyalty_value', 10, 2)->nullable();
                $table->decimal('subtotal', 10, 2);
                $table->decimal('total', 10, 2);
                $table->timestamps();
            });
        }
    }

    public function showSaleForm()
    {
        $branchId = auth()->user()->id;
        $items = AllItem::where('branch_id', $branchId)->get();

        // Calculate total of all subtotals
        $totalValue = $items->sum('subtotal');

        return view('auth.supermaket.sale', compact('branchId', 'items', 'totalValue'));
    }

    public function getItemName(Request $request)
    {
        $barcode_number = $request->query('barcode_number');
        $branchId = $request->query('branch_id');

        \Log::info("Fetching item for barcode: $barcode_number and branch_id: $branchId");

        if (!$barcode_number || !$branchId) {
            return response()->json(['success' => false, 'message' => 'Barcode and branch_id are required.'], 400);
        }

        try {
            if (strlen($barcode_number) === 13) {
                $items = DB::table('supermarket_stock')
                    ->select('item_name', 'supermarket_purchase_price', 'loyalty_value')
                    ->where('branch_id', $branchId)
                    ->where('barcode_number', $barcode_number)
                    ->orderBy('item_name', 'ASC')
                    ->get();

                if ($items->isNotEmpty()) {
                    return response()->json(['success' => true, 'items' => $items]);
                }
                return response()->json(['success' => false, 'message' => 'No items found.'], 404);
            }

            $item = DB::table('supermarket_stock')
                ->select('item_name', 'supermarket_purchase_price', 'loyalty_value')
                ->where('barcode_number', $barcode_number)
                ->where('branch_id', $branchId)
                ->orderBy('item_name', 'ASC')
                ->first();

            if ($item) {
                return response()->json([
                    'success' => true,
                    'item' => $item
                ]);
            }

            return response()->json(['success' => false, 'message' => 'Item not found.'], 404);
        } catch (\Exception $e) {
            \Log::error("Fetch error: " . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Server error.'], 500);
        }
    }

    public function addItem(Request $request)
    {
        $validated = $request->validate([
            'barcode_number' => 'required|string|max:255',
            'invoice' => 'required|string|max:255',
            'item_name' => 'required|string|max:255',
            'quantity' => 'required|integer',
            'supermarket_purchase_price' => 'required|numeric',
            'phone_number' => 'required|string|max:20',
            'loyalty_value' => 'nullable|numeric',
            'total' => 'required|numeric',
            'branch_id' => 'required|integer',
        ]);

        try {
            // Calculate subtotal
            $validated['subtotal'] = $validated['quantity'] * $validated['supermarket_purchase_price'];

            AllItem::create($validated);
            return redirect()->back()->with('success', 'Item added successfully.');
        } catch (\Exception $e) {
            \Log::error("Error adding item: " . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to add item.');
        }
    }

    public function addStock(Request $request)
    {
        $validatedData = $request->validate([
            'barcode_number' => 'required|string',
            'invoice' => 'required|string',
            'item_name' => 'required|string',
            'quantity' => 'required|integer',
            'supermarket_purchase_price' => 'required|numeric',
            'phone_number' => 'required|numeric',
            'loyalty_value' => 'required|numeric',
            'total' => 'required|numeric',
            'branch_id' => 'required|integer',
        ]);

        // Save data to the database
        Stock::create($validatedData);

        return redirect()->back()->with('success', 'Stock added successfully!');
    }

    public function getall_items()
    {
        $items = AllItem::all(); // Fetch all records from the all_items table
        return view('auth.supermaket.all_items', compact('items')); // Pass data to the view
    }

    public function printBill(Request $request)
    {
        $branchId = auth()->user()->id;

        // Fetch all items for the branch
        $items = AllItem::where('branch_id', $branchId)->get();

        if ($items->isEmpty()) {
            return redirect()->back()->with('error', 'No items to generate a bill.');
        }

        DB::beginTransaction();
        try {
            // Generate the next invoice number
            $lastInvoice = DB::table('superinvoice')
                ->where('branch_id', $branchId)
                ->orderBy('id', 'desc')
                ->value('invoice');

            $nextInvoiceNumber = $lastInvoice ? intval(substr($lastInvoice, strlen($branchId))) + 1 : 1;
            $invoiceNumber = $branchId . $nextInvoiceNumber;

            // Save all items to the superinvoice table with the generated invoice number
            foreach ($items as $item) {
                DB::table('superinvoice')->insert([
                    'branch_id' => $item->branch_id,
                    'barcode_number' => $item->barcode_number,
                    'invoice' => $invoiceNumber, // Use the generated invoice number
                    'item_name' => $item->item_name,
                    'quantity' => $item->quantity,
                    'supermarket_purchase_price' => $item->supermarket_purchase_price,
                    'phone_number' => $item->phone_number,
                    'loyalty_value' => $item->loyalty_value,
                    'subtotal' => $item->subtotal,
                    'total' => $item->total,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // Reduce quantity in supermarket_stock table
                DB::table('supermarket_stock')
                    ->where('branch_id', $branchId)
                    ->where('barcode_number', $item->barcode_number)
                    ->decrement('quantity', $item->quantity);
            }

            // Clear all items from the AllItem table for the branch
            AllItem::where('branch_id', $branchId)->delete();

            DB::commit();
            return redirect()->back()->with('success', 'Bill generated, stock updated, and items saved to superinvoice.');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error("Error generating bill: " . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to generate bill.');
        }
    }
}
