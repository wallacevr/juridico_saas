<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProcPincipalProcessos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('processos', function (Blueprint $table) {
            $table->unsignedBigInteger('principal_recurso_id')->foreignId('principal_recurso_id')->references('id')->on('processos')->nullable();
            $table->unsignedBigInteger('principal_desdobramento_id')->foreignId('principal_desdobramento_id')->references('id')->on('processos')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('processos', function (Blueprint $table) {
            $table->dropColumn('principal_recurso_id');
            $table->dropColumn('principal_desdobramento_id');
        });
    }
}
