<?php

namespace App\Http\Controllers\Tenant;
use App\Http\Controllers\Controller;
use App\Models\Config;
use Illuminate\Http\Request;

class ConfigurationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tenant.settings.general');
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
            
            'email' => [
                'required',
                'string',
                'email',
                'max:255'
            ],
            'name' => ['required', 'string', 'min:5'],
            'postalcode' => ['required', 'string', 'min:5'],
            'address' => ['required', 'string', 'min:10'],
            'neighborhood' => ['string'],
            'number' => ['string'],
            'complement' => ['string'],
            'city' => ['required', 'string'],
            'state' => ['required', 'string'],
            'phone' => ['required', 'string', 'min:10'],
            'whatsapp' => ['string', 'min:10'],
            'facebook' => ['url','string', 'min:10'],
            'instagram' => ['url','string', 'min:10'],
            'youtube' => ['url','string', 'min:10'],
            'pinterest' => ['url','string', 'min:10'],
        ]);

   
        Config::where('path', 'general/store/name')->update(['value' => $validated['name']]);
        Config::where('path', 'general/store/email')->update(['value' => $validated['email']]);
        Config::where('path', 'general/store/postalcode')->update(['value' => $validated['postalcode']]);
        Config::where('path', 'general/store/address')->update(['value' => $validated['address']]);
        Config::where('path', 'general/store/neighborhood')->update(['value' => $validated['neighborhood']]);
        Config::where('path', 'general/store/number')->update(['value' => $validated['number']]);
        Config::where('path', 'general/store/complement')->update(['value' => $validated['complement']]);
        Config::where('path', 'general/store/city')->update(['value' => $validated['city']]);
        Config::where('path', 'general/store/state')->update(['value' => $validated['state']]);
        Config::where('path', 'general/store/phone')->update(['value' => $validated['phone']]);
        Config::where('path', 'general/store/whatsapp')->update(['value' => $validated['whatsapp']]);
        Config::where('path', 'general/store/social_facebook')->update(['value' => $validated['facebook']]);
        Config::where('path', 'general/store/social_instagram')->update(['value' => $validated['instagram']]);
        Config::where('path', 'general/store/social_youtube')->update(['value' => $validated['youtube']]);
        Config::where('path', 'general/store/social_pinterest')->update(['value' => $validated['pinterest']]);
       
       
        return redirect()->back()->with('success', __('Store information updated.'));
    }

}
