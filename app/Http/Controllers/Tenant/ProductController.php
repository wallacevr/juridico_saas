<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Product;
use App\Brand;
use App\Collection;
use Illuminate\Http\Request;
use File;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $search = request('q');
        if (!empty($search)) {

            $products = Product::orWhere([
                ['name', 'like', '%' . $search . '%']
            ])->orWhere(
                [['sku', 'like', '%' . $search . '%']]);

        } else {
            $products = Product::query();
            
        }

        return view('tenant.products.index', [
            'products' => $products->paginate(25),'q'=>$search
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $collections = Collection::all();
        return view('tenant.products.create',compact('collections'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'slug' => ['required','unique:products'],
        ]);

        $data = $request->all();
        
        if(!empty($data['fileuploader-list-files'])){
            $files = json_decode($data['fileuploader-list-files'],1);   
            foreach($files as $file){
                $uploadDir = getStoragerImagePath("catalog");
                $destination = getStoreImagePath('catalog');
                if(is_file($uploadDir.$file['file'])){
                    File::move($uploadDir.$file['file'],$destination.$file['file']);
                }

            }
        }
        $data['slug'] = generateSlug($data['slug'], 'products');
        if(!empty($data['fileuploader-list-files']))
            unset($data['fileuploader-list-files']);
        

        
        
        if(!empty($data['collections'])){
            $collections = $data['collections'];

            unset($data['collections']);
        }
        
        if(!empty($data['imagename'])){
            $imagename = $data['imagename'];
            unset($data['imagename']);
        }
        
      
        $product = Product::create($data);
        foreach($files as $index=>$file){
            $title = $imagename[ $index]??'';
            $product->images()->create(['image_url'=>$file['file'],'sort'=>$file['index'],'title'=>$title]);
        }

        $dados=[];   
        foreach($collections as $index=>$collection){
            $dados=Arr::add($dados,$collection,['collection_id'=>$collection,'sort'=>100]);
        }
       
        
        $product->collections()->sync($dados);
        if (!$product->save()) {
            return back()->withInput()->with("error", "Error creating product.");
        }
  
        return redirect()->route('tenant.products.index')->with("success", "Product created successfully!");

   
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $collections=Collection::all();
        $brand=Brand::find($product->brand_id);
        return view('tenant.products.edit',compact('product','brand','collections'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'slug' => ['required','unique:products,slug,'. $product->id],
        ]);

        $data = $request->all();
       
        if(!empty($data['fileuploader-list-files'])){
            $files = json_decode($data['fileuploader-list-files'],1);   
            foreach($files as $file){
                $uploadDir = getStoragerImagePath("catalog");
                $destination = getStoreImagePath('catalog');
                if(is_file($uploadDir.$file['file'])){
                    File::move($uploadDir.$file['file'],$destination.$file['file']);
                }

            }
       
       
        if(!empty($data['fileuploader-list-files']))
            unset($data['fileuploader-list-files']);
        

            if(!empty($data['imagename'])){
                $imagename = $data['imagename'];
                unset($data['imagename']);
            }
        }
        
        if(!empty($data['collections'])){
            $collections = $data['collections'];

            unset($data['collections']);
        }
        
        $imagescarregadas= array_column($files,'file');
       
      
        foreach($product->images as $imagem){
            if(!in_array(tenant_public_path().'/images/catalog/'.$imagem->image_url,$imagescarregadas)){
                deleteImage( $imagem->image_url, 'catalog');
                $product->images()->where('id',$imagem->id)->delete();
               
            }
        }
        
       
        $i=0;
        foreach($files as $index=>$file){
            if(substr($file['file'],0,73)!= tenant_public_path()){
                $title = $imagename[$i];
                $product->images()->create(['image_url'=>$file['file'],'sort'=>$file['index'],'title'=>$title]);
                $i+=1;
             }
        }
   
        $dados=[];   
        foreach($collections as $index=>$collection){
            $dados=Arr::add($dados,$collection,['collection_id'=>$collection,'sort'=>100]);
        }
       
        
        $product->collections()->sync($dados);
        if (!$product->update($data)) {
            return back()->withInput()->with("error", "Error updating product.");
        }
  
        return redirect()->route('tenant.products.index')->with("success", "Product updated successfully!");

   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if (!$product->delete()) {
            return redirect()->route('tenant.products.index')->with("error", "Error deleting product.");
        }
        foreach($product->images as $image)
        deleteImage($image->image_url, 'catalog');

        return redirect()->route('tenant.products.index')->with("success", "Product deleted successfully");
   
    }
}
