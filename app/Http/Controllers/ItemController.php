<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item; // Add this line to import the Item model

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
}
