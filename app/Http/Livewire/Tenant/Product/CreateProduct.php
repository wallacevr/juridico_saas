<?php

namespace App\Http\Livewire\Tenant\Product;

use Livewire\Component;
use App\Product;
use App\Collection;
use App\Variation;
use App\Brand;
use App\Option;
use App\ProductOption;
use App\CustomerGroup;
use App\ProductOptionsImage;
use App\ProductCustomersGroup;
use App\TicketProduct;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use App\ProductVariation;
class CreateProduct extends Component
{

    use WithFileUploads;
    public $habilitavariations=0;
    public $selected = [];
    public $selected2 = [];
    public $optionsselected =[];
    public $selectedoptions = [];
    public $opcoes=[];
    public $brands=[];
    public $variations=[];
    public $variationsselected=[];
    public $selectedcollections = [];
    public $selectedbrands = [];
    public $idcombinados;
    public $options =[];
    public $i=0;
    public $combinacoes=[];
    public $productimages=[];
    public $initialimages="";
    public $optionimages;
    public $principaloptionimage;
    public $optionprice;
    public $optionqty;
    public  $name;
    public $description;
    public $sku;
    public $price;
    public $special_price;
    public $cost_price;
    public $manage_stock=1;
    public $qty;
    public $min_qty;
    public $max_qty;
    public $meta_title;
    public $meta_description;
    public $slug;
    public $status=1;
    public $arquivos;
    public $attributes;
    public $usespecialprice = 0;
    public $groups =[];
    public $grpcustomer;
    public $specialpricegrp;
    public $minqtyspecialprice;
    public $removedgroups=[];
    public $countremoved=0;
    public $customergroups=[];
    public $optionid;
  public $initialoptionimages="";
    protected $listeners = ['listaoptions' => 'listaoptions'];

    public function render()
    {
     
        $opcoes = $this->selected2;

          $combinar = array();
          foreach( $opcoes as $k => $v )
          {
            $combinar[] = $v;
          }

          $texto = $this->combinacao( '', $combinar, 0 );
          $texto = preg_split( '/\n/', $texto, -1, PREG_SPLIT_NO_EMPTY );

          $combinacoes = array();
          foreach( $texto as $k => $v )
          {
            $combinacoes[] = preg_split( '/##/', $v, -1, PREG_SPLIT_NO_EMPTY );
          }
          $this->combinacoes=$combinacoes;

        array_push($this->options ,count($this->variationsselected));



        return view('livewire.tenant.product.create-product');
    }


    public function mount(){
        
      $path = __DIR__."/../../../../../storage/tenant".tenant('id') .'/framework/cache';
        
      if (!is_dir($path)) {
          mkdir($path, 0777, true);
      }
        $this->variations = Variation::all();
        $this->brands = Brand::all();
        $this->customergroups =  CustomerGroup::all()->sortBy('name');
     
    }

    public function listaoptions(){

        $this->variationsselected = Variation::whereIn('id',$this->selected)->get();
        foreach($this->variationsselected as $variationsselected){
            $this->optionsselected[$variationsselected->id]=[];
        }



    }
    public function combinacao( $txt, $termos, $i )
    {
      $texto = '';
      if ( $i >= count( $termos ) )
      {
        $texto .= trim( $txt ) . "\n";
      }
        else
        {
        foreach ( $termos[$i] as $termo )
        {
          $texto .= $this->combinacao( $txt . $termo . '##', $termos, $i + 1 );
        }
        }
        return $texto;
    }

    public function getOption($id){
        $option=Option::find($id);
        return $option->name;
    }

    public function store(){
 
      if($this->habilitavariations){
      
        $this->validate( [
            'name' => 'required',
            'sku' =>'required',
            'price' =>['required','numeric'],
            'special_price' =>['required','numeric'],
            'cost_price' =>['required','numeric'],
            'description' => 'required',
            'productimages' => 'required',
            'slug' => ['required','unique:products'],
          
            'optionprice.*'=>'required',
            'optionqty.*' =>'required'
        ]);
     }else{
        $this->validate( [
            'name' => 'required',
            'price' =>['required','numeric'],
            'special_price' =>['required','numeric'],
            'cost_price' =>['required','numeric'],
            'sku' =>'required',
            'productimages' => 'required',
            'description' => 'required',
            'slug' => ['required','unique:products'],

        ]);
     }

  
      try {
           if(empty($this->price)){
            $this->price=0;
           }
           if(empty($this->special_price)){
            $this->special_price=0;
           }
           if(empty($this->cost_price)){
            $this->cost_price=0;
           }
            $product = new Product;
            $product->name = $this->name;
            $product->description =  $this->description;
            $product->sku = $this->sku;
           
            $product->price = number_format( str_replace(',','.',$this->price) ,2,'.','');
            $product->special_price = number_format(str_replace(',','.',$this->special_price),2,'.','');
            $product->cost = number_format(str_replace(',','.',$this->cost_price),2,'.','');
            $product->weight=0;
            $product->width=0;
            $product->height=0;
            $product->manage_stock = $this->manage_stock;
            if($this->qty==null || $this->qty==""){
              $product->qty =0;
            }else{
              $product->qty = $this->qty;
            }  
            
        
            if($this->min_qty==null || $this->min_qty==""){
              $product->min_qty =0;
             }else{
              $product->min_qty = $this->min_qty;
             }
             if($this->max_qty==null || $this->max_qty==""){
              $product->max_qty =0;
             }else{
              $product->max_qty = $this->max_qty;
             }
         
            $product->meta_title = $this->meta_title;
            $product->meta_description = $this->meta_description;
            $product->slug = $this->slug;
            $product->status = $this->status;

            $product->save();





            $x=0;
            foreach ($this->productimages as $photo) {

               $photo->storeAs(tenant('id') .'/images/catalog/'. $product->id,str_replace(" ","_",$photo->getClientOriginalName())  ,'catalogo');
               $product->images()->create(['image_url'=>str_replace(" ","_",$photo->getClientOriginalName()) ,'sort'=>$x,'title'=>Str::of($photo->getClientOriginalName())->basename('.'.$photo->getClientOriginalExtension())]);
                $x=$x+1;
              }
            $dados=[];

            foreach($this->selectedcollections as $index=>$collection){
                $dados=Arr::add($dados,$collection,['collection_id'=>$collection,'sort'=>100]);
            }
            $product->collections()->sync($dados);
            
            $dados=[];
           
            foreach($this->selectedbrands as $index=>$brand){
                $dados=Arr::add($dados,$brand,['brand_id'=>$brand,'sort'=>100]);
            }
           
            $product->brands()->sync($dados);


            if($this->habilitavariations){
            foreach ($this->optionprice as $key => $value) {
              $max=count($this->combinacoes[$key])-1;
              $ultima="";
              $key2=0;
              foreach($this->selected as $variation){
                 
                  $productvariation = ProductVariation::where('product_id',$product->id)->where('variation_id',$variation)->get();
               
                  if(count($productvariation)==0){
                    $prodvariation = new ProductVariation;
                    $prodvariation->product_id = $product->id;
                    $prodvariation->variation_id = $variation;
                    $prodvariation->save();
                   
                  }
                 
              }
              foreach($this->combinacoes[$key] as $opts){

              

                    $productoption               = new ProductOption;
                    $productoption->id_product   = $product->id;
                    $productoption->id_options   = $opts ;
                    $productoption->nivel = $key2;
                   
                    if($key2 == $max){
                      if(empty($this->optionprice[$key])){
                        $this->optionprice[$key]=0;
                       }
                      $productoption->price   = number_format(str_replace(",",'.',$this->optionprice[$key]),2,'.','');
                      $productoption->qty_stock   = $this->optionqty[$key];
                    


                    }
                
                    if($key2 != 0){
                      $productoption->id_product_options  =$ultima;

                    }

                    $productoption->save();
               
                    if($key2 == $max){
                     
                      if(isset($this->optionimages[$key])){
                        $this->optionimages[$key]->storeAs(tenant('id') .'/images/catalog/'. $product->id. '/'.$productoption->id , $this->optionimages[$key]->getClientOriginalName() ,'catalogo');
                        ProductOptionsImage::create(['product_options_id'=>$productoption->id ,'image_url'=> $this->optionimages[$key]->getClientOriginalName(),'sort'=>$x,'title'=>Str::of( $this->optionimages[$key]->getClientOriginalName())->basename('.'. $this->optionimages[$key]->getClientOriginalExtension()),'main'=>1]);
                   
                  
                      }
                   
                        
                    }

                    $key2 = $key2 + 1;
                    $ultima =  $productoption->id;


              }
          }
        }
       
        if($this->grpcustomer!=[]){
            foreach($this->grpcustomer as $key=>$grpcustomer) {
                ProductCustomersGroup::create([
                  'id_customer_group' => $this->grpcustomer[$key],
                  'id_product' => $product->id ,
                  'qty' =>str_replace(',','.', $this->minqtyspecialprice[$key]),
                  'price' => number_format(str_replace(",",'.', $this->specialpricegrp[$key]),2,'.',''),
                ]);
            }
        }


       

                return redirect()->route('tenant.products.index')->with("success", "Product created successfully!");


      } catch (\Throwable $th) {
        //throw $th;
        dd($th);
      }
    }
    public function removerimagem($x,$position){

      unset($this->optionimages[$x][$position]);
    }

    public function addgrpcustomer(){
      try {
          $this->validate( [
            'grpcustomer.'. (count($this->groups)+1) .''=>'required',
            'specialpricegrp.'. (count($this->groups)+1) .'' =>'required',
            'minqtyspecialprice.'. (count($this->groups)+1) .''=>'required'

        ]);
        array_push($this->groups ,1);

      } catch (\Throwable $th) {
        //throw $th;

      }
    }

    public function removegroup($x){


    }

}
