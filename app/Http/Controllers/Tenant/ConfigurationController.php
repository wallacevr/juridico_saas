<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Config;
use App\Rules\DocumentId;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
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

        if(($request->maintenance!="on")&&((get_config('general/layout/thumb_width')==null)||(get_config('general/layout/small_width')==null)||(get_config('general/layout/medium_width')==null)||(get_config('general/layout/big_width')==null))){
          
            throw ValidationException::withMessages([
                'maintenance' => __('Keep your store under maintenance until you configure the entire store.'),
            ]);
        }
        if(($request->maintenance!="on")&&((get_config('plugins/commnunication/whatsapppcheckout/whatsapp')==null)||(get_config('plugins/commnunication/whatsapppcheckout/enabled')!="on"))){
          
            throw ValidationException::withMessages([
                'maintenance' => __("Keep your store under maintenance until you've set up the entire store. Whatsapp chekout settings are not defined"),
            ]);
        }
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
            'neighborhood' => ['required', 'string'],
            'number' => ['string'],
            'complement' => ['string'],
            'city' => ['required', 'string'],
            'state' => ['required', 'string'],
            'phone' => ['required', 'string', 'min:10'],
            'registred_company_name' => ['required', 'string', 'min:10'],
            'taxvat' => ['required', 'string', 'min:18',new DocumentId],
            'company_email' => [
                'required',  'string',
                'email',
                'max:255'
            ],

            'whatsapp' => ['string', 'min:10'],
            'facebook' => ['url', 'string', 'min:10'],
            'instagram' => ['url', 'string', 'min:10'],
            'youtube' => ['url', 'string', 'min:10'],
            'pinterest' => ['url', 'string', 'min:10'],
          
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

        if($request->maintenance=="on"){
            Config::where('path', 'general/store/maintenance')->update(['value' => 1]);
        }else{
            Config::where('path', 'general/store/maintenance')->update(['value' => 0]);
        }
       
     /*
        Config::createOrUpdate('general/store/email_sender',$validated['email_sender']);
        Config::createOrUpdate('general/store/smtp_mail_host', $validated['smtp_mail_host']);
        Config::createOrUpdate('general/store/mail_port',$validated['mail_port']);
        Config::createOrUpdate('general/store/email_sender_password', $validated['email_sender_password']);
        Config::createOrUpdate('general/store/email_sender_encryption', $validated['email_sender_encryption']);
        Config::createOrUpdate('general/store/email_sender_name', $validated['email_sender_name']);
*/
        Config::where('path', 'general/store/registred_company_name')->update(['value' => $validated['registred_company_name']]);
        Config::where('path', 'general/store/taxvat')->update(['value' => $validated['taxvat']]);
        Config::where('path', 'general/store/company_email')->update(['value' => $validated['company_email']]);
        Config::where('path', 'general/store/phone')->update(['value' => $validated['phone']]);
        Config::where('path', 'general/store/whatsapp')->update(['value' => $validated['whatsapp']]);
        Config::where('path', 'general/store/social_facebook')->update(['value' => $validated['facebook']]);
        Config::where('path', 'general/store/social_instagram')->update(['value' => $validated['instagram']]);
        Config::where('path', 'general/store/social_youtube')->update(['value' => $validated['youtube']]);
        Config::where('path', 'general/store/social_pinterest')->update(['value' => $validated['pinterest']]);

       
        return redirect()->back()->with('success', __('Store information updated.'));
    }


    public function setlogos()
    {
        return view('tenant.settings.logos');
    }
}
