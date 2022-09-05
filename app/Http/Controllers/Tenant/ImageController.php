<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Config;
use App\Rules\DocumentId;
use App\Rules\Hex;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tenant.layout.image');
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
            'thumb_width' => ['required', 'integer'],
            'thumb_height' => ['required', 'integer'],
            'small_width' => ['required', 'integer'],
            'small_height' => ['required', 'integer'],
            'medium_width' => ['required', 'integer'],
            'medium_height' => ['required', 'integer'],
            'big_width' => ['required', 'integer'],
            'big_height' => ['required', 'integer'],
        ]);


        Config::createOrUpdate('general/layout/thumb_width', $validated['thumb_width']);
        Config::createOrUpdate('general/layout/thumb_height', $validated['thumb_height']);
        Config::createOrUpdate('general/layout/small_width', $validated['small_width']);
        Config::createOrUpdate('general/layout/small_height', $validated['small_height']);
        Config::createOrUpdate('general/layout/medium_width', $validated['medium_width']);
        Config::createOrUpdate('general/layout/medium_height', $validated['medium_height']);
        Config::createOrUpdate('general/layout/big_width', $validated['big_width']);
        Config::createOrUpdate('general/layout/big_height', $validated['big_height']);
        


        return redirect()->back()->with('success', __('Store information updated.'));
    }
}
