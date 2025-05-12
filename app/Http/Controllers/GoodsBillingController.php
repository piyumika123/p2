<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GoodsBilling;
use App\Models\Item;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class GoodsBillingController extends Controller
{
    public function index()
    {
        return view('auth.store.goods_billing');
    }

    public function store(Request $request)
    {
        Log::info('GoodsBillingController@store - Request data: ', $request->all());

        $request->validate([
            'barcode_number' => 'required|string',
            'branch' => 'required|exists:users,id',
            'quantity' => 'required|integer',
        ]);

        try {
            $item = Item::where('barcode_number', $request->barcode_number)->first();

            if ($item) {
                if ($item->quantity < $request->quantity) {
                    Log::warning('Not enough stock available for item: ' . $request->barcode_number);
                    return redirect()->back()->with('error', 'Not enough stock available.');
                }

                $item->quantity -= $request->quantity;
                $item->save();

                GoodsBilling::create([
                    'barcode_number' => $request->barcode_number,
                    'branch_id' => $request->branch,
                    'quantity' => $request->quantity,
                    'date' => Carbon::now()->toDateString(),
                    'time' => Carbon::now()->toTimeString(),
                ]);

                Log::info('Goods billing data added successfully for item: ' . $request->barcode_number);
                return redirect()->back()->with('success', 'Goods billing data added successfully.');
            } else {
                Log::error('Item not found: ' . $request->barcode_number);
                return redirect()->back()->with('error', 'Item not found.');
            }
        } catch (\Exception $e) {
            Log::error('Error adding goods billing data: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while adding goods billing data.');
        }
    }
}
