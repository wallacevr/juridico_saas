<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableCarts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('id_carrier');
            $table->unsignedBigInteger('id_address_delivery');
            $table->unsignedBigInteger('id_address_invoice');
            $table->unsignedBigInteger('id_currency');
            $table->unsignedBigInteger('id_customer');
            $table->unsignedBigInteger('secure_key');
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
        Schema::dropIfExists('carts');
    }
}
