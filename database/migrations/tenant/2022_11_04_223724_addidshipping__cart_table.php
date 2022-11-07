<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddidshippingCartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('carts', function (Blueprint $table) {
       
            $table->unsignedBigInteger('id_shipping')->nullable();
            $table->decimal('price_shipping')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('carts', function (Blueprint $table) {
      
            $table->removeColumn('id_shipping')->change();
            $table->removeColumn('price_shipping')->change();
        });
    }
}
