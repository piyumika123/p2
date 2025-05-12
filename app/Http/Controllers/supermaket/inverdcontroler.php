<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use Illuminate\Support\Facades\Log;

class itemController extends Controller
{
    // ...existing code...

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

    // ...existing code...
}
