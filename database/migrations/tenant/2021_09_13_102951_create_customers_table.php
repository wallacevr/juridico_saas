<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('telephone')->nullable();
            $table->date('dob')->default(null)->nullable();
            $table->string('taxvat')->unique()->nullable();
            $table->string('ip')->nullable();
            $table->boolean('status');
            $table->boolean('newsletter');
            $table->boolean('accepts_terms_of_use');
            $table->timestamp('email_verified_at')->nullable();

            $table->integer('failures_num')->default(0);
            $table->date('first_failure')->nullable();

            $table->string('password');
            $table->rememberToken();

            $table->foreignId('group_id')->nullable();
            $table->foreign('group_id')->references('id')->on('customers_group')->onUpdate('cascade')->onDelete('cascade');

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
        Schema::dropIfExists('customers');
    }
}
