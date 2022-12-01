<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddcollumOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedBigInteger('id_ticket')->nullable();
            $table->foreign('id_ticket')->references('id')->on('tickets')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('id_cart');
            $table->foreign('id_cart')->references('id')->on('carts')->onUpdate('cascade')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->removeColumn('id_ticket')->change();
            $table->removeColumn('id_cart')->change();
       
        });
    }
}
