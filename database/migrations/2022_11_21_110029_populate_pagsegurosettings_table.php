<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PopulatePagseguroSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        DB::table('plugins')->insert(
            array(
                'name' => 'PagSeguro',
                'description' => 'Plugin for payments using Pagseguro',
                'active'=>1,
                'image'=> 'vendor/pagseguro/img/pagseguro.png',
                'settingsroute'=>'/admin/plugins/pagseguro/setconfig',
                'mainroute'=>'#',
                'plugin_group_id'=>1
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
