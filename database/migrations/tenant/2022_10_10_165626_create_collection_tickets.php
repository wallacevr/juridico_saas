<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollectionTickets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collection_tickets', function (Blueprint $table) {
            $table->id();
            //Relacionamento tabela cupons (foreign key)
            $table->unsignedBigInteger('id_ticket')->nullable()->foreign('id_ticket')
            ->references('id')
            ->on('tickets');
            //Relacionamento tabela categorias (foreign key)
            $table->unsignedBigInteger('id_collection')->foreign('id_collection')
            ->references('id')
                ->on('collections');    
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
        Schema::dropIfExists('collection_tickets');
    }
}
