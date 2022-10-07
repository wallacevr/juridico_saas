<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductOptionsImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_options_images', function (Blueprint $table) {
            $table->id();
            $table->string('image_url',255);
            $table->string('title',255)->nullable();
            $table->integer('sort')->default(1);
            $table->timestamps();
            $table->foreignId('product_options_id');
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
        Schema::dropIfExists('product_options_images');
    }
}
