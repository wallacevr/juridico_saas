<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PopulateWhatsappCheckoutSettingsTable extends Migration
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
                'name' => 'Whatsapp Checkout',
                'description' => 'Plugin for Customer to send order to store by whatsapp',
                'active'=>1,
                'image'=> '/img/whatsapp.png',
                'settingsroute'=>'/admin/plugins/whatsappcheckout/setconfig',
                'mainroute'=>'#',
                'plugin_group_id'=>3
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
