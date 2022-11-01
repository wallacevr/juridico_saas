<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddcollumnProductOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_options', function (Blueprint $table) {
            $table->integer('nivel');
            //$table->renameColumn('id_potions','id_options');
            $table->integer('qty_stock')->nullable()->change();
            $table->decimal('price')->nullable()->change();
        });
   
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
     
        Schema::table('product_options', function (Blueprint $table) {
            $table->removeColumn('nivel_id')->change();
        });
    }
}
