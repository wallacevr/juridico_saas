@extends('layouts.tenant', ['title' => __("Update customer") . __(" - {$customer->name}")])

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="lg:grid lg:grid-cols-12 lg:gap-x-5">
    <!-- LEFT FORM -->
    <div class="space-y-6 sm:px-6 lg:px-0 lg:col-span-8">
        <form id="customerForm" action="{{ route('tenant.customers.update', $customer->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="shadow sm:rounded-md sm:overflow-hidden">

                <div class="bg-white py-6 px-4 space-y-6 sm:p-6">
                    <div>
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            {{ __('Customer account details') }}
                        </h3>
                    </div>
                    <div class="grid grid-cols-3 gap-6">
                        <div class="col-span-12 sm:col-span-3">
                            @include('layouts.snippets.fields', ['type'=>'text','label'=>'Name','placeholder'=>'Customer name','name'=>'name','value'=> $customer->name ])
                        </div>

                        <div class="col-span-12 sm:col-span-3">
                            @include('layouts.snippets.fields', ['type'=>'email','label'=>'Email','placeholder'=>'Customer email','name'=>'email','value'=> $customer->email ])
                        </div>

                        <div class="col-span-12 sm:col-span-3">
                            @include('layouts.snippets.fields', ['type'=>'text','label'=>'Taxvat','placeholder'=>'___.___.___-__','name'=>'taxvat','value'=> $customer->taxvat ])
                        </div>

                        <div class="col-span-12 sm:col-span-3">
                            @include('layouts.snippets.fields', ['type'=>'text','label'=>'Telephone','placeholder'=>'(__)____-____','name'=>'telephone','value'=> $customer->telephone ])
                        </div>

                        <div class="col-span-12 sm:col-span-3">
                            @include('layouts.snippets.fields', ['type'=>'text','label'=>'Phone','placeholder'=>'(__)_____-____','name'=>'phone','value'=> $customer->phone ])
                        </div>

                        <div class="col-span-12 sm:col-span-3">
                            @include('layouts.snippets.fields', ['type'=>'password','label'=>'Password','placeholder'=>'*************','name'=>'password','value'=> '' ])
                        </div>

                    </div>
                </div>
            </div>

    </div>

    <!-- RIGHT FORM -->
    <div class="space-y-6 sm:px-6 lg:px-6 lg:col-span-4">
        <div class="shadow sm:rounded-md sm:overflow-hidden">
            <div class="bg-white py-6 px-4 space-y-6 sm:p-6">
                <fieldset>
                    <legend class="text-base font-medium text-gray-900">
                        {{ __('Other options') }}
                    </legend>
                    <div class="mt-4 space-y-4">
                        <div class="flex items-start">
                            <div class="h-5 flex items-center">
                                <input id="status" name="status" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded" {{ old('status') || $customer->status ? 'checked' : '' }} value="1" />
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="status" class="font-medium text-gray-700">{{ __('Active') }}</label>
                                <p class="text-gray-500">
                                    {{ __('Set this customer active in your store.') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="mt-4 space-y-4">
                        <label for="password" class="text-base font-medium text-gray-900">
                            {{ __('Submit offers?') }}
                        </label>

                        <div class="flex items-center mt-2">
                            <input value="1" name="newsletter" type="radio" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300" {{ $customer->newsletter == 1 ? 'checked' : '' }}>
                            <label class="ml-3 mr-3">
                                <span class="block text-sm font-medium text-gray-700">{{ __('Yes') }}</span>
                            </label>

                            <input value="0" name="newsletter" type="radio" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300" {{ $customer->newsletter == 0 ? 'checked' : '' }}>
                            <label class="ml-3">
                                <span class="block text-sm font-medium text-gray-700">{{ __('No') }}</span>
                            </label>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>

        <div class="bg-white py-6 px-4 space-y-6 sm:p-6">
            <div class="flex justify-end">
                <span class="inline-flex rounded-md shadow-sm">
                    <a href="{{ route('tenant.customers.index') }}" class="py-1 px-4 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out">
                        {{ __('Cancel') }}
                    </a>
                </span>
                <span class="ml-3 inline-flex rounded-md shadow-sm">
                    <button type="submit" class="py-1 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 shadow-sm hover:bg-indigo-500 focus:outline-none focus:shadow-outline-blue focus:bg-indigo-500 active:bg-indigo-600 transition duration-150 ease-in-out">
                        {{ __('Save customer') }}
                    </button>
                </span>
            </div>
        </div>

        </form>
    </div>
</div>

@endsection

@push('js')
<script>
    $(document).ready(function() {
        $('#postalcode').mask('00000-000');
        $('#taxvat').mask('000.000.000-00');
        $('#phone').mask('(00) 00000-0000');
        $('#telephone').mask('(00) 0000-0000');
        $("#customerForm").validate({
            rules: {
                name: {
                    required: true
                },
                page_title: {
                    required: true,
                },
                slug: {
                    required: true,
                }
            }
        });
    });
</script>
@endpush
