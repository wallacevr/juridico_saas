<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CustomerGroupProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_customers_groups', function (Blueprint $table) {
            $table->id();
            $table->integer('qty');
            $table->decimal('price');

            $table->foreignId('id_customer_group');
            $table->foreign('id_customer_group')->references('id')->on('customers_group')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('id_product');
            $table->foreign('id_product')->references('id')->on('products')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('product_customers_groups');
    }
}
