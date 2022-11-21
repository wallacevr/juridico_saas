<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PopulatePluginsGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        DB::table('plugins_group')->insert(
            array(
                'name' => 'Payments',
                'description' => 'Plugins  for payments',
   
            )
        );
        DB::table('plugins_group')->insert(
            array(
                'name' => 'Shipping',
                'description' => 'Plugins  for shippings',
   
            )
        );
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
