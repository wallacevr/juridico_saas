@extends('layouts.tenant', ['title' => __('General configuration')])

@section('content')
    <form action="{{ route('tenant.layout.store.update') }}" method="POST" id="storeSettings">
        @csrf

        <!-- Block 1 -->
        <div class="flex flex-row flex-wrap">
            <!-- header -->
            <div class="w-full md:w-1/3">
                <div class="px-4 md:px-0">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">{{ __('Store Layout Configuration') }}
                    </h3>
                    <p class="mt-1 text-sm leading-5 text-gray-600">
                        {{ __('Here you can customize your store') }}
                    </p>
                </div>
            </div>

            <!-- body -->
            <div class="-0 w-full md:w-2/3 pl-0 md:pl-2">
                <div class="shadow overflow-hidden sm:rounded-md">

                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="flex flex-row flex-wrap">
                            <div class="w-full md:w-1/2">
                              
                                <div class="">
                                    
                                    <input type="color" name="primary_color" id="color-picker" value="{{get_config('general/layout/primary_color')??"#FFFFFF"}}" class="mt-1  bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none sm:text-sm">
                                    <label>Background primario</label>
                                </div>
                                <div class="">
                                    
                                    <input type="color" name="title_primary_color" id="color-picker" value="{{get_config('general/layout/title_primary_color')??"#FFFFFF"}}" class="mt-1  bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none sm:text-sm">
                                    <label>Texto primario</label>
                                </div>
                                <div class="">
                                    
                                    <input type="color" name="title_primary_color_hover" id="color-picker" value="{{get_config('general/layout/title_primary_color_hover')??"#FFFFFF"}}" class="mt-1  bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none sm:text-sm">
                                    <label>Texto primario hover</label>
                                </div>
                                @include('layouts.snippets.divide')
                                <div class="">
                                    
                                    <input type="color" name="secundary_color" id="color-picker" value="{{get_config('general/layout/secundary_color')??"#FFFFFF"}}" class="mt-1  bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none sm:text-sm">
                                    <label>Background secundario</label>
                                </div>
                                <div class="">
                                    
                                    <input type="color" name="title_secundary_color" id="color-picker" value="{{get_config('general/layout/title_secundary_color')??"#FFFFFF"}}" class="mt-1  bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none sm:text-sm">
                                    <label>Texto secundario</label>
                                </div>
                                <div class="">
                                    
                                    <input type="color" name="title_secundary_color_hover" id="color-picker" value="{{get_config('general/layout/title_secundary_color_hover')??"#FFFFFF"}}" class="mt-1  bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none sm:text-sm">
                                    <label>Texto secundario hover</label>
                                </div>
                                @include('layouts.snippets.divide')
                                <div class="">
                                    
                                    <input type="color" name="background_footer" id="color-picker" value="{{get_config('general/layout/background_footer')??"#FFFFFF"}}" class="mt-1  bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none sm:text-sm">
                                    <label>Background rodapé</label>
                                </div>
                                <div class="">
                                    <input type="color" name="text_footer" id="color-picker" value="{{get_config('general/layout/text_footer')??"#FFFFFF"}}" class="mt-1  bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none sm:text-sm">
                                    <label>Texto rodapé</label>
                                </div>
                                @include('layouts.snippets.divide')
                                <div class="">
                                    <input type="color" name="text_price" id="color-picker" value="{{get_config('general/layout/text_price')??"#FFFFFF"}}" class="mt-1  bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none sm:text-sm">
                                    <label>Texto preço</label>
                                </div>
                                <div class="">
                                    <input type="color" name="text_price_with_special" id="color-picker" value="{{get_config('general/layout/text_price_with_special')??"#FFFFFF"}}" class="mt-1  bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none sm:text-sm">
                                    <label>Texto preço tachado</label>
                                </div>
                                <div class="">
                                    <input type="color" name="text_special_price" id="color-picker" value="{{get_config('general/layout/text_special_price')??"#FFFFFF"}}" class="mt-1  bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none sm:text-sm">
                                    <label>Texto preço especial</label>
                                </div>
                                @include('layouts.snippets.divide')
                                <div class="">
                                    <input type="color" name="background_add_cart" id="color-picker" value="{{get_config('general/layout/background_add_cart')??"#FFFFFF"}}" class="mt-1  bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none sm:text-sm">
                                    <label>Background adicionar ao carrinho</label>
                                </div>
                                <div class="">
                                    <input type="color" name="text_add_cart" id="color-picker" value="{{get_config('general/layout/text_add_cart')??"#FFFFFF"}}" class="mt-1  bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none sm:text-sm">
                                    <label>Texto adicionar ao carrinho</label>
                                </div>
                                <div class="">
                                    <input type="color" name="background_add_cart_hover" id="color-picker" value="{{get_config('general/layout/background_add_cart_hover')??"#FFFFFF"}}" class="mt-1  bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none sm:text-sm">
                                    <label>Background adicionar ao carrinho hover</label>
                                </div>
                              
                                <div class="">
                                    <input type="color" name="text_add_cart_hover" id="color-picker" value="{{get_config('general/layout/text_add_cart_hover')??"#FFFFFF"}}" class="mt-1  bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none sm:text-sm">
                                    <label>Texto adicionar ao carrinho hover</label>
                                </div>

                            </div>
                            
                        </div>
                    </div>

               


                </div>
            </div>
        </div>

      

        @include('layouts.snippets.save')

    </form>
@endsection
