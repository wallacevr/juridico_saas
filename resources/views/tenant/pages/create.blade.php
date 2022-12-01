@push('head')
<link rel="stylesheet" href="{{ URL::to('/') . '/css/keyword-input.css' }}">
@endpush

@extends('layouts.tenant', ['title' => __('Create page')])

@section('content')

<div class="lg:grid lg:grid-cols-12 lg:gap-x-5">
    <!-- LEFT FORM -->
    <div class="space-y-6 sm:px-6 lg:px-0 lg:col-span-8">
        <form id="pageForm" action="{{ route('tenant.pages.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="shadow sm:rounded-md sm:overflow-hidden">
                <div class="bg-white py-6 px-4 space-y-6 sm:p-6">
                    <div class="grid grid-cols-3 gap-6">
                        <div class="col-span-12 sm:col-span-3">
                            @include('layouts.snippets.fields', ['type'=>'text','label'=>'Name','placeholder'=>'Page name','name'=>'name','value'=> '' ])
                        </div>

                        <div class="col-span-3">
                            @include('layouts.snippets.text-editor', ['label'=>'Content','name'=>'content','value'=> '' ])
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="shadow sm:rounded-md sm:overflow-hidden">
                <div class="bg-white py-6 px-4 space-y-6 sm:p-6">
                    <div>
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            {{ __('Google / SEO') }}
                        </h3>
                    </div>
                    <div class="col-span-12 sm:col-span-3">
                        @include('layouts.snippets.fields', ['type'=>'text','label'=>'Title','placeholder'=>'Page title','name'=>'title','value'=> '' ])
                    </div>

                    <div class="col-span-3 sm:col-span-2">
                        <label for="slug" class="block text-sm font-medium text-gray-700">
                            {{ __('URL') }}<span  class="red">*</span>
                        </label>
                        <div class="mt-1 rounded-md shadow-sm flex">
                            <span class="bg-gray-50 border border-r-0 border-gray-300 px-3 inline-flex items-center text-gray-500 sm:text-sm">
                                {{ Request::getHost() . '/' . __('pages') . '/'}}
                            </span>
                            <input type="text" name="url" id="slug" class="block w-full border border-gray-300 shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ old('slug') }}" required />
                        </div>
                        @error('url')
                        <p class="mt-2 text-sm text-red-500">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div class="col-span-3">
                        <label for="description" class="block text-sm font-medium text-gray-700">
                            {{ __('Page description') }}
                        </label>
                        <div class="mt-1">
                            <textarea name="description" rows="5" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ old('description') }}</textarea>
                        </div>
                    </div>

                    <div class="col-span-3">
                        <label for="keywords" class="block text-sm font-medium text-gray-700">
                            {{ __('Keywords') }}
                        </label>
                        <div class="mt-1">
                            <div id="keywords" name="keywords" rows="3" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm input textarea">
                            </div>
                        </div>
                        <p class="text-xs text-gray-500 mt-2">
                            {{ __('Separate values ​​by comma (,)') }}
                        </p>
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
                                <input id="status" name="status" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded" {{ old('status') ? 'checked' : '' }} value="1" />
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="status" class="font-medium text-gray-700">{{ __('label.Active') }}</label>
                                <p class="text-gray-500">
                                    {{ __('Set this page active in your store.') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>

        <div class="bg-white py-6 px-4 space-y-6 sm:p-6">
            <div class="flex justify-end">
                <span class="inline-flex rounded-md shadow-sm">
                    <a href="{{ route('tenant.pages.index') }}" class="py-1 px-4 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out">
                        {{ __('Cancel') }}
                    </a>
                </span>
                <span class="ml-3 inline-flex rounded-md shadow-sm">
                    <button type="submit" class="py-1 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 shadow-sm hover:bg-indigo-500 focus:outline-none focus:shadow-outline-blue focus:bg-indigo-500 active:bg-indigo-600 transition duration-150 ease-in-out">
                        {{ __('Save page') }}
                    </button>
                </span>
            </div>
        </div>
        </form>
    </div>
</div>

@endsection

@push('js')
<script src="{{ URL::to('/') . '/js/string-slugger.js' }}"></script>
<script>
    $(document).ready(function() {
    var taggle = new Taggle('keywords', { hiddenInputName: 'keywords[]', placeholder: null})

    $("#pageForm").validate({
      rules: {
        name: {
            required: true
        },
        title: {
            required: true,
        },
        content: {
            required: true,
        },
        url: {
            required: true,
        },
      }
    });
  });
</script>
@endpush
