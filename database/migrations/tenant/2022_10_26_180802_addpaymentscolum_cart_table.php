<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddpaymentscolumCartTable extends Migration
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
            $table->string('paymenttype')->nullable();
            $table->string('paymentlink')->nullable();
            $table->string('paymentqrcode')->nullable();

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
            $table->removeColumn('paymenttype')->change();
            $table->removeColumn('paymentlink')->change();
            $table->removeColumn('paymentqrcode')->change();
        });
    }
}
