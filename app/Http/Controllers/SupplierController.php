<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'supplier_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'company' => 'required|string|max:255',
            'item' => 'required|string|max:255',
        ]);

        // Store the supplier in the database
        Supplier::create($request->all());

        // Redirect back with a success message
        return redirect()->route('supplier.registration')->with('success', 'Supplier registered successfully.');
    }
}
