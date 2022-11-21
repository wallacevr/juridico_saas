<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PopulateMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        DB::table('menus')->insert(
            array(
                'title' => 'Menu Inicial',
                'slug' => 'menu-inicial',
                'is_parent'=>1,
                'url'=> '#|page',
                'status'=>1,
                'sort'=>0
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
