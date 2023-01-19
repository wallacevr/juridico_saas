<?php

use Illuminate\Database\Seeder;
use App\Page;
class TenantPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Page::create(
            
            ['name' => 'Contato',
            'title' => 'Contato',
            'content'=>'Insira seu conteúdo',
            'status'=>1,
            'url' =>'contato',
            'keywords' => 'contatos,atendimento,email,telefone'
        ]
        ); 
        Page::create(

        ['name' => 'Política de Entrega',
        'title' => 'Política de Entrega',
        'content'=>'Insira seu conteúdo',
        'status'=>1,
        'url' =>'politica-de-entrega',
        'keywords' => 'politica de entrega,política,entrega'
        ],
      
        ); 
        Page::create(
        ['name' => 'Troca e Devolução',
        'title' => 'Troca e Devolução',
        'content'=>'Insira seu conteúdo',
        'status'=>1,
        'url' =>'troca-e-devolucao',
        'keywords' => 'troca,delolução,política'
        ]
        ); 
        Page::create(
        ['name' => 'Privacidade e Segurança',
        'title' => 'Privacidade e Segurança',
        'content'=>'Insira seu conteúdo',
        'status'=>1,
        'url' =>'privacidade-e-seguranca',
        'keywords' => 'privacidade,segurança'
        ]
        ); 
        Page::create(
            ['name' => 'Sobre nós',
            'title' => 'Sobre Nós',
            'content'=>'Insira seu conteúdo',
            'status'=>1,
            'url' =>'sobre-nos',
            'keywords' => 'sobre,nos,about'
            ]
            ); 
        Page::create(
            ['name' => 'Loja',
            'title' => 'Loja',
            'content'=>'Insira seu conteúdo',
            'status'=>1,
            'url' =>'loja',
            'keywords' => 'loja, store'
            ]
            ); 
    }
}
