<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class GoodsInwardController extends Controller
{
    public function index()
    {
        $items = Item::with('goods_billing')->get();
        return view('auth.supermaket.goods_inward', compact('items'));
    }

    public function store(Request $request)
    {
        // Handle the form submission logic here
        // ...

        return redirect()->route('goods.inward');
    }
}
