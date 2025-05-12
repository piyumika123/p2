<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SupermarketStock;

class SupermarketStockController extends Controller
{
    public function checkStock(Request $request)
    {
        $stock = \DB::table('supermarket_stock')
            ->where('barcode_number', $request->barcode_number)
            ->where('branch_id', $request->branch_id)
            ->first();

        if ($stock) {
            return response()->json(['stock' => $stock]);
        } else {
            return response()->json(['message' => 'Stock not found'], 404);
        }
    }

    public function addStock(Request $request)
    {
        SupermarketStock::create([
            'barcode_number' => $request->barcode_number, // Ensure this is provided
            'item_name' => $request->item_name,
            'quantity' => $request->quantity,
            'supermarket_purchase_price' => $request->supermarket_purchase_price,
            'loyalty_value' => $request->loyalty_value,
            'branch_id' => $request->branch_id,
        ]);

        return response()->json(['message' => 'Stock added successfully']);
    }
}