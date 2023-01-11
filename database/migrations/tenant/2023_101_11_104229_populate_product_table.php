<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
class PopulateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
 
        $collectionId=DB::table('collections')->insertGetId(
            
            ['name' => 'verão',
            'description' => '<p>Os melhores produtos da Moda verão</p>',
            'image_url'=>'verao.png',
            'status'=> 1,
            'page_title'=>'Verão',
            'seo_description'=>'Verão',
            'slug'=>'summer']
       
        );
        Storage::disk('publictenant')->copy("images/collections/verao.png",  tenant('id') . '/images/collections/verao.png' );
        $productId=DB::table('products')->insertGetId(
            
                ['name' => 'Vestido curto um ombro só com brilhos prateado',
                'sku' =>'1',
                'slug'=>'Vestido-curto-um-ombro-só-com-brilhos-prateado',
                'description'=> '<p>O&nbsp;<strong>Vestido curto um ombro s&oacute; com brilhos prateado </strong>&nbsp;&eacute; perfeito para curtir as festas sem passar despercebida. Com modelagem de um ombro s&oacute;, recorte lateral e brilhos por todo vestido,&nbsp;a pe&ccedil;a da match com sand&aacute;lias de salto alto e acess&oacute;rios brilhantes. Aposte!<br />
                <br />
                <strong>Caracter&iacute;sticas:</strong><br />
               
                Poliester 95%; Elastano 5%<br />
                Comprimento curto<br />
                Um ombro s&oacute;<br />
                Recorte lateral<br />
                <br />
                Medidas do modelo: altura: 1,75m; busto: 90cm; cintura: 70cm; quadril: 93cm; modelo est&aacute; vestindo: P<br />
                <br />
                Sin&ocirc;nimo de feminilidade e versatilidade, o&nbsp;<strong>vestido&nbsp;</strong>&eacute; uma pe&ccedil;a curinga e pr&aacute;tica. &Oacute;timo aliado para todos os momentos, sua modelagem pode variar sendo mais ajustada ou mais ampla e seu comprimento pode ser encontrado desde curto at&eacute; longo, favorecendo todos os gostos e adapt&aacute;vel a v&aacute;rios estilos e idades.<br />
                <br />
                Criada pensando no que h&aacute; de mais atual no mundo da moda, a marca&nbsp;<strong>Pool by Riachuelo</strong>&nbsp;re&uacute;ne desde a leveza para os pequenos, at&eacute; a atitude jovem com uma pegada fashionista para o guarda-roupa de quem ama estar sempre por dentro das tend&ecirc;ncias! Trazendo em sua identidade pe&ccedil;as modernas, despojadas, b&aacute;sicas e o bom e velho jeans.<br />
                <br />
                <strong>A cor do produto nas fotos reproduzidas com modelos pode sofrer altera&ccedil;&otilde;es, em decorr&ecirc;ncia do uso do flash.</strong></p>
                ',
                'price'=>99.99,
                'status'=>1,
                'manage_stock'=>0,
                'meta_title'=>'Vestido curto um ombro só com brilhos prateado',
                'meta_description'=> '<p>O&nbsp;<strong>Vestido curto um ombro s&oacute; com brilhos prateado </strong>&nbsp;&eacute; perfeito para curtir as festas sem passar despercebida. Com modelagem de um ombro s&oacute;, recorte lateral e brilhos por todo vestido,&nbsp;a pe&ccedil;a da match com sand&aacute;lias de salto alto e acess&oacute;rios brilhantes. Aposte!<br />
                <br />
                <strong>Caracter&iacute;sticas:</strong><br />
               
                Poliester 95%; Elastano 5%<br />
                Comprimento curto<br />
                Um ombro s&oacute;<br />
                Recorte lateral<br />
                <br />
                Medidas do modelo: altura: 1,75m; busto: 90cm; cintura: 70cm; quadril: 93cm; modelo est&aacute; vestindo: P<br />
                <br />
                Sin&ocirc;nimo de feminilidade e versatilidade, o&nbsp;<strong>vestido&nbsp;</strong>&eacute; uma pe&ccedil;a curinga e pr&aacute;tica. &Oacute;timo aliado para todos os momentos, sua modelagem pode variar sendo mais ajustada ou mais ampla e seu comprimento pode ser encontrado desde curto at&eacute; longo, favorecendo todos os gostos e adapt&aacute;vel a v&aacute;rios estilos e idades.<br />
                <br />
                Criada pensando no que h&aacute; de mais atual no mundo da moda, a marca&nbsp;<strong>Pool by Riachuelo</strong>&nbsp;re&uacute;ne desde a leveza para os pequenos, at&eacute; a atitude jovem com uma pegada fashionista para o guarda-roupa de quem ama estar sempre por dentro das tend&ecirc;ncias! Trazendo em sua identidade pe&ccedil;as modernas, despojadas, b&aacute;sicas e o bom e velho jeans.<br />
                <br />
                <strong>A cor do produto nas fotos reproduzidas com modelos pode sofrer altera&ccedil;&otilde;es, em decorr&ecirc;ncia do uso do flash.</strong></p>
                ',
                'sort'=>1
                ]
           
        );
        DB::table('collection_product')->insertGetId(
            
            ['collection_id' => $collectionId,
            'product_id' => $productId,
            'sort'=>1
            ]
       
        );
        Storage::disk('publictenant')->copy("images/product/1/1.png",  tenant('id') . '/images/catalog/'. $productId .'/1.png' );
        Storage::disk('publictenant')->copy("images/product/1/2.png",  tenant('id') . '/images/catalog/'. $productId .'/2.png' );
        Storage::disk('publictenant')->copy("images/product/1/3.png",  tenant('id') . '/images/catalog/'. $productId .'/3.png' );
        DB::table('product_images')->insertGetId(
            
            ['image_url' => '1.png',
            'title' => 'frente',
            'sort'=>1,
            'product_id'=>$productId
            ]
       
        );
        DB::table('product_images')->insertGetId(
            
            ['image_url' => '2.png',
            'title' => 'tras',
            'sort'=>2,
            'product_id'=>$productId
            ]
       
        );
        DB::table('product_images')->insertGetId(
            
            ['image_url' => '3.png',
            'title' => 'frente',
            'sort'=>3,
            'product_id'=>$productId
            ]
       
        );


        $collectionId=DB::table('collections')->insertGetId(
            
            ['name' => 'Inverno',
            'description' => '<p>Os melhores produtos da Moda inverno</p>',
            'image_url'=>'inverno.png',
            'status'=> 1,
            'page_title'=>'Inverno',
            'seo_description'=>'Inverno',
            'slug'=>'winter']
       
        );
        Storage::disk('publictenant')->copy("images/collections/inverno.png",  tenant('id') . '/images/collections/inverno.png' );
        $productId=DB::table('products')->insertGetId(
            
                ['name' => 'Jaqueta Akine Bomber Animal Print Feminina',
                'sku' =>'2',
                'slug'=>'Jaqueta-Akine-Bomber-Animal-Print-Feminina',
                'description'=> '<p>Jaqueta Akine Bomber Animal Print Feminina, confeccionada em nylon, possui gola alta, forro interno, fechamento frontal por z&iacute;per, modelo bomber, comprimento curto, mangas longas, bolsos laterais e estampa animal print. A jaqueta &eacute; a famosa pe&ccedil;a curinga no guarda-roupas feminino. Aposte na Jaqueta Akine Bomber Animal Print, para dar personalidade e atitude nos seus looks de inverno.</p>

                <p>Confeccionada em nylon</p>
                
                <p>Fechamento frontal por z&iacute;per</p>
                
                <p>Bolsos laterais</p>
                
                <p>Gola alta</p>
                
                <p>Forro interno</p>
                
                <p>Modelo bomber</p>
                
                <p>Comprimento curto</p>
                
                <p>Estampa animal print</p>
                
                <p>Mangas longas</p>
                
                <p>Composi&ccedil;&atilde;o: 100% poli&eacute;ster</p>
                ',
                'price'=>499.99,
                'status'=>1,
                'manage_stock'=>0,
                'meta_title'=>'Jaqueta Akine Bomber Animal Print Feminina',
                'meta_description'=> '<p>Jaqueta Akine Bomber Animal Print Feminina, confeccionada em nylon, possui gola alta, forro interno, fechamento frontal por z&iacute;per, modelo bomber, comprimento curto, mangas longas, bolsos laterais e estampa animal print. A jaqueta &eacute; a famosa pe&ccedil;a curinga no guarda-roupas feminino. Aposte na Jaqueta Akine Bomber Animal Print, para dar personalidade e atitude nos seus looks de inverno.</p>

                <p>Confeccionada em nylon</p>
                
                <p>Fechamento frontal por z&iacute;per</p>
                
                <p>Bolsos laterais</p>
                
                <p>Gola alta</p>
                
                <p>Forro interno</p>
                
                <p>Modelo bomber</p>
                
                <p>Comprimento curto</p>
                
                <p>Estampa animal print</p>
                
                <p>Mangas longas</p>
                
                <p>Composi&ccedil;&atilde;o: 100% poli&eacute;ster</p>
                ',
                'sort'=>1
                ]
           
        );
        DB::table('collection_product')->insertGetId(
            
            ['collection_id' => $collectionId,
            'product_id' => $productId,
            'sort'=>1
            ]
       
        );
        Storage::disk('publictenant')->copy("images/product/2/1.png",  tenant('id') . '/images/catalog/'. $productId .'/1.png' );
        Storage::disk('publictenant')->copy("images/product/2/2.png",  tenant('id') . '/images/catalog/'. $productId .'/2.png' );
        Storage::disk('publictenant')->copy("images/product/2/3.png",  tenant('id') . '/images/catalog/'. $productId .'/3.png' );
        Storage::disk('publictenant')->copy("images/product/2/4.png",  tenant('id') . '/images/catalog/'. $productId .'/4.png' );
        DB::table('product_images')->insertGetId(
            
            ['image_url' => '1.png',
            'title' => 'frente',
            'sort'=>1,
            'product_id'=>$productId
            ]
       
        );
        DB::table('product_images')->insertGetId(
            
            ['image_url' => '2.png',
            'title' => 'tras',
            'sort'=>2,
            'product_id'=>$productId
            ]
       
        );
        DB::table('product_images')->insertGetId(
            
            ['image_url' => '3.png',
            'title' => 'tecido externo',
            'sort'=>3,
            'product_id'=>$productId
            ]
       
        ); 
        DB::table('product_images')->insertGetId(
            
            ['image_url' => '3.png',
            'title' => 'tecido interno',
            'sort'=>4,
            'product_id'=>$productId
            ]
       
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
