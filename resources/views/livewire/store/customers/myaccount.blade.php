<div class="mb-5" >
    <ul class="nav nav-pills flex flex-col md:flex-row flex-wrap list-none pl-0 mb-4" id="pills-tab" role="tablist">
    <li class="nav-item" role="presentation">
        <a href="#pills-profile" wire:click="settabh('profile')" class="
        nav-link
        block
        font-medium
        text-xs
        leading-tight
        uppercase
        rounded
        px-6
        py-3
        my-2
        md:mr-2
        focus:outline-none focus:ring-0
        active
        " id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" role="tab" aria-controls="pills-profile"
        aria-selected="true">{{ __('Account information') }}</a>
    </li>

    <li class="nav-item" role="presentation">
        <a href="#pills-myorders" wire:click="settabh('myorders')" class="
        nav-link
        block
        font-medium
        text-xs
        leading-tight
        uppercase
        rounded
        px-6
        py-3
        my-2
        md:mx-2
        focus:outline-none focus:ring-0
        " id="pills-myorders-tab" data-bs-toggle="pill" data-bs-target="#pills-myorders" role="tab"
        aria-controls="pills-myorders" aria-selected="false">{{ __('My orders') }}</a>
    </li>

    
    </ul>
    <div class="tab-content" id="pills-tabContent">
    @if($tabh == 'profile')
        <div class="tab-pane fade show active mx-10" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
    @else
         <div class="tab-pane fade   mx-10" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
    @endif

                <div class="flex items-start">
                    <ul class="nav nav-pills flex flex-col flex-wrap list-none pl-0 mr-4" id="pills-tabVertical" role="tablist">

                        <li class="nav-item flex-grow text-center my-2" role="presentation">
                        <a href="#pills-profileVertical" wire:click="settabv('profile')" class="
                            nav-link
                            block
                            font-medium
                            text-xs
                            leading-tight
                            uppercase
                            rounded
                            px-6
                            py-3
                            focus:outline-none focus:ring-0
                            " id="pills-profile-tabVertical" data-bs-toggle="pill" data-bs-target="#pills-profileVertical" role="tab"
                            aria-controls="pills-profileVertical" aria-selected="false">Profile</a>
                        </li>
                        <li class="nav-item flex-grow text-center my-2" role="presentation">
                        <a href="#pills-addressesVertical" wire:click="settabv('address')" class="
                            nav-link
                            block
                            font-medium
                            text-xs
                            leading-tight
                            uppercase
                            rounded
                            px-6
                            py-3
                            focus:outline-none focus:ring-0
                            " id="pills-addresses-tabVertical" data-bs-toggle="pill" data-bs-target="#pills-addressesVertical" role="tab"
                            aria-controls="pills-addressesVertical" aria-selected="false">{{ __('My addresses') }}</a>
                        </li>
                        <li class="nav-item flex-grow text-center my-2" role="presentation">
                        <a href="#pills-passwordVertical" wire:click="settabv('changepassword')"  class="
                            nav-link
                            block
                            font-medium
                            text-xs
                            leading-tight
                            uppercase
                            rounded
                            px-6
                            py-3
                            focus:outline-none focus:ring-0
                            " id="pills-password-tabVertical" data-bs-toggle="pill" data-bs-target="#pills-passwordVertical" role="tab"
                            aria-controls="pills-passwordVertical" aria-selected="false">{{ __('Change password') }}</a>
                        </li>
                        <li class="nav-item flex-grow text-center my-2" role="presentation">
                        <a href="#pills-wishlistVertical" wire:click="settabv('wishlist')" class="
                            nav-link
                            block
                            font-medium
                            text-xs
                            leading-tight
                            uppercase
                            rounded
                            px-6
                            py-3
                            focus:outline-none focus:ring-0
                            " id="pills-wishlist-tabVertical" data-bs-toggle="pill" data-bs-target="#pills-wishlistVertical" role="tab"
                            aria-controls="pills-wishlistVertical" aria-selected="false">{{ __('Wishlist') }}</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContentVertical">
                    @if($tabv == 'profile')
                        <div class="tab-pane fade show active" wire:click="settabv('profile')" id="pills-profileVertical" role="tabpanel" aria-labelledby="pills-profile-tabVertical">
                    @else
                         <div class="tab-pane fade show " wire:click="settabv( 'profile')"  id="pills-profileVertical" role="tabpanel" aria-labelledby="pills-profile-tabVertical">
                    @endif
                        
                             <div class="w-full bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                                 <h1 class="text-center my-4 text-lg font-semibold leading-snug uppercase" >{{ __('Account information') }}</h1>
                                  <div class="grid grid-cols-1 md:grid-cols-12">
                                         @if (session('success'))
                                            <div class="col-span-8 mx-2 p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
                                                 <span class="font-medium">{{ session('success') }}</span> 
                                            </div>

                                        @endif
                                        <div class="col-span-6 mx-2">
                                            @include('layouts.snippets.fields', ['type'=>'text', 'label'=>'Full name', 'placeholder'=>'', 'name'=>'name', 'value'=> '','wiremodel'=>'name'])
                                        </div>

                                        <div class="col-span-4 mx-2">
                                            @include('layouts.snippets.fields', ['type'=>'email', 'label'=>'Email address', 'placeholder'=>'', 'name'=>'email', 'value'=> '','wiremodel'=>'email' ])
                                        </div>
                                            <!-- ... -->
                                        
                             
                                 
                                            <div class="col-span-6 mx-2">
                                                @include('layouts.snippets.fields', ['type'=>'text', 'label'=>'Taxvat', 'placeholder'=>'___.___.___-__', 'name'=>'taxvat', 'value'=> '','wiremodel'=>'taxvat' ])
                                            </div>

                                            <div class="col-span-4 mx-2">
                                                <label for="dob" class="block text-sm font-medium leading-5 text-gray-700">
                                                    {{ __('Birth Date') }}
                                                </label>
                                                <div class=" rounded-md">
                                                    <input name="dob" id="dob" type="date" class="shadow-sm appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5" wire:model="dob"/>

                                                    @error('dob')
                                                    <p class="text-red-500 text-xs italic mt-4">
                                                        {{ $message }}
                                                    </p>
                                                    @enderror
                                                </div>
                                                
                                            </div>




                                           <div class="col-span-6 mx-2">
                                                @include('layouts.snippets.fields', ['type'=>'text', 'label'=>'Phone', 'placeholder'=>'(__)_____-____', 'name'=>'phone', 'value'=> '' ,'wiremodel'=>'phone'])
                                            </div>

                                            <div class="col-span-4 mx-2">
                                                @include('layouts.snippets.fields', ['type'=>'text', 'label'=>'Telephone', 'placeholder'=>'(__)____-____', 'name'=>'telephone', 'value'=> '','wiremodel'=>'telephone' ])
                                            </div>
                                            <span class="col-span-12 my-5 text-center">
                                                <button type="button"  wire:click="storeprofile"
                                                    class="py-1 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 shadow-sm hover:bg-indigo-500 focus:outline-none focus:shadow-outline-blue focus:bg-indigo-500 active:bg-indigo-600 transition duration-150 ease-in-out">
                                                    {{ __('Save') }}
                                                </button>
                                            </span>
                          
                                    </div>
                                </div>




                        </div>
                        @if($tabv == 'address') 
                            <div class="tab-pane fade show active" id="pills-addressesVertical" role="tabpanel"
                            aria-labelledby="pills-addresses-tabVertical">
                        @else
                            <div class="tab-pane fade" id="pills-addressesVertical" role="tabpanel"
                            aria-labelledby="pills-addresses-tabVertical">
                        @endif
                        <div class="w-full bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                            <h1 class="text-center my-4 text-lg font-semibold leading-snug uppercase" >{{ __('My addresses')  }}</h1>
                                  <div class="grid grid-cols-1 md:grid-cols-4">
                                         <div class="col-span-4 mx-2">
                                          <select class="w-1/2 px-4 py-3 rounded-full" wire:change="setaddress" wire:model="id_address">
                                                @foreach($addresses as $address)
                                                    <option value="{{$address->id}}">{{$address->name}}</option>
                                                @endforeach
                                          </select>
                                          <button wire:click="createnewadress" class="rounded-full text-white bg-indigo-600 shadow-sm hover:bg-indigo-500 focus:outline-none focus:shadow-outline-blue focus:bg-indigo-500 active:bg-indigo-600 transition duration-150 ease-in-out px-2">+</button>
                                        </div>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-12">
                                 
                                        @if (session('success'))
                                            <div class="col-span-8 mx-2 p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
                                                 <span class="font-medium">{{ session('success') }}</span> 
                                            </div>

                                        @endif
                                     
                                        <div class="col-span-8 mx-2">
                                             @include('layouts.snippets.fields', ['type'=>'text', 'label'=>'Address Name', 'placeholder'=>'Address Name', 'name'=>'addressname', 'value'=> '' ,'wiremodel'=>'addressname'])
                                        </div>
                                    
                                        <div class="col-span-2 mx-2">
                                             @include('layouts.snippets.fields', ['type'=>'text', 'label'=>'Postalcode', 'placeholder'=>'_____-___', 'name'=>'postalcode', 'value'=> '' ,'wiremodel'=>'postalcode','wirechange'=>'refreshaddress'])
                                        </div>
                                 
                                        <div class="col-span-8 mx-2">
                                 
                                                @include('layouts.snippets.fields', ['type'=>'text', 'label'=>'Address', 'placeholder'=>'', 'name'=>'address', 'value'=> '' ,'wiremodel'=>'address'])
                                        </div>
                                
                                        
                             
                                 
                                            <div class="col-span-2 mx-2">
                                                   @include('layouts.snippets.fields', ['type'=>'text', 'label'=>'Number', 'placeholder'=>'', 'name'=>'number', 'value'=> '','wiremodel'=>'number' ])
                                            </div>

                                            <div class="col-span-8 mx-2">
                                                   @include('layouts.snippets.fields', ['type'=>'text', 'label'=>'Neighborhood', 'placeholder'=>'', 'name'=>'neighborhood', 'value'=> '' , 'wiremodel'=>'neighborhood'])
                                                
                                            </div>




                                           <div class="col-span-2 mx-2">
                                                  @include('layouts.snippets.fields', ['type'=>'text', 'label'=>'Complement', 'placeholder'=>'', 'name'=>'complement', 'value'=> '' , 'wiremodel'=>'complement'])
                                            </div>

                                            <div class="col-span-5 mx-2">
                                                  @include('layouts.snippets.fields', ['type'=>'text', 'label'=>'City', 'placeholder'=>'', 'name'=>'city', 'value'=> '', 'wiremodel'=>'city' ])
                                            </div>

                                            <div class="col-span-3 mx-2">
                                            
                                                <label for="country" class="block text-sm font-medium text-gray-700">
                                                    {{ __('Country') }}
                                                </label>
                                                <select name="country" class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" wire:model="country">
                                                    <option selected disabled>{{ __('Select one of the options') }}</option>
                                                    <option value="BR">
                                                        {{ __('Brazil') }}
                                                    </option>
                                                </select>
                                                @error('country')
                                                <p class="mt-2 text-sm text-red-500">
                                                    {{ $message }}
                                                </p>
                                                @enderror
                                            </div>  
                                            <div class="col-span-1 mx-1">
                                                  @include('layouts.snippets.fields', ['type'=>'text', 'label'=>'State', 'placeholder'=>'', 'name'=>'state', 'value'=> '','wiremodel'=>'state' ])
                                            </div>  
                                            <span class="col-span-12 my-5 text-center">
                                                <button type="button" 
                                                    class="py-1 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 shadow-sm hover:bg-indigo-500 focus:outline-none focus:shadow-outline-blue focus:bg-indigo-500 active:bg-indigo-600 transition duration-150 ease-in-out"
                                                    @if($newaddress)
                                                        wire:click="storeaddress"
                                                    @else
                                                         wire:click="updateaddress"
                                                    @endif
                                                    >
                                                    {{ __('Save') }}
                                                </button>
                                            </span>                     
                                    </div>
                                </div>
                        </div>
                        @if($tabv == 'changepassword')
                            <div class="tab-pane fade show active" wire:click="settabv('changepassword')" id="pills-password-tabVertical" role="tabpanel" aria-labelledby="pills-password-tabVertical">
                         @else
                             <div class="tab-pane fade show " wire:click="settabv( 'changepassword')"  id="pills-password-tabVertical" role="tabpanel" aria-labelledby="pills-password-tabVertical">
                          @endif
                      
                          <div class="w-full bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                          <h1 class="text-center my-4 text-lg font-semibold leading-snug uppercase" >{{__('Change password') }}</h1>
                                <div class="grid grid-cols-1 md:grid-cols-12">
                                        @if (session('success'))
                                            <div class="col-span-8 mx-2 p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
                                                 <span class="font-medium">{{ session('success') }}</span> 
                                            </div>

                                        @endif
                                </div>
                            <div class="grid grid-cols-1 md:grid-cols-12">

                                <div class="col-span-4 mx-2">
                                     @include('layouts.snippets.fields', ['type'=>'password', 'label'=>'Password', 'placeholder'=>'Password', 'name'=>'password', 'value'=> '' ,'wiremodel'=>'password'])
                                </div>
                                <div class="col-span-4 mx-2">
                                     @include('layouts.snippets.fields', ['type'=>'password', 'label'=>'Confirm password', 'placeholder'=>'Confirm Password', 'name'=>'confirm_password', 'value'=> '' ,'wiremodel'=>'password_confirmation'])
                                </div>
                                <div class="col-span-4 mx-2">
                                   
                                </div>
                                <span class="col-span-12 my-5 text-center">
                                    <button type="button"  wire:click="changepassword"
                                        class="py-1 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 shadow-sm hover:bg-indigo-500 focus:outline-none focus:shadow-outline-blue focus:bg-indigo-500 active:bg-indigo-600 transition duration-150 ease-in-out">
                                        {{ __('Save') }}
                                    </button>
                                </span>
                            </div>
                        </div>
                       
          

              
                            </div>
                            @if($tabv == 'wishlist')
                            <div class="tab-pane fade show active" wire:click="settabv('wishlist')" id="pills-wishlist-tabVertical" role="tabpanel" aria-labelledby="pills-wishlist-tabVertical">
                         @else
                             <div class="tab-pane fade show " wire:click="settabv( 'wishlist')"  id="pills-wishlist-tabVertical" role="tabpanel" aria-labelledby="pills-wishlist-tabVertical">
                          @endif

                          <div class="w-full bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                          <h1 class="text-center my-4 text-lg font-semibold leading-snug uppercase" >{{__("Wishlist")}}</h1>
                                <div class="grid grid-cols-1 md:grid-cols-12">
                                        @if (session('success'))
                                            <div class="col-span-8 mx-2 p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
                                                 <span class="font-medium">{{ session('success') }}</span> 
                                            </div>

                                        @endif
                                </div>
                            <div class="grid grid-cols-1 md:grid-cols-11">
                                       
                                         @if ($wishlistproducts)
            
                                                @foreach ($wishlistproducts as $wishlistproduct)
                                                <div class="col-span-2 mx-2">
                                                         <img class="flex-shrink-0  dark:border-transparent rounded outline-none dark:bg-gray-500 h-20"
                                                                    src="{{ productImage($wishlistproduct->id .'/'. $wishlistproduct->images[0]->image_url) }}" alt="{{ $wishlistproduct->name }}">
                                                </div>
                                                <div class="col-span-7 mx-2">
                                                    <h3 class="text-lg font-semibold leading-snug sm:pr-8">{{ $wishlistproduct->name }} </h3>
                                                </div>
                                                <div class="col-span-2 mx-2">
                                                       @if($wishlistproduct->formattedPrice()>$wishlistproduct->formattedFinalPrice())
                                                             <h3 class="text-lg font-semibold leading-snug sm:pr-8 line-through"> {{$wishlistproduct->formattedPrice()}}</h3>
                                                            <h3 class="text-lg font-semibold leading-snug sm:pr-8">{{$wishlistproduct->formattedFinalPrice()}}</h3>
                                                       @else
                                                            <h3 class="text-lg font-semibold leading-snug sm:pr-8 line-through"> {{$wishlistproduct->formattedPrice()}}</h3>
                                                       @endif
                                                </div>
                                                

                                                @endforeach
                                            @endif
                        </div>
                    </div>
            </div>


        </div>
    @if($tabh=='myorders')     
        <div class="tab-pane fade show active" id="pills-myorders" role="tabpanel" aria-labelledby="pills-orders-tab">
    @else
        <div class="tab-pane fade" id="pills-myorders" role="tabpanel" aria-labelledby="pills-orders-tab">
    @endif
             My Orders
         </div>
    </div>
 

    </div>
</div>
