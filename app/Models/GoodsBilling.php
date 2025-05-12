<?php namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoodsBilling extends Model
{
    use HasFactory;

    protected $table = 'goods_billing';

    protected $fillable = [
        'barcode_number',
        'branch_id',
        'quantity',
        'date',
        'time',
        'item_id',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
}
