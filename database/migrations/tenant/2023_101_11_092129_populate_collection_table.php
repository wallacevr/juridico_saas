<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
class PopulateCollectionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
        Storage::disk('publictenant')->copy("images/collections/verao.jpg",  tenant('id') . '/images/collections/verao.jpg' );
        Storage::disk('publictenant')->copy("images/collections/inverno.jpg",  tenant('id') . '/images/collections/inverno.jpg' );
        DB::table('collections')->insert(
            array(
                ['name' => 'Inverno',
                'description' => '<p>Os melhores produtos da Moda inverno</p>',
                'image_url'=>'inverno.jpg',
                'status'=> 1,
                'page_title'=>'Inverno',
                'seo_description'=>'Inverno',
                'slug'=>'inverno'],
                ['name' => 'verão',
                'description' => '<p>Os melhores produtos da Moda verão</p>',
                'image_url'=>'verao.png',
                'status'=> 1,
                'page_title'=>'Verão',
                'seo_description'=>'Verão',
                'slug'=>'Verão']
            )
        );
        */
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
