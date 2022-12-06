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



        return view('livewire.tenant.product.edit-product');
    }


    public function mount(Product $product){
      $path = __DIR__."\\..\\..\\..\\..\\..\\storage\\tenant".tenant('id') .'\\framework\\cache';
        
      if (!is_dir($path)) {
          mkdir($path, 0777, true);
      }
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
         if(count($product->options)>0){
            $this->habilitavariations=true;
            $this->selected = $product->options->pluck('variation_id');
            foreach( $this->selected as $variations){
               $this->selected2[$variations]=array_unique($product->options->where('variation_id',$variations)->pluck('id')->toArray());

            }
            $productoptions = ProductOption::where('id_product',$product->id)->whereNotNull('price')->get();

            foreach($productoptions as $key =>$option){
                $this->optionqty[$key]=$option->qty_stock;
                $this->optionprice[$key]=$option->price;
                $this->optionimagessaveds[$key] = ProductOptionsImage::where('product_options_id',$option->id)->get();
            }


         }else{
            $this->habilitavariations=false;
         }

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
            'price' =>'required',
            'description' => 'required',
            'productimages' => 'required',
            'slug' => ['required','unique:products,slug,'.$this->productid],
            'optionprice.0'=>'required',
            'optionqty.0' =>'required',
            'optionprice.*'=>'required',
            'optionqty.*' =>'required'
        ]);
     }else{
        $this->validate( [
            'name' => 'required',
            'price' =>'required',
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
            }
            $product->collections()->sync($dados);
            $dados=[];
            if($this->newselectedbrands!=[]){
                foreach($this->newselectedbrands as $index=>$brand){
                  $dados=Arr::add($dados,$brand,['brand_id'=>$brand,'sort'=>100]);
              }
            }
            $product->brands()->sync($dados);


            if($this->habilitavariations){
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
                                foreach ($this->optionimages[$key] as $photo) {

                                    $photo->storeAs(tenant('id') .'/images/catalog/'. $product->id. '/'.$productoption->id ,$photo->getClientOriginalName().'.'. $photo->getClientOriginalExtension() ,'catalogo');

                                }
                            }
                            }

                            $key2 = $key2 + 1;
                            $ultima =  $productoption->id;


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




    
}

