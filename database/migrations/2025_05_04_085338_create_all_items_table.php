<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('all_items', function (Blueprint $table) {
            $table->id();
            $table->string('barcode_number');
            $table->string('invoice');
            $table->string('item_name');
            $table->integer('quantity');
            $table->decimal('supermarket_purchase_price', 10, 2);
            $table->string('phone_number');
            $table->decimal('loyalty_value', 10, 2)->nullable();
            $table->decimal('total', 10, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('all_items');
    }
};
