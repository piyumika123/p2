<?php namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'barcode_number',
        'invoice',
        'item_name',
        'quantity',
        'supermarket_purchase_price',
        'phone_number',
        'loyalty_value',
        'total',
        'branch_id',
        'subtotal', // Added subtotal
    ];
}

