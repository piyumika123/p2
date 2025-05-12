<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_name',
        'quantity',
        'selling_price',
        'purchase_price',
        'supermarket_purchase_price',
        'highest_range',
        'lowest_range',
        'loyalty_value',
        'barcode_number',
    ];

    public function goods_billing()
    {
        return $this->hasOne(GoodsBilling::class, 'barcode_number', 'barcode_number');
    }
}
