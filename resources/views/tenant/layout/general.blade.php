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
            <div class="mt-4 md:mt-0 w-full md:w-2/3 pl-0 md:pl-2">
                <div class="shadow overflow-hidden sm:rounded-md">

                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="flex flex-row flex-wrap">
                            <div class="w-full md:w-1/2">
                              
                                <div class="mt-4  pr-2">
                                    
                                    <input type="color" name="primary_color" id="color-picker" value="{{get_config('general/layout/primary_color')??"#FFFFFF"}}" class="mt-1  bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none sm:text-sm">
                                    <label>Background primario</label>
                                </div>
                                <div class="mt-4  pr-2">
                                    
                                    <input type="color" name="secundary_color" id="color-picker" value="{{get_config('general/layout/secundary_color')??"#FFFFFF"}}" class="mt-1  bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none sm:text-sm">
                                    <label>Background secundario</label>
                                </div>
                                <div class="mt-4  pr-2">
                                    
                                    <input type="color" name="title_primary_color" id="color-picker" value="{{get_config('general/layout/title_primary_color')??"#FFFFFF"}}" class="mt-1  bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none sm:text-sm">
                                    <label>texto primario</label>
                                </div>
                                <div class="mt-4  pr-2">
                                    
                                    <input type="color" name="title_primary_color_hover" id="color-picker" value="{{get_config('general/layout/title_primary_color_hover')??"#FFFFFF"}}" class="mt-1  bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none sm:text-sm">
                                    <label>texto primario hover</label>
                                </div>
                                <div class="mt-4  pr-2">
                                    
                                    <input type="color" name="title_secundary_color" id="color-picker" value="{{get_config('general/layout/title_secundary_color')??"#FFFFFF"}}" class="mt-1  bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none sm:text-sm">
                                    <label>texto secundario</label>
                                </div>
                                <div class="mt-4  pr-2">
                                    
                                    <input type="color" name="title_secundary_color_hover" id="color-picker" value="{{get_config('general/layout/title_secundary_color_hover')??"#FFFFFF"}}" class="mt-1  bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none sm:text-sm">
                                    <label>texto secundario hover</label>
                                </div>
                                <div class="mt-4  pr-2">
                                    
                                    <input type="color" name="background_footer" id="color-picker" value="{{get_config('general/layout/background_footer')??"#FFFFFF"}}" class="mt-1  bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none sm:text-sm">
                                    <label>background rodapé</label>
                                </div>
                                <div class="mt-4  pr-2">
                                    <input type="color" name="text_footer" id="color-picker" value="{{get_config('general/layout/text_footer')??"#FFFFFF"}}" class="mt-1  bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none sm:text-sm">
                                    <label>texto rodapé</label>
                                </div>
                               
                                <div class="mt-4  pr-2">
                                    <input type="color" name="text_price" id="color-picker" value="{{get_config('general/layout/text_price')??"#FFFFFF"}}" class="mt-1  bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none sm:text-sm">
                                    <label>texto preço</label>
                                </div>
                                <div class="mt-4  pr-2">
                                    <input type="color" name="text_special_price" id="color-picker" value="{{get_config('general/layout/text_special_price')??"#FFFFFF"}}" class="mt-1  bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none sm:text-sm">
                                    <label>texto preço especial</label>
                                </div>
                                <div class="mt-4  pr-2">
                                    <input type="color" name="background_add_cart" id="color-picker" value="{{get_config('general/layout/background_add_cart')??"#FFFFFF"}}" class="mt-1  bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none sm:text-sm">
                                    <label>background adicionar ao carrinho</label>
                                </div>
                                <div class="mt-4  pr-2">
                                    <input type="color" name="background_add_cart_hover" id="color-picker" value="{{get_config('general/layout/background_add_cart_hover')??"#FFFFFF"}}" class="mt-1  bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none sm:text-sm">
                                    <label>background adicionar ao carrinho hover</label>
                                </div>
                                <div class="mt-4  pr-2">
                                    <input type="color" name="text_add_cart" id="color-picker" value="{{get_config('general/layout/text_add_cart')??"#FFFFFF"}}" class="mt-1  bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none sm:text-sm">
                                    <label>texto adicionar ao carrinho</label>
                                </div>
                                <div class="mt-4  pr-2">
                                    <input type="color" name="text_add_cart_hover" id="color-picker" value="{{get_config('general/layout/text_add_cart_hover')??"#FFFFFF"}}" class="mt-1  bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none sm:text-sm">
                                    <label>texto adicionar ao carrinho hover</label>
                                </div>




                                {{-- 
                                 
                                    --bg-addtocart:rgb(28 58 77 / 1);
                                    --bg-addtocart-hover:rgb(55 109 144);
                                    --text-addtocart:#FFFFFF;
                                    --text-addtocart-hover:#FFFFFF; --}}
                            </div>
                            
                        </div>
                    </div>

               


                </div>
            </div>
        </div>

      

        @include('layouts.snippets.save')

    </form>
@endsection
@push('js')
    <script src="{{ URL::to('/') . '/js/cep-api.js' }}"></script>
    <script>
        $(document).ready(function() {
            $('#postalcode').mask('00000-000');
            $('#phone').mask('(00) 0000-0000');
            $('#whatsapp').mask('(00) 0000-0000');
            $('#taxvat').mask('00.000.000/0000-00');
            $("#storeSettings").validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 5
                    },
                    email: {
                        required: true,
                        email: true,
                        maxlength: 255
                    },
                    postalcode: {
                        required: true,
                        minlength: 5
                    },
                    address: {
                        required: true,
                        minlength: 10
                    },
                    neighborhood: {
                        required: true
                    },
                    city: {
                        required: true
                    },
                    state: {
                        required: true
                    },
                    phone: {
                        required: true,
                        minlength: 10
                    },
                    whatsapp: {
                        required: true,
                        minlength: 10
                    },
                    facebook: {
                        url: true,
                        minlength: 10
                    },
                    youtube: {
                        url: true,
                        minlength: 10
                    },
                    instagram: {
                        url: true,
                        minlength: 10
                    },
                    pinterest: {
                        url: true,
                        minlength: 10
                    },
                    registred_company_name: {
                        required: true,
                        minlength: 10
                    },
                    company_email: {
                        required: true,
                        email: true,
                        maxlength: 255
                    },
                    taxvat: {
                        documentId: true
                    }
                }
            });
        });
    </script>
@endpush
