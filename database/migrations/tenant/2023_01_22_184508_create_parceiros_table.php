<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParceirosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parceiros', function (Blueprint $table) {
            $table->id();
            $table->integer('tppessoa');
            $table->integer('tpparceiro');
            $table->string('cpfcnpj');
            $table->string('nome');
            $table->string('apelido')->nullable();
            $table->string('rg')->nullable();
            $table->string('emissorrg')->nullable();
            $table->string('ufrg')->nullable();
            $table->string('genero',1)->nullable();
            $table->date('dtnascimento')->nullable();
            $table->integer('situacaoie')->nullable();
            $table->string('ie')->nullable();
            $table->string('im')->nullable();
            $table->string('emailnfe')->nullable();
            $table->string('obs')->nullable();
            $table->boolean('issretido');
            $table->boolean('consumidorfinal');
            $table->boolean('produtorrural');
            $table->boolean('ativo');
            $table->unsignedBigInteger('id_listapreco');
            $table->foreign('id_listapreco')->references('id')->on('listaprecos')->onUpdate('cascade')->onDelete('cascade')->nullable();
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
        Schema::dropIfExists('parceiros');
    }
}
