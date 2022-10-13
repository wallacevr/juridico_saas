<?php

namespace App\Http\Livewire\Tenant\Product;

use Livewire\Component;
use App\Product;
use App\Collection;
use App\Variation;
use App\Option;
use App\ProductOption;
use App\CustomerGroup;
use App\ProductOptionsImage;
use App\ProductCustomersGroup;
use App\TicketProduct;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

class CreateProduct extends Component
{
  
    use WithFileUploads;
    public $habilitavariations=0;
    public $selected = [];
    public $selected2 = [];
    public $optionsselected =[];
    public $selectedoptions = [];
    public $opcoes=[];
    public $variations=[];
    public $variationsselected=[];
    public $selectedcollections = [];
    public $idcombinados;
    public $options =[];
    public $i=0;
    public $combinacoes=[];
    public $productimages=[];
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
    public $manage_stock;
    public $qty;
    public $min_qty;
    public $max_qty;
    public $meta_title;
    public $meta_description;
    public $slug;
    public $status;
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
        $this->variations = Variation::all();
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
      try {
            
            
              $this->validate( [
                'name' => 'required',
                'description' => 'required',
                'slug' => ['required','unique:products'],
                'optionprice.0'=>'required',
                'optionqty.0' =>'required',
                'optionprice.*'=>'required',
                'optionqty.*' =>'required'
            ]);
         
            $product = new Product;
            $product->name = $this->name;
            $product->description =  $this->description;
            $product->sku = $this->sku;
            $product->price = $this->price;
            $product->special_price = $this->special_price;
            $product->cost = $this->cost_price;
            $product->manage_stock = $this->manage_stock;
            $product->qty = $this->qty;
            $product->min_qty = $this->min_qty;
            $product->max_qty = $this->max_qty;
            $product->meta_title = $this->meta_title;
            $product->meta_description = $this->meta_description;
            $product->slug = $this->slug;
            $product->status = $this->status;
          
            $product->save();





            $x=0;
            foreach ($this->productimages as $photo) {
              
               $photo->storeAs(tenant('id') .'/images/catalog/'. $product->id,$photo->getClientOriginalName() ,'catalogo');
               $product->images()->create(['image_url'=>$photo->getClientOriginalName(),'sort'=>$x,'title'=>Str::of($photo->getClientOriginalName())->basename('.'.$photo->getClientOriginalExtension())]);
                $x=$x+1;
              }
            $dados=[];   
            
            foreach($this->selectedcollections as $index=>$collection){
                $dados=Arr::add($dados,$collection,['collection_id'=>$collection,'sort'=>100]);
            }
            $product->collections()->sync($dados);
          
            foreach ($this->optionprice as $key => $value) {
              $max=count($this->combinacoes[$key])-1;
              $ultima="";
              $key2=0;
              foreach($this->combinacoes[$key] as $opts){
                
          
               
                    $productoption               = new ProductOption;
                    $productoption->id_product   = $product->id;
                    $productoption->id_options   = $opts ;
                    $productoption->nivel = $key2;
                    if($key2 == $max){
                      $productoption->price   = $this->optionprice[$key];
                      $productoption->qty_stock   = $this->optionqty[$key];
                    
        
                    
                    }
                    if($key2 != 0){
                      $productoption->id_product_options  =$ultima;
                
                    }
             
                    $productoption->save();
                    if($key2 == $max){
                      if(($this->optionimages[$key]!="")or($this->optionimages[$key]!=null)){
                          foreach ($this->optionimages[$key] as $key3=>$photo) {
                           if($key3 == $this->principaloptionimage[$key]){
                             $main = 1;
                           }else{
                            $main = 0;
                           }
                            $photo->storeAs(tenant('id') .'/images/catalog/'. $product->id. '/'.$productoption->id ,$photo->getClientOriginalName() ,'catalogo');
                            ProductOptionsImage::create(['product_options_id'=>$productoption->id ,'image_url'=>$photo->getClientOriginalName(),'sort'=>$x,'title'=>Str::of($photo->getClientOriginalName())->basename('.'.$photo->getClientOriginalExtension()),'main'=>$main]);
                        }
                      }
                    }

                    $key2 = $key2 + 1;
                    $ultima =  $productoption->id;

            
              }
          }
            
          foreach($this->grpcustomer as $key=>$grpcustomer) {
              ProductCustomersGroup::create([
                'id_customer_group' => $this->grpcustomer[$key],
                'id_product' => $product->id ,
                'qty' => $this->minqtyspecialprice[$key], 
                'price' => $this->specialpricegrp[$key], 
              ]);
          }
            
             
             
                return redirect()->route('tenant.products.index')->with("success", "Product created successfully!");
         

      } catch (\Throwable $th) {
        //throw $th;
          
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
