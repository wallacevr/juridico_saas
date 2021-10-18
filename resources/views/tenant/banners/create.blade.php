@push('head')
<link rel="stylesheet" href="{{ URL::to('/') . '/css/image-preview-input.css' }}">
@endpush

@extends('layouts.tenant', ['title' => __('Create banner')])

@section('content')

<div class="lg:grid lg:grid-cols-12 lg:gap-x-5">
    <!-- LEFT FORM -->
    <div class="space-y-6 sm:px-6 lg:px-0 lg:col-span-8">
        <form id="bannerForm" action="{{ route('tenant.banners.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="shadow sm:rounded-md sm:overflow-hidden">
                <div class="bg-white py-6 px-4 space-y-6 sm:p-6">
                    <div class="grid grid-cols-3 gap-6">
                        <div class="col-span-12 sm:col-span-3">
                            @include('layouts.snippets.fields', ['type'=>'text','label'=>'Name','placeholder'=>'Banner name','name'=>'name','value'=> '' ])
                        </div>

                        <div class="col-span-12 sm:col-span-3">
                            <label for="type" class="block text-sm font-medium text-gray-700">
                                {{ __('Banner position') }}
                            </label>
                            <select name="type" class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option selected disabled>{{ __('Select one of the options') }}</option>
                                <option value="full" {{ old('type')==='full' ? 'selected' : '' }}>
                                    {{ __('Full banner') }}
                                </option>
                                <option value="stripe" {{ old('type')==='stripe' ? 'selected' : '' }}>
                                    {{ __('Stripe banner') }}
                                </option>
                                <option value="showcase" {{ old('type')==='showcase' ? 'selected' : '' }}>
                                    {{ __('Showcase banner') }}
                                </option>
                                <option value="side" {{ old('type')==='side' ? 'selected' : '' }}>
                                    {{ __('Side banner') }}
                                </option>
                                <option value="mini" {{ old('type')==='mini' ? 'selected' : '' }}>
                                    {{ __('Mini banner') }}
                                </option>
                            </select>
                            @error('type')
                            <p class="mt-2 text-sm text-red-500">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <div class="col-span-12 sm:col-span-3">
                            @include('layouts.snippets.fields', ['type'=>'text','label'=>'URL','placeholder'=>'Banner URL','name'=>'url','value'=> '' ])
                        </div>

                        <div class="col-span-3">
                            @include('layouts.snippets.fields', ['type'=>'text','label'=>'Title','placeholder'=>'Banner title','name'=>'title','value'=> '' ])
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="shadow sm:rounded-md sm:overflow-hidden">
                <div class="bg-white py-6 px-4 space-y-6 sm:p-6">
                    <div>
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            {{ __('Upload banner image') }}
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
                                <img id="file-upload-image" class="banner" src="#" alt="your image" />
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
                                <label for="status" class="font-medium text-gray-700">{{ __('Active') }}</label>
                                <p class="text-gray-500">
                                    {{ __('Set this banner active in your store') }}
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
                    <a href="{{ route('tenant.banners.index') }}" class="py-1 px-4 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out">
                        {{ __('Cancel') }}
                    </a>
                </span>
                <span class="ml-3 inline-flex rounded-md shadow-sm">
                    <button type="submit" class="py-1 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 shadow-sm hover:bg-indigo-500 focus:outline-none focus:shadow-outline-blue focus:bg-indigo-500 active:bg-indigo-600 transition duration-150 ease-in-out">
                        {{ __('Save banner') }}
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
<script>
    $(document).ready(function() {
        $("#bannerForm").validate({
            rules: {
                name: {
                    required: true
                },
                type: {
                    required: true,
                },
                image_url: {
                    required: true,
                },
                url: {
                    url: true,
                },
            }
        });
    });
</script>
@endpush
