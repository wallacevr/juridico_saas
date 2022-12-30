@extends('layouts.tenant', ['title' => __('General configuration')])

@section('content')
    <form action="{{ route('tenant.settings.store.update') }}" method="POST" id="storeSettings">
        @csrf

        <!-- Block 1 -->
        <div class="flex flex-row flex-wrap">
            <!-- header -->
            <div class="w-full md:w-1/3">
                <div class="px-4 md:px-0">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">{{ __('Store Configuration') }}
                    </h3>
                    <p class="mt-1 text-sm leading-5 text-gray-600">
                        {{ __('This address will be used to request email order') }}.
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
                                    @include('layouts.snippets.fields', [
                                        'type' => 'email',
                                        'label' => 'Email',
                                        'placeholder' => 'you@example.com',
                                        'name' => 'email',
                                        'value' => get_config('general/store/email'),
                                    ])
                                </div>
                            </div>
                            <div class="w-full md:w-1/2">
                                <div class="mt-4 ">
                                    @include('layouts.snippets.fields', [
                                        'type' => 'text',
                                        'label' => 'Title',
                                        'placeholder' => 'Maxcommerce',
                                        'name' => 'name',
                                        'value' => get_config('general/store/name'),
                                    ])
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="flex flex-row flex-wrap">
                            <div class="w-full md:w-1/2">
                                <div class="mt-4  pr-2">
                                    <label for="email"
                                        class="block text-sm font-medium leading-5 text-gray-700">{{ __('Putting your store under maintenance mode') }}
                                    </label>
                                    <!-- This example requires Tailwind CSS v2.0+ -->
                                    <!-- Enabled: "bg-indigo-600", Not Enabled: "bg-gray-200" -->
                                    <div class="mt-1 relative rounded-md shadow-sm">
    
                                        <div class="flex ">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input appearance-none w-9 -ml-10 rounded-full float-left h-5 align-top bg-white bg-no-repeat bg-contain bg-gray-300 focus:outline-none cursor-pointer shadow-sm" type="checkbox" role="switch" name="maintenance" id="maintenance" 
                                                    @if(get_config('general/store/maintenance')==1)
                                                        checked
                                                    @endif
                                                    >
                                                <label class="form-check-label inline-block text-gray-800" for="flexSwitchCheckChecked">{{__('Yes')}}</label>
                                                    @error('maintenance')
                                                        <p class="mt-2 text-sm text-red-600">
                                                            {{ $message }}
                                                        </p>
                                                    @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full md:w-1/2">

                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>

        @include('layouts.snippets.divide')

        <!-- Block 2 -->
        <div class="flex flex-row flex-wrap">
            <!-- header -->
            <div class="w-full md:w-1/3">
                <div class="px-4 md:px-0">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">{{ __('Store Address') }}
                    </h3>
                    <p class="mt-1 text-sm leading-5 text-gray-600">
                        {{ __('This address will be used when printing the order and on the contact form') }}.
                    </p>
                </div>
            </div>

            <!-- body -->
            <div class="mt-4 md:mt-0 w-full md:w-2/3 pl-0 md:pl-2">
                <div class="shadow overflow-hidden sm:rounded-md">

                    <!-- Group 1 -->
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="flex flex-row flex-wrap">
                            <div class="w-full md:w-1/2">
                                <div class="mt-4  pr-2">
                                    @include('layouts.snippets.fields', [
                                        'type' => 'text',
                                        'label' => 'Postal code',
                                        'placeholder' => 'placeholder_postalcode',
                                        'name' => 'postalcode',
                                        'value' => get_config('general/store/postalcode'),
                                    ])
                                    <small id="zip-warning"
                                        class="form-text text-muted font-weight-bold text-red-900 hidden">{{ __('Please enter a valid postal code') }}</small>
                                </div>
                            </div>
                            <div class="w-full md:w-1/2">

                            </div>
                        </div>
                    </div>

                    <!-- Group 1 -->
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="flex flex-row flex-wrap">
                            <div class="w-full md:w-1/2">
                                <div class="mt-4  pr-2">
                                    @include('layouts.snippets.fields', [
                                        'type' => 'text',
                                        'label' => 'Line 1',
                                        'placeholder' => 'placeholder_address',
                                        'name' => 'address',
                                        'value' => get_config('general/store/address'),
                                    ])
                                </div>
                            </div>
                            <div class="w-full md:w-1/2">
                                <div class="mt-4  pr-2">
                                    @include('layouts.snippets.fields', [
                                        'type' => 'text',
                                        'label' => 'Line 2',
                                        'placeholder' => 'placeholder_line_2',
                                        'name' => 'neighborhood',
                                        'value' => get_config('general/store/neighborhood'),
                                    ])
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Group 2 -->
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="flex flex-row flex-wrap">
                            <div class="w-full md:w-1/2">
                                <div class="mt-4  pr-2">
                                    @include('layouts.snippets.fields', [
                                        'type' => 'text',
                                        'label' => 'Number',
                                        'placeholder' => '58',
                                        'name' => 'number',
                                        'value' => get_config('general/store/number'),
                                    ])
                                </div>
                            </div>
                            <div class="w-full md:w-1/2">
                                <div class="mt-4 pr-2">
                                    @include('layouts.snippets.fields', [
                                        'type' => 'text',
                                        'label' => 'Complement',
                                        'placeholder' => 'placeholder_complement',
                                        'name' => 'complement',
                                        'value' => get_config('general/store/complement'),
                                    ])
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Group 3 -->
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="flex flex-row flex-wrap">
                            <div class="w-full md:w-1/2">
                                <div class="mt-4  pr-2">
                                    @include('layouts.snippets.fields', [
                                        'type' => 'text',
                                        'label' => 'City',
                                        'placeholder' => 'placeholder_city',
                                        'name' => 'city',
                                        'value' => get_config('general/store/city'),
                                    ])
                                </div>
                            </div>
                            <div class="w-full md:w-1/2">
                                <div class="mt-4 pr-2">
                                    @include('layouts.snippets.fields', [
                                        'type' => 'text',
                                        'label' => 'State',
                                        'placeholder' => 'placeholder_state',
                                        'name' => 'state',
                                        'value' => get_config('general/store/state'),
                                    ])
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        @include('layouts.snippets.divide')

        <!-- Block 2 -->
        <div class="flex flex-row flex-wrap">
            <!-- header -->
            <div class="w-full md:w-1/3">
                <div class="px-4 md:px-0">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">{{ __('Store Informations') }}
                    </h3>
                    <p class="mt-1 text-sm leading-5 text-gray-600">
                        {{ __('This information will be used on footer') }}.
                    </p>
                </div>
            </div>

            <!-- body -->
            <div class="mt-4 md:mt-0 w-full md:w-2/3 pl-0 md:pl-2">
                <div class="shadow overflow-hidden sm:rounded-md">


                    <!-- Group 1 -->
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="flex flex-row flex-wrap">
                            <div class="w-full">
                                <div class="mt-4  pr-2">
                                    @include('layouts.snippets.fields', [
                                        'type' => 'text',
                                        'label' => 'Registred company name',
                                        'placeholder' => 'Maxcommerce LTDA',
                                        'name' => 'registred_company_name',
                                        'value' => get_config('general/store/registred_company_name'),
                                    ])
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="flex flex-row flex-wrap">
                            <div class="w-full md:w-1/2">
                                <div class="mt-4  pr-2">
                                    @include('layouts.snippets.fields', [
                                        'type' => 'text',
                                        'label' => 'TAXVAT COMPANY',
                                        'placeholder' => '00.000.000/0000-00',
                                        'name' => 'taxvat',
                                        'value' => get_config('general/store/taxvat'),
                                    ])
                                </div>
                            </div>
                            <div class="w-full md:w-1/2">
                                <div class="mt-4  pr-2">
                                    @include('layouts.snippets.fields', [
                                        'type' => 'email',
                                        'label' => 'Email',
                                        'placeholder' => 'you@example.com',
                                        'name' => 'company_email',
                                        'value' => get_config('general/store/company_email'),
                                    ])
                                </div>
                            </div>

                        </div>
                    </div>



           <!-- Mail Settings -->
           <div class="mt-4 md:mt-0 w-full md:w-2/3 pl-0 md:pl-2">
                <div class="shadow overflow-hidden sm:rounded-md">


                    






                    <!-- Group 4 -->
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="flex flex-row flex-wrap">
                            <div class="w-full md:w-1/2">
                                <div class="mt-4  pr-2">
                                    @include('layouts.snippets.fields', [
                                        'type' => 'text',
                                        'label' => 'Telephone',
                                        'placeholder' => 'placeholder_phone',
                                        'name' => 'phone',
                                        'value' => get_config('general/store/phone'),
                                    ])
                                </div>
                            </div>
                            <div class="w-full md:w-1/2">
                                <div class="mt-4 pr-2">
                                    @include('layouts.snippets.fields', [
                                        'type' => 'text',
                                        'label' => 'Whatsapp',
                                        'placeholder' => 'placeholder_phone',
                                        'name' => 'whatsapp',
                                        'value' => get_config('general/store/whatsapp'),
                                    ])
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        @include('layouts.snippets.divide')
{{--
        <!-- Block 5 -->
        <div class="flex flex-row flex-wrap">
            <!-- header -->
            <div class="w-full md:w-1/3">
                <div class="px-4 md:px-0">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">{{ __('Mail Sender') }}
                    </h3>
                    <p class="mt-1 text-sm leading-5 text-gray-600">

                    </p>
                </div>
            </div>
            <!-- body -->
            <div class="mt-4 mb-4 md:mt-0 w-full md:w-2/3 pl-0 md:pl-2">
                <div class="shadow overflow-hidden sm:rounded-md">
                   
                    <!-- Group 1 -->
                    <div class="px-4 pt-1 bg-white sm:p-6">
                        <div class="flex flex-row flex-wrap">
                            <div class="w-full">
                                <div class="mt-4  pr-2">
                                    @include('layouts.snippets.fields', [
                                        'type' => 'email',
                                        'label' => 'Email',
                                        'placeholder' => 'youemail@domain.com.br',
                                        'name' => 'email_sender',
                                        'value' => get_config('general/store/email_sender'),
                                    ])
                                </div>
                                <div class="mt-4  pr-2">
                                    @include('layouts.snippets.fields', [
                                        'type' => 'text',
                                        'label' => 'SMTP MAIL HOST',
                                        'placeholder' => 'smtp.domain.com',
                                        'name' => 'smtp_mail_host',
                                        'value' => get_config('general/store/smtp_mail_host'),
                                    ])
                                </div>
                                <div class="mt-4  pr-2">
                                    @include('layouts.snippets.fields', [
                                        'type' => 'text',
                                        'label' => 'Mail Port',
                                        'placeholder' => '587',
                                        'name' => 'mail_port',
                                        'value' => get_config('general/store/mail_port'),
                                    ])
                                </div>
                                <div class="mt-4  pr-2">
                                    @include('layouts.snippets.fields', [
                                        'type' => 'password',
                                        'label' => 'Password',
                                        'placeholder' => 'Password',
                                        'name' => 'email_sender_password',
                                        'value' => get_config('general/store/email_sender_password'),
                                    ])
                                </div>
                                <div class="mt-4  pr-2">
                                    @include('layouts.snippets.fields', [
                                        'type' => 'text',
                                        'label' => 'Mail Encryption',
                                        'placeholder' => 'tls',
                                        'name' => 'email_sender_encryption',
                                        'value' => get_config('general/store/email_sender_encryption'),
                                    ])
                                </div>
                                <div class="mt-4  pr-2">
                                    @include('layouts.snippets.fields', [
                                        'type' => 'text',
                                        'label' => 'Mail Sender Name',
                                        'placeholder' => 'Sender Name',
                                        'name' => 'email_sender_name',
                                        'value' => get_config('general/store/email_sender_name'),
                                    ])
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
--}}

         <!-- Block 4 -->
         <div class="flex flex-row flex-wrap">
            <!-- header -->
            <div class="w-full md:w-1/3">
                <div class="px-4 md:px-0">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">{{ __('Social Network') }}
                    </h3>
                    <p class="mt-1 text-sm leading-5 text-gray-600">

                    </p>
                </div>
            </div>
            <!-- body -->
            <div class="mt-4 md:mt-0 w-full md:w-2/3 pl-0 md:pl-2">
                <div class="shadow overflow-hidden sm:rounded-md">
                    <!-- Group 1 -->
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="flex flex-row flex-wrap">
                            <div class="w-full md:w-1/2">
                                <div class="mt-4  pr-2">
                                    @include('layouts.snippets.fields', [
                                        'type' => 'text',
                                        'label' => 'Facebook',
                                        'placeholder' => 'https://',
                                        'name' => 'facebook',
                                        'value' => get_config('general/store/social_facebook'),
                                    ])
                                </div>
                            </div>
                            <div class="w-full md:w-1/2">
                                <div class="mt-4  pr-2">
                                    @include('layouts.snippets.fields', [
                                        'type' => 'text',
                                        'label' => 'Instagram',
                                        'placeholder' => 'https://',
                                        'name' => 'instagram',
                                        'value' => get_config('general/store/social_instagram'),
                                    ])
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Group 2 -->
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="flex flex-row flex-wrap">
                            <div class="w-full md:w-1/2">
                                <div class="mt-4  pr-2">
                                    @include('layouts.snippets.fields', [
                                        'type' => 'text',
                                        'label' => 'Youtube',
                                        'placeholder' => 'https://',
                                        'name' => 'youtube',
                                        'value' => get_config('general/store/social_youtube'),
                                    ])
                                </div>
                            </div>
                            <div class="w-full md:w-1/2">
                                <div class="mt-4  pr-2">
                                    @include('layouts.snippets.fields', [
                                        'type' => 'text',
                                        'label' => 'Pinterest',
                                        'placeholder' => 'https://',
                                        'name' => 'pinterest',
                                        'value' => get_config('general/store/social_pinterest'),
                                    ])
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
@push('js')
    <script src="{{ URL::to('/') . '/js/cep-api.js' }}"></script>
    <script>
        $(document).ready(function() {
            $('#postalcode').mask('00000-000');
            $('#phone').mask('(00) 0000-0000');
            $('#whatsapp').mask('(00) 00000-0000');
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
