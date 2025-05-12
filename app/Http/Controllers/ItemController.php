<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item; // Add this line to import the Item model
use Illuminate\Support\Facades\Log;

class ItemController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'item_name' => 'required|string|max:255',
            'quantity' => 'required|integer',
            'selling_price' => 'required|numeric',
            'purchase_price' => 'required|numeric',
            'supermarket_purchase_price' => 'required|numeric',
            'highest_range' => 'required|integer',
            'lowest_range' => 'required|integer',
            'loyalty_value' => 'required|numeric',
            'barcode_number' => 'required|string|max:255',
        ]);

        // Store the item in the database
        Item::create($request->all());

        // Redirect back with a success message
        return redirect()->route('item.registration')->with('success', 'Item registered successfully.');
    }

    public function add(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'item_name' => 'required|string|max:255',
            'quantity' => 'required|integer',
            'new_quantity' => 'required|integer',
            'selling_price' => 'required|numeric',
            'purchase_price' => 'required|numeric',
            'supermarket_purchase_price' => 'required|numeric',
            'highest_range' => 'required|integer',
            'lowest_range' => 'required|integer',
            'loyalty_value' => 'required|numeric',
            'barcode_number' => 'required|string|max:255',
        ]);

        // Find the item by barcode number
        $item = Item::where('barcode_number', $request->barcode_number)->first();

        if ($item) {
            // Check if the new quantity exceeds the highest range
            if ($item->quantity + $request->new_quantity > $item->highest_range) {
                return redirect()->route('stock.add')->with('danger', 'The total quantity exceeds the highest range! ');
            }

            // Update the quantity
            $item->quantity += $request->new_quantity;
            $item->save();
        } else {
            // If item does not exist, create a new one
            Item::create($validatedData);
        }

        // Redirect back with a success message
        return redirect()->route('stock.add')->with('success', 'Stock added successfully.');
    }

    public function live(Request $request)
    {
        // Handle the form submission for live stock
    }

    public function wastage(Request $request)
    {
        // Handle the form submission for wastage stock
    }

    public function searchItem(Request $request)
    {
        $barcode = $request->query('barcode');
        Log::info('Searching for item with barcode: ' . $barcode);

        try {
            $item = Item::where('barcode_number', $barcode)->first();

            if ($item) {
                Log::info('Item found: ' . $item->item_name);
                return response()->json([
                    'item_name' => $item->item_name,
                    'quantity' => $item->quantity,
                    'selling_price' => $item->selling_price,
                    'purchase_price' => $item->purchase_price,
                    'supermarket_purchase_price' => $item->supermarket_purchase_price,
                    'highest_range' => $item->highest_range,
                    'lowest_range' => $item->lowest_range,
                    'loyalty_value' => $item->loyalty_value
                ]);
            } else {
                Log::info('No item found for barcode: ' . $barcode);
                return response()->json(['item_name' => null]);
            }
        } catch (\Exception $e) {
            Log::error('Error searching for item: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error: ' . $e->getMessage()], 500);
        }
    }

    public function addSoup(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'item_name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'selling_price' => 'required|numeric|min:0',
            'purchase_price' => 'required|numeric|min:0',
            'supermarket_purchase_price' => 'required|numeric|min:0',
            'highest_range' => 'required|numeric|min:0',
            'lowest_range' => 'required|numeric|min:0',
            'loyalty_value' => 'required|numeric|min:0',
            'barcode_number' => 'required|string|max:255',
        ]);

        // Example logic to handle the data (e.g., save to the database)
        // Replace this with your actual implementation
        // \App\Models\Item::create($validatedData);

        return response()->json(['message' => 'Soup item added successfully!'], 201);
    }
}
