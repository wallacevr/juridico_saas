<?php

use App\Models\Config;
use App\Menu;
use Illuminate\Database\Seeder;

class TenantDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $antigo = umask(0);
       $configs = [
            [
                'path' => 'general/layout/thumb_width',
                'value' => 30
            ],
            [
                'path' => 'general/layout/small_width',
                'value' => 60
            ],
            [
                'path' => 'general/layout/medium_width',
                'value' => 100
            ],
            [
                'path' => 'general/layout/big_width',
                'value' => 140
            ],
            [
                'path' => 'general/layout/thumb_height',
                'value' => 30
            ],
            [
                'path' => 'general/layout/small_height',
                'value' => 60
            ],
            [
                'path' => 'general/layout/medium_height',
                'value' => 100
            ],
            [
                'path' => 'general/layout/big_height',
                'value' => 140
            ],
            [
                'path' => 'general/store/wallace',
                'value' => 'wallace'
            ],
            [
                'path' => 'general/store/name',
                'value' => 'MaxCommerce'
            ], [
                'path' => 'general/store/description',
                'value' => 'Monte sua loja online sem dificuldades, com preços acessíveis'
            ], [
                'path' => 'general/store/email',
                'value' => 'contato@maxcommerce.com.br'
            ],
            [
                'path' => 'general/store/logo',
                'value' => 'maxcommerce.png'
            ],
            [
                'path' => 'general/store/favicon',
                'value' => 'maxcommerce_icon.png'
            ],
            [
                'path' => 'general/store/maintenance',
                'value' => 0
            ],
            [
                'path' => 'general/store/postalcode',
                'value' => '60000-000'
            ],
            [
                'path' => 'general/store/address',
                'value' => 'Avenida Beira Mar'
            ],
            [
                'path' => 'general/store/number',
                'value' => '0000'
            ],
            [
                'path' => 'general/store/complement',
                'value' => 'B'
            ],
            [
                'path' => 'general/store/neighborhood',
                'value' => 'Centro'
            ],
            [
                'path' => 'general/store/city',
                'value' => 'Fortaleza'
            ],
            [
                'path' => 'general/store/state',
                'value' => 'Ceará'
            ],
            [
                'path' => 'general/store/taxvat',
                'value' => '00.000.000/0000-00'
            ],
            [
                'path' => 'general/store/company_email',
                'value' => 'contato@sualoja.com'
            ],
            [
                'path' => 'general/store/registred_company_name',
                'value' => 'Max commerce LTDA'
            ],
            [
                'path' => 'general/store/phone',
                'value' => '(xx) xxxxx - xxxx'
            ],
            [
                'path' => 'general/store/whatsapp',
                'value' => '(xx) xxxxx - xxxx'
            ],
            [
                'path' => 'general/store/social_facebook',
                'value' => 'https://www.facebook.com/maxcommerce'
            ],
            [
                'path' => 'general/store/social_instagram',
                'value' => 'http://instagram.com/maxcommerce'
            ],
            [
                'path' => 'general/store/social_youtube',
                'value' => 'https://www.youtube.com/channel/maxcommerce'
            ],
            [
                'path' => 'general/store/social_pinterest',
                'value' => 'https://br.pinterest.com/maxcommerce'
            ],
            [
                'path' => 'general/store/total_by_product',
                'value' => 36
            ]
            

        ];
        foreach($configs as $config){
            Config::create($config);
        }
        Menu::query()->truncate();
        Menu::create(['title'=>'Menu Inicial','slug'=>'main','url'=>'#|page','status'=>1,'sort'=>0]);
        Menu::create(['title'=>'Contato','slug'=>'contato','url'=>'/contato|page','status'=>1,'parent_id'=>1,'sort'=>0]);
        $collectionId=DB::table('collections')->insertGetId(
            
            ['name' => 'verão',
            'description' => '<p>Os melhores produtos da Moda verão</p>',
            'image_url'=>'verao.png',
            'status'=> 1,
            'page_title'=>'Verão',
            'seo_description'=>'Verão',
            'slug'=>'summer']
       
        );
        $path = public_path('tenant/'.tenant('id') .'/images/collections');
        
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }
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
                Criada pensando no que h&aacute; de mais atual no mundo da moda, a marca&nbsp;&nbsp;re&uacute;ne desde a leveza para os pequenos, at&eacute; a atitude jovem com uma pegada fashionista para o guarda-roupa de quem ama estar sempre por dentro das tend&ecirc;ncias! Trazendo em sua identidade pe&ccedil;as modernas, despojadas, b&aacute;sicas e o bom e velho jeans.<br />
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
                Criada pensando no que h&aacute; de mais atual no mundo da moda, a marca&nbsp;re&uacute;ne desde a leveza para os pequenos, at&eacute; a atitude jovem com uma pegada fashionista para o guarda-roupa de quem ama estar sempre por dentro das tend&ecirc;ncias! Trazendo em sua identidade pe&ccedil;as modernas, despojadas, b&aacute;sicas e o bom e velho jeans.<br />
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
        $path = public_path('tenant/'.tenant('id') .'/images/catalog');
        
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }
        Storage::disk('publictenant')->copy("images/product/1/1.png",  tenant('id') . '/images/catalog/'. $productId .'/1.png' );
        Storage::disk('publictenant')->copy("images/product/1/2.png",  tenant('id') . '/images/catalog/'. $productId .'/2.png' );

        DB::table('product_images')->insert(
            
            ['image_url' => '1.png',
            'title' => 'frente',
            'sort'=>1,
            'product_id'=>$productId
            ]
       
        );
        DB::table('product_images')->insert(
            
            ['image_url' => '2.png',
            'title' => 'tras',
            'sort'=>2,
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
        DB::table('collection_product')->insert(
            
            ['collection_id' => $collectionId,
            'product_id' => $productId,
            'sort'=>1
            ]
       
        );
        Storage::disk('publictenant')->copy("images/product/2/1.png",  tenant('id') . '/images/catalog/'. $productId .'/1.png' );
        Storage::disk('publictenant')->copy("images/product/2/2.png",  tenant('id') . '/images/catalog/'. $productId .'/2.png' );
        Storage::disk('publictenant')->copy("images/product/2/3.png",  tenant('id') . '/images/catalog/'. $productId .'/3.png' );
        Storage::disk('publictenant')->copy("images/product/2/4.png",  tenant('id') . '/images/catalog/'. $productId .'/4.png' );
        DB::table('product_images')->insert(
            
            ['image_url' => '1.png',
            'title' => 'frente',
            'sort'=>1,
            'product_id'=>$productId
            ]
       
        );
        DB::table('product_images')->insert(
            
            ['image_url' => '2.png',
            'title' => 'tras',
            'sort'=>2,
            'product_id'=>$productId
            ]
       
        );
        DB::table('product_images')->insert(
            
            ['image_url' => '3.png',
            'title' => 'tecido externo',
            'sort'=>3,
            'product_id'=>$productId
            ]
       
        ); 
        DB::table('product_images')->insert(
            
            ['image_url' => '4.png',
            'title' => 'tecido interno',
            'sort'=>4,
            'product_id'=>$productId
            ]
       
        ); 
         
        $path = public_path('tenant/'. tenant('id') .'/images/catalog/cache/');
        
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }
        umask($antigo);
         Page::create(
            
            ['name' => 'Contato',
            'title' => 'Contato',
            'content'=>'<p><strong>D&uacute;vidas, ligue<span style="color:#000000">&nbsp;</span></strong><span style="color:#000000">(xx)xxxx-xxxx</span></p>
            
            <p>&nbsp;</p>
            
            <p><strong>Envie um e-mail</strong><a href="mailto:lojas.contatorubiataba@hotmail.com.br">l</a>&nbsp;contato@sualoja.com</p>
            
            <p>&nbsp;</p>
            
            <p><small><strong>Hor&aacute;rio de atendimento:&nbsp;</strong></small></p>
            
            <p><small><strong>&nbsp; &nbsp;</strong>Segunda a sexta-feira, das 9h &agrave;s 17h. </small></p>
            
            <p><small>&nbsp; &nbsp;S&aacute;bados, das 9h &agrave;s 12h.</small></p>
            
            <p><small>&nbsp; &nbsp;Fechado aos domingos.</small></p>
            
            <p>&nbsp;</p>
            
            <p>&nbsp;</p>',
            'status'=>1,
            'url' =>'contato',
            'keywords' => 'contatos,atendimento,email,telefone'
        ],
        ['name' => 'Política de Entrega',
        'title' => 'Política de Entrega',
        'content'=>'Insira seu conteúdo',
        'status'=>1,
        'url' =>'politica-de-entrega',
        'keywords' => 'politica de entrega,política,entrega'
        ],
        ['name' => 'Troca e Devolução',
        'title' => 'Troca e Devolução',
        'content'=>'Insira seu conteúdo',
        'status'=>1,
        'url' =>'troca-e-devolucao',
        'keywords' => 'troca,delolução,política'
        ],
        ['name' => 'Privacidade e Segurança',
        'title' => 'Privacidade e Segurança',
        'content'=>'Insira seu conteúdo',
        'status'=>1,
        'url' =>'privacidade-e-seguranca',
        'keywords' => 'privacidade,segurança'
        ]
        ); 

    }
   
}
