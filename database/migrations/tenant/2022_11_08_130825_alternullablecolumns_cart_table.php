<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlternullablecolumnsCartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::table('carts', function (Blueprint $table) {
            $table->unsignedBigInteger('id_customer')->nullable()->change();
            $table->unsignedBigInteger('id_address_delivery')->nullable()->change();
            $table->unsignedBigInteger('id_address_invoice')->nullable()->change();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
