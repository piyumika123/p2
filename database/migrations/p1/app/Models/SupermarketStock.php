<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupermarketStock extends Model
{
    use HasFactory;

    protected $table = 'supermarket_stock';

    protected $fillable = [
        'item_name',
        'quantity',
        'supermarket_purchase_price',
        'loyalty_value',
        'branch_id'
    ];
}