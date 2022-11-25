<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
      
class CreateTableOrderProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_order');
            $table->unsignedBigInteger('id_product')->nullable();
            $table->decimal('quantity',12,4);
            $table->decimal('price',12,4);
            $table->decimal('base',12,4);
            $table->decimal('discount_amount',12,4);
            $table->decimal('discount_percent',12,4);
            $table->timestamps();
            $table->foreign('id_order')->references('id')->on('orders')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_product')->references('id')->on('products')->onUpdate('set null')->onDelete('set null');
            $table->foreignId('product_options_id')->nullable();
            $table->foreign('product_options_id')->references('id')->on('product_options')->onUpdate('cascade')->onDelete('cascade');
         
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_products');
    }
}
