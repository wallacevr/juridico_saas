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
       $configs = [
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

    }
}
