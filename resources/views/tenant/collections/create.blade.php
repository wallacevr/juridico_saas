@push('head')
<link rel="stylesheet" href="{{ URL::to('/') . '/css/image-preview-input.css' }}">
@endpush

@extends('layouts.tenant', ['title' => __('Create collection')])

@section('content')

<div class="lg:grid lg:grid-cols-12 lg:gap-x-5">
    <!-- LEFT FORM -->
    <div class="space-y-6 sm:px-6 lg:px-0 lg:col-span-8">
        <form id="collectionForm" action="{{ route('tenant.collections.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="shadow sm:rounded-md sm:overflow-hidden">
                <div class="bg-white py-6 px-4 space-y-6 sm:p-6">
                    <div class="grid grid-cols-3 gap-6">
                        <div class="col-span-12 sm:col-span-3">
                            @include('layouts.snippets.fields', ['type'=>'text','label'=>'Name','placeholder'=>'Collection name','name'=>'name','value'=> '' ])
                        </div>

                        <div class="col-span-3">
                            <label for="description" class="block text-sm font-medium text-gray-700">
                                {{ __('Description') }}
                            </label>
                            <div class="mt-1">
                                <textarea id="description" name="description" rows="5" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm ">{{ old('description') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="shadow sm:rounded-md sm:overflow-hidden">
                <div class="bg-white py-6 px-4 space-y-6 sm:p-6">
                    <div>
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            {{ __('Search engine listing preview') }}
                        </h3>
                        <p class="mt-1 text-sm text-gray-500">
                            {{ __('Add a title and description to see how this collection might appear in a search engine listing.') }}
                        </p>
                    </div>

                    <div class="col-span-12 sm:col-span-3">
                        @include('layouts.snippets.fields', ['type'=>'text','label'=>'Title','placeholder'=>'Collection title','name'=>'page_title','value'=> '' ])
                    </div>
                    <div class="col-span-3">
                        <label for="seo_description" class="block text-sm font-medium text-gray-700">
                            {{ __('Description') }}
                        </label>
                        <div class="mt-1">
                            <textarea id="seo_description" name="seo_description" rows="5" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ old('seo_description') }}</textarea>
                        </div>
                    </div>

                    <div class="col-span-3 sm:col-span-2">
                        <label for="slug" class="block text-sm font-medium text-gray-700">
                            {{ __('URL and handle') }}
                        </label>
                        <div class="mt-1 rounded-md shadow-sm flex">
                            <span class="bg-gray-50 border border-r-0 border-gray-300 px-3 inline-flex items-center text-gray-500 sm:text-sm">
                                {{ Request::getHost() . '/' . __('collections') . '/'}}
                            </span>
                            <input type="text" name="slug" id="slug" autocomplete="slug" class="block w-full border border-gray-300 shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ old('slug') }}" />
                        </div>
                        @error('slug')
                        <p class="mt-2 text-sm text-red-500">
                            {{ $message }}
                        </p>
                        @enderror
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
                                    {{ __('Set this collection active in your store.') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>

        <div class="shadow sm:rounded-md sm:overflow-hidden">
            <div class="bg-white py-6 px-4 space-y-6 sm:p-6">
                <div>
                    <h3 class="text-base font-medium text-gray-900">
                        {{ __('Collection image') }}
                    </h3>
                </div>
                <div class="mt-1 border-2 border-gray-300 border-dashed rounded-md px-6 pt-5 pb-6 flex justify-center">
                    <div class="file-upload">
                        <button class="file-upload-btn" type="button" onclick="document.getElementById('image_url').click()">{{ __('Add image') }}</button>

                        <div id="image-upload-wrap">
                            <input id="image_url" name="image_url" type='file' accept="image/*" />
                            <div class="drag-text">
                                <h3>{{ __('Drag and drop a file or select add Image') }}</h3>
                            </div>
                        </div>
                        <div id="file-upload-content">
                            <img id="file-upload-image" src="#" alt="your image" />
                            <div class="image-title-wrap">
                                <button type="button" id="remove-image">{{ __('Remove') }} <span id="image-title">{{ __('Uploaded Image') }}</span></button>
                            </div>
                        </div>
                    </div>
                </div>
                @error('image_url')
                <p class="mt-2 text-sm text-red-500">
                    {{ $message }}
                </p>
                @enderror
            </div>
        </div>

        <div class="bg-white py-6 px-4 space-y-6 sm:p-6">
            <div class="flex justify-end">
                <span class="inline-flex rounded-md shadow-sm">
                    <a href="{{ route('tenant.collections.index') }}" class="py-1 px-4 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out">
                        {{ __('Cancel') }}
                    </a>
                </span>
                <span class="ml-3 inline-flex rounded-md shadow-sm">
                    <button type="submit" class="py-1 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 shadow-sm hover:bg-indigo-500 focus:outline-none focus:shadow-outline-blue focus:bg-indigo-500 active:bg-indigo-600 transition duration-150 ease-in-out">
                        {{ __('Save collection') }}
                    </button>
                </span>
            </div>
        </div>
        </form>
    </div>
</div>

@endsection

@push('js')
<script src="{{ URL::to('/') . '/js/image-preview-input.js' }}"></script>
<script src="{{ URL::to('/') . '/js/string-slugger.js' }}"></script>
<script>
    $(document).ready(function() {
        $("#collectionForm").validate({
            rules: {
                name: {
                    required: true
                },
                page_title: {
                    required: true,
                },
                slug: {
                    required: true,
                },
                image_url: {
                    required: true,
                },
            }
        });
    });
</script>
@endpush
