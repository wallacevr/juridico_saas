<?php

namespace App\Http\Livewire\Store\Product;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use App\Product;
use App\ProductColletion;
use Auth;
use App\Collection;

class Search extends Component
{
    public $search;
    public $collectionid;
    public $collections=[];
    public $products=[]; 
    public $searchindescription=0;
    public function render()
    {

        return view('livewire.store.product.search');
    }


    public function mount(){
        $this->collections=Collection::Where('status',1)->get();

    }


    public function search(){
       if($this->search!=null){
            if($this->collectionid==0){
                if($this->searchindescription==1){
                  
                    $this->products = Product::where('name','like','%'. $this->search .'%' )
                    ->orWhere('description','like','%'. $this->search .'%' )->get();
                }else{
                  
                    $this->products = Product::where('name','like','%'. $this->search .'%' )
                    ->get();
                }
            }else{
                if($this->searchindescription==1){
                    $productscollection = ProductColletion::where('collection_id',$this->collectionid)->get()->pluck('product_id');
                    $this->products = Product::where('name','like','%'. $this->search .'%' )
                    ->orWhere('description','like','%'. $this->search .'%' )->get()->whereIn('id',$productscollection);
                }else{
                    $productscollection = ProductColletion::where('collection_id',$this->collectionid)->get()->pluck('product_id');
                    $this->products = Product::where('name','like','%'. $this->search .'%' )
                    ->get()->whereIn('id',$productscollection);
                }

              
            }
               
       } 
    }
    public function teste(){
    $this->render();
    }
    public function updated(){
        $this->search();
       
    }
}
