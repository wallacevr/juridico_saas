<?php

namespace App\Http\Livewire\Tenant\Product;
use Illuminate\Support\Facades\File;
use Livewire\Component;
use App\Product;
use App\Collection;
use App\Brand;
use App\Variation;
use App\Option;
use App\ProductOption;
use App\ProductOptionsImage;
use App\ProductImage;
use App\ProductVariation;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
class EditProduct extends Component
{

    use WithFileUploads;
    public $productid;
    public $habilitavariations=0;
    public $selected = [];
    public $selected2 = [];
    public $optionsselected =[];
    public $selectedoptions = [];
    public $opcoes=[];
    public $variations=[];
    public $variationsselected=[];
    public $selectedcollections = [];
    public $newselectedcollections = [];
    public $selectedbrands= [];
    public $newselectedbrands= [];
    public $idcombinados;
    public $options =[];
    public $i=0;
    public $combinacoes=[];
    public $productimages=[];
    public $optionimages=[];
    public $optionimagessaveds=[];
    public $principaloptionimage;
    public $initialimages="";
    public $initialoptionimages=[];
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
    public $collections;
    public $product;
    public $productoptions;
    public $optionadd=[];
    public $optionid="";
    public $imagesoption=[];
    public $variationsupdate = false;
    public $initialvariarions=[];
    public $showoptionsimage=[];
    protected $listeners = ['listaoptions' => 'listaoptions'];

    public function render()
    {
      try {
        //code...
     
       
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


      
            return view('livewire.tenant.product.edit-product');
        } catch (\Throwable $th) {
          //throw $th;
          dd($th);
        }
    }


    public function mount(Product $product){
      try {
        $path = __DIR__."/../../../../../storage/tenant".tenant('id') .'/framework/cache';
        
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }
         
          $this->product=$product;
          $this->variations = Variation::all();
          $this->productid=$product->id;
          $this->name=$product->name;
          $this->description=$product->description;
          $this->sku=$product->sku;
     


          $this->price=$product->price;
          $this->special_price=$product->special_price;
          $this->cost_price=$product->cost;



          $this->manage_stock=$product->manage_stock;
          $this->qty = $product->qty;
          $this->min_qty = $product->min_qty;
           $this->max_qty =$product->max_qty;
           $this->meta_title =$product->meta_title;
           $this->meta_description = $product->meta_description;
           $this->slug =$product->slug;
           $this->status = $product->status;
           $this->collections = Collection::all();
           $this->selectedcollections = $product->collections->pluck('id');
           $this->brands = Brand::all();
           $this->selectedbrands = $product->brands->pluck('id');
           $this->selected = ProductVariation::where('product_id',$product->id)->pluck('variation_id');
          $this->initialvariations= $this->selected;
           $this->variationsselected = Variation::whereIn('id',$this->selected)->get();
          $this->initialimages = $product->imagesfilepond();

      
           if(count($product->variations)>0){
              $this->habilitavariations=true;
              $this->selected = $product->variations()->pluck('variation_id')->toArray();
           
              $this->productoptions = ProductOption::where('id_product',$product->id)->whereNotNull('price')->get();
  
              foreach($this->productoptions as $key =>$option){
                  $this->optionqty[$option->id]=$option->qty_stock;
                  
                  $this->optionprice[$option->id]=$option->price;

                  $this->showoptionsimage[$option->id]=false;
                    $this->initialoptionimages[$option->id]=$option->imagesfilepond();
               
              }
  
           }else{
              $this->habilitavariations=false;
           }
         
  
      } catch (\Throwable $th) {
        //throw $th;
        dd($th);
      }
    }
    public function updatevariations(){
      $this->product->variations()->sync($this->selected);
      $this->initialvariations= $this->selected;
      $this->variationsupdate=false;
      $this->variationsselected = Variation::whereIn('id',$this->selected)->get();
      if((array_diff($this->initialvariations->toArray(), $this->selected)!=[])&&array_diff( $this->selected,$this->initialvariations->toArray())!=[]){
        $this->variationsupdate=true;
      }else{
        $this->variationsupdate=false;
      }
    }
    public function listaoptions(){

        $this->variationsselected = Variation::whereIn('id',$this->selected)->get();
   
            if(!((array_diff($this->initialvariations->toArray(), $this->selected)!=[])&&array_diff( $this->selected,$this->initialvariations->toArray())!=[])){
              
              if(count($this->initialvariations)!=count($this->selected)){
                $this->variationsupdate=true;
              }else{
                $this->variationsupdate=false;
              }
            }else{
              $this->variationsupdate=false;
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
            'slug' => ['required','unique:products,slug,'.$this->productid],
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
            'description' => 'required',
            'productimages' => 'required',
            'slug' => ['required','unique:products,slug,'.$this->productid],

        ]);
     }

     

      try {


      
      
            $product = Product::find($this->productid);
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

            $product->update();

            $x=0;
            ProductImage::where('product_id', $product->id)->delete();
        
            foreach ($this->productimages as $photo) {

               $photo->storeAs(tenant('id') .'/images/catalog/'. $product->id,$photo->getClientOriginalName() ,'catalogo');
               $product->images()->create(['image_url'=>$photo->getClientOriginalName(),'sort'=>$x,'title'=>Str::of($photo->getClientOriginalName())->basename('.'.$photo->getClientOriginalExtension())]);
                $x=$x+1;
              }
              
            $dados=[];
            if($this->newselectedcollections!=[]){
              foreach($this->newselectedcollections as $index=>$collection){
                  $dados=Arr::add($dados,$collection,['collection_id'=>$collection,'sort'=>100]);
              }
            }else{
              foreach($this->selectedcollections as $index=>$collection){
                $dados=Arr::add($dados,$collection,['collection_id'=>$collection,'sort'=>100]);
            }
            }
            $product->collections()->sync($dados);
            $dados=[];
            if($this->newselectedbrands!=[]){
                foreach($this->newselectedbrands as $index=>$brand){
                  $dados=Arr::add($dados,$brand,['brand_id'=>$brand,'sort'=>100]);
              }
            }else{
              foreach($this->selectedbrands as $index=>$brand){
                $dados=Arr::add($dados,$brand,['brand_id'=>$brand,'sort'=>100]);
              }
            }
            $product->brands()->sync($dados);


            if($this->habilitavariations){
              foreach($this->selected as $variation){
                $prodvariation = new ProductVariation;
                $prodvariation->product_id = $this->product->id;
                $prodvariation->variation_id = $variation;
                $prodvariation->save();
              }    
            
              foreach($this->productoptions as $prodopt){
          
                  $opt = ProductOption::find($prodopt->id);
                  $opt->qty_stock = $this->optionqty[$prodopt->id];
                
                  $opt->price = $this->optionprice[$prodopt->id];
                  $opt->update();

                  $x=0;
                  if($showoptionsimage==true){
                      ProductOptionsImage::where('product_options_id', $opt->id)->delete();
                  
                      if(isset($this->optionimages[$opt->id])){
                        
                    
                        $this->optionimages[$opt->id]->storeAs(tenant('id') .'/images/catalog/'. $product->id .'/'. $opt->id,$this->optionimages[$opt->id]->getClientOriginalName() ,'catalogo');
                          $opt->images()->create(['product_options_id'=>$opt->id,'image_url'=>$this->optionimages[$opt->id]->getClientOriginalName(),'sort'=>$x,'title'=>Str::of($this->optionimages[$opt->id]->getClientOriginalName())->basename('.'.$this->optionimages[$opt->id]->getClientOriginalExtension())]);
                            $x=$x+1;
                        
                      }
                  }
                  
                      
       
                
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

    public function deleteimagem(ProductOptionsImage $image,$x,$key){
    try {
        $imageUrl = public_path() . '/tenant/'. tenant('id') .'/images/catalog/'. $this->productid.'/'. $image->product_options_id .'/' . $image->image_url ;

        if ($image->delete()) {
            File::exists($imageUrl) ? File::delete($imageUrl) : '';
        }
       unset( $this->optionimagessaveds[$x][$key]);
    } catch (\Throwable $th) {
        //throw $th;

    }

    }


    public function addoptions(){
      
        $this->validate( [
          'optionprice.0'=>'required',
          'optionqty.0' =>'required',

        ]);
        
        try {
          //code...
          $x=1;
          $ultima=null;
          foreach($this->product->variations as $variation){
           
            if($x!=count($this->selected)){
      
                $productoption = new ProductOption;
               
                $productoption->id_product = $this->product->id;
            
                $productoption->id_options = $this->optionadd[$variation->id];
                $productoption->nivel = $x-1;
                $productoption->id_product_options = $ultima;
                $productoption->save();
                $ultima = $productoption->id;
            }else{
            
              $productoption = new ProductOption;
             
              $productoption->id_product = $this->product->id;
              $productoption->id_options = $this->optionadd[$variation->id];
              $productoption->qty_stock = $this->optionqty[0];
              $productoption->price= $this->optionprice[0];
              $productoption->nivel = $x-1;
              $productoption->id_product_options = $ultima;
              $productoption->save();
              $ultima = $productoption->id;
            }
            $x=$x+1;
          }
          $this->productoptions = ProductOption::where('id_product',$this->product->id)->whereNotNull('price')->get();
          foreach($this->productoptions as $key =>$option){
            $this->optionqty[$option->id]=$option->qty_stock;
            $this->optionprice[$option->id]=$option->price;
            $this->optionimagessaveds[$option->id] = ProductOptionsImage::where('product_options_id',$option->id)->get();
           $this->principaloptionimage[$option->id]= ProductOptionsImage::where('product_options_id',$option->id)->where('main',1)->pluck('id');
           
              $this->initialoptionimages[$option->id]=$option->imagesfilepond();
            
          }
        } catch (\Throwable $th) {
          //throw $th;
          dd($th);
        }
    }
public function deleteoption(ProductOption $productoption){
  try {
    //code...
    $productoption->delete();
    $this->productoptions = ProductOption::where('id_product',$this->product->id)->whereNotNull('price')->get();
    foreach($this->productoptions as $key =>$option){
      $this->optionqty[$option->id]=$option->qty_stock;
      $this->optionprice[$option->id]=$option->price;
      $this->optionimagessaveds[$option->id] = ProductOptionsImage::where('product_options_id',$option->id)->get();
     $this->principaloptionimage[$option->id]= ProductOptionsImage::where('product_options_id',$option->id)->where('main',1)->pluck('id');
     
        $this->initialoptionimages[$option->id]=$option->imagesfilepond();
      
    }
  } catch (\Throwable $th) {
    //throw $th;
    
  }
}

public function showoptionsimages($option){
   $this->showoptionsimage[$option]=true;
}
    
}

