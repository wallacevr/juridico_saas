<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFornecedores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fornecedores', function (Blueprint $table) {
            $table->id();
        
           
                $table->string('nome');
                $table->string('nomefantasia')->nullable();
                $table->string('telefone')->nullable();
                $table->string('email')->nullable();  
                $table->string('site')->nullable();
                $table->string('cep')->nullable();
                $table->string('municipio')->nullable();
                $table->string('uf')->nullable();
                $table->string('logradouro')->nullable();
                $table->string('num')->nullable();
                $table->string('complemento')->nullable();
                $table->string('bairro')->nullable();
              
                $table->unsignedBigInteger('tpconta_id')->nullable();
                $table->string('banco')->nullable();
                $table->string('agencia')->nullable();
                $table->string('conta')->nullable();
                $table->string('pix')->nullable();
                $table->string('cpf')->nullable();
                $table->string('rg')->nullable();
                $table->string('ctps')->nullable();
                $table->string('pis')->nullable();

                $table->string('cnpj')->nullable();
                $table->string('ie')->nullable();
                $table->string('ccm')->nullable();

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
        Schema::dropIfExists('fornecedores');
    }
}
