<?php


use App\Banco;
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
       $bancos= [
        [
            'codbanco'=>'001',
            'nome'=>'Banco do Brasil S.A.'
        ],
        [
            'codbanco'=>'033',
            'nome'=>'Banco Santander (Brasil) S.A.'
        ],

        [
            'codbanco'=>'104',
            'nome'=>'Caixa Econômica Federal'
        ],
        [
            'codbanco'=>'237',
            'nome'=>'Banco Bradesco S.A..'
        ],
        [
            'codbanco'=>'341',
            'nome'=>'Banco Itaú S.A.'
        ],
        [
            'codbanco'=>'356',
            'nome'=>'Banco Real S.A. (antigo).'
        ],
        [
            'codbanco'=>'389',
            'nome'=>'Banco Mercantil do Brasil S.A.'
        ],
        [
            'codbanco'=>'399',
            'nome'=>'HSBC Bank Brasil S.A. – Banco Múltiplo'
        ],
        [
            'codbanco'=>'422',
            'nome'=>'Banco Safra S.A.'
        ],
        [
            'codbanco'=>'453',
            'nome'=>'Banco Rural S.A.'
        ],
        [
            'codbanco'=>'633',
            'nome'=>'Banco Rendimento S.A.'
        ],
        [
            'codbanco'=>'652',
            'nome'=>'Itaú Unibanco Holding S.A.'
        ],
         
        [
            'codbanco'=>'745',
            'nome'=>'Banco Citibank S.A.'
        ]
       ];
       foreach($bancos as $bancos){
        Banco::create($bancos);
    }
    }
   
}
