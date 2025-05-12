<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\GoodsBilling;
use App\Models\SupermarketStock; // Corrected model name
use Illuminate\Support\Facades\Auth;

class SupermarketStockController extends Controller // Renamed class
{
    public function liveStock(Request $request)
    {
        if ($request->isMethod('get')) {
            $userId = Auth::user()->id;
            $barcodeNumber = $request->input('barcode_number');

            $query = SupermarketStock::where('branch_id', $userId) // Updated model reference
                ->select('item_name', 'quantity', 'supermarket_purchase_price', 'loyalty_value');

            if ($barcodeNumber) {
                $query->where('barcode_number', $barcodeNumber)
                      ->orderBy('branch_id');
            }

            $liveStock = $query->get();

            return view('auth.supermaket.live_stock', compact('liveStock'));
        }
    }

    public function goodsInward()
    {
        $userId = Auth::user()->id;
        $items = GoodsBilling::where('branch_id', $userId)
            ->with('item')
            ->orderBy('branch_id') // Ensure items are ordered by branch_id
            ->get();

        // Debugging statement
        if ($items->isEmpty()) {
            \Log::info('No items found for branch_id: ' . $userId);
        } else {
            \Log::info('Items found: ' . $items->count());
        }

        return view('auth.supermaket.goods_inward', compact('items', 'userId'));
    }

    public function store(Request $request)
    {
        $branchId = $request->input('branch_id');
        $selectedItems = $request->input('selected_items', []);
        $barcodeNumber = $request->input('selected_items')[0] ?? 'N/A';

        foreach ($selectedItems as $barcodeNumber) {
            $goodsBilling = GoodsBilling::where('barcode_number', $barcodeNumber)
                ->where('branch_id', $branchId)
                ->with('item') // Ensure item relationship is loaded
                ->first();

            if ($goodsBilling) {
                $item = Item::where('barcode_number', $barcodeNumber)->first();

                // Check if the item already exists in the SupermarketStock table
                $existingStock = SupermarketStock::where('barcode_number', $barcodeNumber) // Updated model reference
                    ->where('branch_id', $branchId)
                    ->first();

                if ($existingStock) {
                    // Update the quantity if the item already exists
                    $existingStock->quantity += $goodsBilling->quantity;
                    $existingStock->save();
                } else {
                    // Create a new entry if the item does not exist
                    SupermarketStock::create([ // Updated model reference
                        'barcode_number' => $goodsBilling->barcode_number,
                        'item_name' => $goodsBilling->item ? $goodsBilling->item->item_name : ($item ? $item->item_name : 'N/A'),
                        'quantity' => $goodsBilling->quantity,
                        'date' => $goodsBilling->date,
                        'time' => $goodsBilling->time,
                        'supermarket_purchase_price' => $item ? $item->supermarket_purchase_price : 0,
                        'loyalty_value' => $item ? $item->loyalty_value : 0,
                        'highest_range' => $item ? $item->highest_range : 0,
                        'lowest_range' => $item ? $item->lowest_range : 0,
                        'branch_id' => $branchId, // Ensure branch_id is included
                    ]);
                }

                // Remove the item from goods_billing table
                $goodsBilling->delete();
            }
        }

        SupermarketStock::create([
            'item_name' => '50g biscutte',
            'quantity' => 250,
            'supermarket_purchase_price' => 250.00,
            'loyalty_value' => 0.70,
            'branch_id' => $request->branch_id,
            'barcode_number' => $barcodeNumber,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('supermarket.goods_inward')->with('success', 'Items added to supermarket stock successfully.');
    }
}
