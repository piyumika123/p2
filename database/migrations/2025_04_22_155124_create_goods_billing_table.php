<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGoodsBillingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods_billing', function (Blueprint $table) {
            $table->id();
            $table->string('barcode_number');
            $table->unsignedBigInteger('branch_id');
            $table->integer('quantity');
            $table->date('date');
            $table->time('time');
            $table->timestamps();

            $table->foreign('branch_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('goods_billing');
    }
}