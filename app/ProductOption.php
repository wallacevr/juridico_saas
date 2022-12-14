<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ProductOption extends Model
{
    use SoftDeletes;
    protected $fillable = [        
       
        'id_product',
        'id_options',
        'qty_stock',
        'price',
        'id_product_options',
        'created_at',
        'updated_at',
        'nivel'
    ];
    protected $table = "product_options";

    public function formattedPrice(){
        return 'R$ '.number_format($this->price,2,',','.');
    }
    public function products(){
        return $this->belongsToMany(Product::class);
    }

    public function options(){
        return $this->belongsTo(Option::class, 'id_options');
    }

    public function getImage($size='small'){
       
        $image = null;
     
        if($this->images()->first()){
            $image ='/tenant/'. tenant('id') .'/images/catalog/'. $this->id_product .'/'. $this->id .'/'.  $this->images()->first()->image_url;
           
        }
       // $image = imageCache($image,$size);
       
        return $image;
    }

    public function images(){
        return $this->hasMany(ProductOptionsImage::class, 'product_options_id', 'id')->orderBy('main','Desc');
    }

    public function descricao(){
        $descricao="";
      
        $option = ProductOption::where('id_product',$this->id_product)->where('id',$this->id)->get();
        
        $proxima = $option[0]->id;
      
        for($x=$this->nivel;$x>=0; $x--){
            $option = ProductOption::find($proxima);
           
            $descricao = $option->options->name .'/' . $descricao;
           
            $proxima = $option->id_product_options;
        }
      
      

        return rtrim($descricao,'/');
    }


    public function imagesfilepond(){
        $imgs="";
        foreach($this->images  as $optimage){
          
            $imgs=$imgs ."{source:'". productImagex($optimage->image_url,$this->id_product,$this->id)  ."'},";
          }
        return $imgs;
    }
}
