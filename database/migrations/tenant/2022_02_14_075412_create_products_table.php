<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name',255);
            $table->string('sku',255);
            $table->string('barcode',100)->nullable();
            $table->string('slug')->unique();

            $table->longText('description')->nullable();

            

            $table->float('price');
            $table->float('special_price')->nullable();
            $table->float('cost')->nullable();

            $table->float('weight')->nullable();
            $table->float('width')->nullable();
            $table->float('height')->nullable();
            $table->float('depth')->nullable();

            $table->boolean('status')->default(false);

            $table->integer('posting_time')->default(5)->nullable()->comment("deadline for posting");

            $table->boolean('manage_stock')->default(true);
            $table->integer('min_qty')->default(1);
            $table->integer('max_qty')->default(0);
            $table->integer('qty')->default(0);

            $table->boolean('is_virtual')->default(false);
            $table->boolean('is_featured')->default(0)->nullable();



            $table->string('meta_title')->nullable();;
            $table->text('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();

            $table->tinyInteger('sort')->default(1);

            $table->unsignedBigInteger('brand_id')->nullable();
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('SET NULL');
            
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
        Schema::dropIfExists('products');
    }
}
