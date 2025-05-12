<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupermarketStockTable extends Migration
{
    public function up()
    {
        Schema::create('supermarket_stock', function (Blueprint $table) {
            $table->id();
            $table->string('item_name');
            $table->integer('quantity');
            $table->decimal('supermarket_purchase_price', 10, 2);
            $table->decimal('loyalty_value', 10, 2);
            $table->unsignedBigInteger('branch_id');
            $table->string('barcode_number')->default('N/A')->nullable(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('supermarket_stock');
    }
}
