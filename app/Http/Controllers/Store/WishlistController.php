<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Wishlist;
use Auth;
class WishlistController extends Controller
{
    //
    public function addwishlist($id_product){
        try {
           
            $wishlist = Wishlist::where('id_product',$id_product)->where('id_customer', Auth::guard('customers')->user()->id)->get();
           
            if(count($wishlist)==0){
                $wishlist = new Wishlist;
                $wishlist->id_product = $id_product;
                $wishlist->id_customer = Auth::guard('customers')->user()->id;
                $wishlist->save();
            }
            return redirect()->back();
        } catch (\Throwable $th) {
            //throw $th;
        }

    }
}
