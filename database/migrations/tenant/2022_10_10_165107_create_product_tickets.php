<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTickets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_tickets', function (Blueprint $table) {
            $table->id();
            //Relacionamento tabela cupons (foreign key)
            $table->unsignedBigInteger('id_ticket')->nullable()->foreign('id_ticket')
            ->references('id')
            ->on('tickets');
            //Relacionamento tabela produtos (foreign key)
            $table->unsignedBigInteger('id_product')->foreign('id_product')
            ->references('id')
                ->on('products');    
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
        Schema::dropIfExists('product_tickets');
    }
}
