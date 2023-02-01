<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Processos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('processos', function (Blueprint $table) {
            $table->id();
          
            $table->string('nome');
            $table->string('titulo');
            $table->unsignedBigInteger('instancia_id')->foreignId('instancia_id')->references('id')->on('instancias')->nullable();
            $table->string('numero')->nullable();
            $table->string('juizo')->nullable();
        
            $table->unsignedBigInteger('acao_id')->foreignId('acao_id')->references('id')->on('acoes')->nullable();
            $table->unsignedBigInteger('vara_id')->foreignId('vara_id')->references('id')->on('varas')->nullable();
            $table->unsignedBigInteger('foro_id')->foreignId('foro_id')->references('id')->on('foros')->nullable();
            
            $table->string('linktribunal')->nullable();
            $table->string('objeto')->nullable();
            $table->decimal('valorcausa')->nullable();
            $table->date('dtdistribuicao')->nullable();
            $table->decimal('valorcondenacao')->nullable();
            $table->string('observacoes')->nullable();
            $table->decimal('porcentagemhonorarios')->nullable();
            $table->decimal('honorarios')->nullable();
            $table->timestamps();
            $table->softDeletes();
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
