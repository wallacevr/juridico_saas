<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('centro_custos_id')->foreignId('centro_custos_id')->references('id')->on('centro_custos_id');
            $table->unsignedBigInteger('tipo_contas_id')->foreignId('tipo_contas_id')->references('id')->on('tipo_contas');
            $table->unsignedBigInteger('classificacao_contas_id')->foreignId('classificacao_contas_id')->references('id')->on('classificacao_contas');
            $table->unsignedBigInteger('processos_id')->foreignId('processos_id')->references('id')->on('processos')->nullable();
            $table->unsignedBigInteger('clientes_id')->foreignId('clientes_id')->references('id')->on('clientes')->nullable();
            $table->unsignedBigInteger('fornecedores_id')->foreignId('fornecedores_id')->references('id')->on('fornecedores')->nullable();
            $table->unsignedBigInteger('user_id')->foreignId('user_id')->references('id')->on('users')->nullable();
            $table->unsignedBigInteger('classe_id')->foreignId('classe_id')->references('id')->on('classes');
      
            $table->date('vencimento')->nullable();
            $table->date('pagamento')->nullable();
            $table->string('descricao');
            $table->decimal('valor');
            $table->boolean('repete');
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
        Schema::dropIfExists('contas');
    }
}
