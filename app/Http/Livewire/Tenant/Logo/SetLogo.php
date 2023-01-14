<?php

namespace App\Http\Livewire\Tenant\Logo;
use Livewire\WithFileUploads;
use Livewire\Component;
use App\Models\Config;
class SetLogo extends Component
{
    use WithFileUploads;
    public $desktop;
    public $mobile;
    public $email;
    public $checkout;
    public $initiallogos=[];
    public $initialkey;
    public function render()
    {
        return view('livewire.tenant.logo.set-logo');
    }

    public function mount(){
        $path = __DIR__."/../../../../../../storage/tenant".tenant('id') .'/framework/cache';
        
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }
        
        if(get_config('general/store/logo/mobile') !=null){
            $this->initiallogos['mobile']="{source:'".publicImage(get_config('general/store/logo/mobile'))  ."'},";
        }else{
            $this->initiallogos['mobile']='';
        }
        if(get_config('general/store/logo/desktop')!=null){
            $this->initiallogos['desktop']="{source:'". publicImage(get_config('general/store/logo/desktop') )  ."'},";
        }else{
            $this->initiallogos['desktop']='';
        }
        if(get_config('general/store/logo/email')!=null){
            $this->initiallogos['email']="{source:'". publicImage(get_config('general/store/logo/email'))   ."'},";
        }else{
            $this->initiallogos['email']='';
        }
        if(get_config('general/store/logo/checkout')!=null){
            $this->initiallogos['checkout']="{source:'". publicImage(get_config('general/store/logo/checkout'))   ."'},";
        }else{
            $this->initiallogos['checkout']='';
        }
      
    }

    public function store(){
        $this->validate([
           'desktop'=>'required',
           'mobile'=>'required',
           'email'=>'required',
           'checkout'=>'required',
        ]);
        try {
            Config::createOrUpdate('general/store/logo/desktop','logo/desktop.'.$this->desktop->getClientOriginalExtension());
            $this->desktop->storeAs(tenant('id') . '/images/logo/','desktop.'.$this->desktop->getClientOriginalExtension() ,'publictenant');
            Config::createOrUpdate('general/store/logo/mobile','logo/mobile.'.$this->mobile->getClientOriginalExtension() );
            $this->mobile->storeAs(tenant('id') .'/images/logo/','mobile.'.$this->mobile->getClientOriginalExtension() ,'publictenant');
            Config::createOrUpdate('general/store/logo/email','logo/email.'.$this->email->getClientOriginalExtension());
            $this->email->storeAs(tenant('id') .'/images/logo/','email.'.$this->email->getClientOriginalExtension() ,'publictenant');
            Config::createOrUpdate('general/store/logo/checkout','logo/checkout.'.$this->checkout->getClientOriginalExtension() );
            $this->checkout->storeAs(tenant('id') .'/images/logo/','checkout.'.$this->checkout->getClientOriginalExtension() ,'publictenant');
            return redirect()->route('tenant.admin.dashboad')->with("success",  __('Store information updated.'));
           
        } catch (\Throwable $th) {
            //throw $th;
          
        }

    }

}
