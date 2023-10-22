<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_to_order', function (Blueprint $table) {
            $table->integer('Id', true);
            $table->integer('Product_Id');
            $table->integer('Order_Id');
            $table->integer('Popping_Id');
            $table->integer('Qty');
            $table->integer('Sugar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_to_order');
    }
};
