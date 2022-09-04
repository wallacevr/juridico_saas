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
                                        <button type="button"
                                            class="bg-indigo-600 relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                            role="switch" aria-checked="false">
                                            <span
                                                class="sr-only">{{ __('Putting your store under maintenance mode') }}</span>
                                            <!-- Enabled: "translate-x-5", Not Enabled: "translate-x-0" -->
                                            <span aria-hidden="true"
                                                class="translate-x-5 pointer-events-none inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200"></span>
                                        </button>
                                        <span class="ml-3" id="annual-billing-label">
                                            <span class="text-sm font-medium text-gray-900">{{ __('Yes') }}</span>
                                        </span>
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
