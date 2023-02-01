<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProcessosEnvolvidos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('envolvidos_processos', function (Blueprint $table) {
         
            $table->unsignedBigInteger('processo_id')->foreignId('processo_id')->references('id')->on('processos');
            $table->unsignedBigInteger('envolvido_id')->foreignId('envolvido_id')->references('id')->on('envolvidos');
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
        Schema::dropIfExists('envolvidos_processos');
    }
}
