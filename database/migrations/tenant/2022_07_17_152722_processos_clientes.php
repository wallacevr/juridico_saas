<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProcessosClientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cliente_processo', function (Blueprint $table) {
         
            $table->unsignedBigInteger('processo_id')->foreignId('processo_id')->references('id')->on('processos');
            $table->unsignedBigInteger('cliente_id')->foreignId('cliente_id')->references('id')->on('clientes');
            $table->unsignedBigInteger('qualificacao_id')->foreignId('qualificacao_id')->references('id')->on('qualificacoes');
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
        Schema::dropIfExists('cliente_processo');
    }
}
