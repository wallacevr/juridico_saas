@extends('layouts.tenant', ['title' => __('Create block')])

@section('content')

<div class="lg:grid lg:grid-cols-12 lg:gap-x-5">
    <!-- LEFT FORM -->
    <div class="space-y-6 sm:px-6 lg:px-0 lg:col-span-8">
        <form action="{{ route('tenant.blocks.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="shadow sm:rounded-md sm:overflow-hidden">
                <div class="bg-white py-6 px-4 space-y-6 sm:p-6">
                    <div class="grid grid-cols-3 gap-6">
                        <div class="col-span-12 sm:col-span-3">
                            <label for="name" class="block text-sm font-medium text-gray-700">
                                {{ __('Name') }}
                            </label>
                            <input type="text" name="name" value="{{ old('name') }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                            @error('name')
                            <p class="mt-2 text-sm text-red-500">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <div class="col-span-3">
                            <label for="content" class="block text-sm font-medium text-gray-700">
                                {{ __('Content') }}
                            </label>
                            <div class="mt-1">
                                <textarea name="content" rows="8"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm ">{{ old('content') }}</textarea>
                            </div>
                        </div>

                        <div class="col-span-12 sm:col-span-3">
                            <label for="short_code" class="block text-sm font-medium text-gray-700">
                                {{ __('Shortcode') }}
                            </label>
                            <input id="short_code" type="text" name="short_code" value="{{ old('short_code') }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                            <p class="text-xs text-gray-500 mt-2">
                                {{ __('Shortcode preview:') }}
                                <span id="shortcode-preview" class="text-black"></span>
                            </p>
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
                                <input id="status" name="status" type="checkbox"
                                    class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded" {{
                                    old('status') ? 'checked' : '' }} value="1" />
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="status" class="font-medium text-gray-700">{{ __('label.Active') }}</label>
                                <p class="text-gray-500">
                                    {{ __('Set this block active in your store.') }}
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
                    <a href="{{ route('tenant.blocks.index') }}"
                        class="py-1 px-4 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out">
                        {{ __('Cancel') }}
                    </a>
                </span>
                <span class="ml-3 inline-flex rounded-md shadow-sm">
                    <button type="submit"
                        class="py-1 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 shadow-sm hover:bg-indigo-500 focus:outline-none focus:shadow-outline-blue focus:bg-indigo-500 active:bg-indigo-600 transition duration-150 ease-in-out">
                        {{ __('Save block') }}
                    </button>
                </span>
            </div>
        </div>
        </form>
    </div>
</div>

@endsection

@push('js')
<script src="{{ URL::to('/') . '/js/string-sanitizer.js' }}"></script>
@endpush
