<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupermaketStock extends Model
{
    use HasFactory;

    protected $table = 'supermarket_stock';

    protected $fillable = [
        'barcode_number',
        'item_name',
        'quantity',
        'date',
        'time',
        'supermarket_purchase_price',
        'loyalty_value',
        'highest_range',
        'lowest_range',
        'branch_id',
    ];
}
