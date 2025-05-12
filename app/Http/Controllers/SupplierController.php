<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use Illuminate\Support\Facades\Mail;
use App\Mail\SupplierRegistered;
use Illuminate\Support\Facades\Log;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::all();
        return view('suppliers.index', compact('suppliers'));
    }

    public function store(Request $request)
    {
        // Increase the maximum execution time
        set_time_limit(60);

        $validatedData = $request->validate([
            'supplier_name' => 'required|string|max:255',
            'item' => 'required|string|max:255',
            'phone_number' => 'required|regex:/[0-9]{10}/',
            'email' => 'required|email|max:255',
            'company' => 'required|string|max:255',
        ]);

        // Ensure all required fields are present
        $supplierName = $validatedData['supplier_name'] ?? null;
        $item = $validatedData['item'] ?? null;
        $phoneNumber = $validatedData['phone_number'] ?? null;
        $email = $validatedData['email'] ?? null;
        $company = $validatedData['company'] ?? null;

        if (is_null($supplierName) || is_null($item) || is_null($phoneNumber) || is_null($email) || is_null($company)) {
            return redirect()->back()->withErrors('All fields are required.');
        }

        // Proceed with storing the supplier
        $supplier = Supplier::create([
            'supplier_name' => $supplierName,
            'item' => $item,
            'phone_number' => $phoneNumber,
            'email' => $email,
            'company' => $company,
        ]);

        try {
            // Send email to the supplier
            Mail::to($email)->send(new SupplierRegistered($supplier));
        } catch (\Exception $e) {
            Log::error('Failed to send email: ' . $e->getMessage());
            return redirect()->route('suppliers.index')->with('error', 'Supplier created, but failed to send email.');
        }

        // Redirect back with a success message
        return redirect()->route('suppliers.index')->with('success', 'Supplier created successfully.');
    }

    public function sendEmail(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email|max:255',
        ]);

        $email = $validatedData['email'];

        Log::info('Attempting to send email to: ' . $email);

        try {
            Mail::to($email)->send(new SupplierRegistered());
            Log::info('Email sent successfully to: ' . $email);
            return response()->json(['message' => 'Email sent successfully.']);
        } catch (\Exception $e) {
            Log::error('Failed to send email: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to send email.'], 500);
        }
    }

    public function searchSupplier(Request $request)
    {
        $barcode = $request->query('barcode');
        Log::info('Searching for supplier with barcode: ' . $barcode);

        try {
            $supplier = Supplier::where('item', $barcode)->first();

            if ($supplier) {
                Log::info('Supplier found: ' . $supplier->supplier_name);
                return response()->json(['supplier_name' => $supplier->supplier_name]);
            } else {
                Log::info('No supplier found for barcode: ' . $barcode);
                return response()->json(['supplier_name' => null]);
            }
        } catch (\Exception $e) {
            Log::error('Error searching for supplier: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            return response()->json(['error' => 'Internal Server Error: ' . $e->getMessage()], 500);
        }
    }
}
