<?php

use App\Models\Config;
use App\Post;
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
                'path' => 'general/store_name',
                'value' => 'MaxCommerce'
            ], [
                'path' => 'general/store_description',
                'value' => 'Monte sua loja online sem dificuldades, com preços acessíveis'
            ], [
                'path' => 'general/store_email',
                'value' => 'contato@maxcommerce.com.br'
            ],
            [
                'path' => 'general/store_logo',
                'value' => 'maxcommerce.png'
            ],
            [
                'path' => 'general/store_favicon',
                'value' => 'maxcommerce_icon.png'
            ],
            [
                'path' => 'general/store_maintenance',
                'value' => 0
            ],
            [
                'path' => 'general/store_postalcode',
                'value' => '60000-000'
            ],
            [
                'path' => 'general/store_address',
                'value' => 'Avenida Beira Mar'
            ],
            [
                'path' => 'general/store_number',
                'value' => '0000'
            ],
            [
                'path' => 'general/store_complement',
                'value' => 'B'
            ],
            [
                'path' => 'general/store_neighborhood',
                'value' => 'Centro'
            ],
            [
                'path' => 'general/store_city',
                'value' => 'Avenida Beira Mar'
            ],
            [
                'path' => 'general/store_state',
                'value' => 'Avenida Beira Mar'
            ],
            [
                'path' => 'general/store_vatid',
                'value' => '00.000.000/0000-00'
            ],
            [
                'path' => 'general/store_phone',
                'value' => '(xx) xxxxx - xxxx'
            ],
            [
                'path' => 'general/store_whatsapp',
                'value' => '(xx) xxxxx - xxxx'
            ],
            [
                'path' => 'general/store_social_facebook',
                'value' => 'https://www.facebook.com/maxcommerce'
            ],
            [
                'path' => 'general/store_social_instagram',
                'value' => 'http://instagram.com/maxcommerce'
            ],
            [
                'path' => 'general/store_social_youtube',
                'value' => 'https://www.youtube.com/channel/maxcommerce'
            ],
            [
                'path' => 'general/store_social_pinterest',
                'value' => 'https://br.pinterest.com/maxcommerce'
            ],
            [
                'path' => 'general/store_total_by_product',
                'value' => 36
            ]
        ];
        foreach($configs as $config){
            Config::create($config);
        }
     
    }
}
