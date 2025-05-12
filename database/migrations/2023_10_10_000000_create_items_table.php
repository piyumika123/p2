<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('item_name');
            $table->integer('quantity');
            $table->decimal('selling_price', 8, 2);
            $table->decimal('purchase_price', 8, 2);
            $table->decimal('supermarket_purchase_price', 8, 2);
            $table->integer('highest_range');
            $table->integer('lowest_range');
            $table->decimal('loyalty_value', 8, 2);
            $table->string('barcode_number');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('items');
    }
}
