<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Config;
use App\Rules\DocumentId;
use App\Rules\Hex;
use Illuminate\Http\Request;

class LayoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tenant.layout.general');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        
        $validated = $this->validate($request, [
            'primary_color' => ['required', 'string', new Hex()],
            'secundary_color' => ['required', 'string', new Hex()],
            'title_primary_color' => ['required', 'string', new Hex()],
            'title_primary_color_hover' => ['required', 'string', new Hex()],
            'title_secundary_color' => ['required', 'string', new Hex()],
            'title_secundary_color_hover' => ['required', 'string', new Hex()],
            'text_footer' => ['required', 'string', new Hex()],
            'background_footer' => ['required', 'string', new Hex()],
            'text_price' => ['required', 'string', new Hex()],
             'text_special_price' => ['required', 'string', new Hex()],
            'background_add_cart' => ['required', 'string', new Hex()],
            'background_add_cart_hover' => ['required', 'string', new Hex()],
            'text_add_cart' => ['required', 'string', new Hex()],
            'text_add_cart_hover' => ['required', 'string', new Hex()],
        ]);


        Config::createOrUpdate('general/layout/primary_color', $validated['primary_color']);
        Config::createOrUpdate('general/layout/secundary_color', $validated['secundary_color']);
        Config::createOrUpdate('general/layout/title_primary_color', $validated['title_primary_color']);
        Config::createOrUpdate('general/layout/title_primary_color_hover', $validated['title_primary_color_hover']);
        Config::createOrUpdate('general/layout/title_secundary_color', $validated['title_secundary_color']);
        Config::createOrUpdate('general/layout/title_secundary_color_hover', $validated['title_secundary_color_hover']);
        Config::createOrUpdate('general/layout/background_footer', $validated['background_footer']);
        Config::createOrUpdate('general/layout/text_footer', $validated['text_footer']);
        Config::createOrUpdate('general/layout/text_price', $validated['text_price']);
         Config::createOrUpdate('general/layout/text_special_price', $validated['text_special_price']);
        Config::createOrUpdate('general/layout/background_add_cart', $validated['background_add_cart']);
        Config::createOrUpdate('general/layout/background_add_cart_hover', $validated['background_add_cart_hover']);
        Config::createOrUpdate('general/layout/text_add_cart', $validated['text_add_cart']);
        Config::createOrUpdate('general/layout/text_add_cart_hover', $validated['text_add_cart_hover']);


        return redirect()->back()->with('success', __('Store information updated.'));
    }
}
