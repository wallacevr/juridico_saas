<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('options', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->unsignedBigInteger('variation_id');
            $table->string('value');
            $table->enum('type', ['NONE', 'IMAGE', 'COLOR'])->default('NONE');
            $table->integer('order');

            $table->foreign('variation_id')->references('id')->on('variations')->onDelete('cascade');
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
        Schema::dropIfExists('options');
    }
}
