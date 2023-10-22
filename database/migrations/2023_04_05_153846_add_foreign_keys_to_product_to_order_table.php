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
        // Schema::table('product_to_order', function (Blueprint $table) {
        //     $table->foreign(['Popping_Id'], 'Popping')->references(['Id'])->on('popping');
        //     $table->foreign(['Order_Id'], 'Order')->references(['Id'])->on('order');
        //     $table->foreign(['Product_Id'], 'Product')->references(['Id'])->on('product');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('product_to_order', function (Blueprint $table) {
        //     $table->dropForeign('Popping');
        //     $table->dropForeign('Order');
        //     $table->dropForeign('Product');
        // });
    }
};
