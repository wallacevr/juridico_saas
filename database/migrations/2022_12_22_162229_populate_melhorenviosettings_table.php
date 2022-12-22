<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PopulateMelhorenvioSettingsTable extends Migration
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
                'name' => 'Melhor Envio',
                'description' => 'Plugin for shipping using Melhor Envio',
                'active'=>1,
                'image'=> 'vendor/melhorenvio/img/melhorenvio.png',
                'settingsroute'=>'/admin/plugins/melhorenvio/setconfig',
                'mainroute'=>'#',
                'plugin_group_id'=>2
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
