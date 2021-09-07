@extends('layouts.tenant', ['title' => __('Create collection')]) @section('content')

<div class="lg:grid lg:grid-cols-12 lg:gap-x-5">
    <!-- LEFT FORM -->
    <div class="space-y-6 sm:px-6 lg:px-0 lg:col-span-8">
        <form action="{{ route('tenant.collections.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="shadow sm:rounded-md sm:overflow-hidden">
                <div class="bg-white py-6 px-4 space-y-6 sm:p-6">
                    <div class="grid grid-cols-3 gap-6">
                        <div class="col-span-12 sm:col-span-3">
                            <label for="name" class="block text-sm font-medium text-gray-700">{{ __('label.Name') }}</label>
                            <input type="text" name="name" id="name" autocomplete="name" value="{{ old('name') }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                placeholder="e.g. Summer collection, Under $100, Staff picks" />
                            @error('name')
                            <p class="mt-2 text-sm text-red-500">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <div class="col-span-3">
                            <label for="description" class="block text-sm font-medium text-gray-700">
                                Description
                            </label>
                            <div class="mt-1">
                                <textarea id="description" name="description" rows="5"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm "></textarea>
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
                            Search engine listing preview
                        </h3>
                        <p class="mt-1 text-sm text-gray-500">
                            Add a title and description to see how this collection might appear in a search engine
                            listing.
                        </p>
                    </div>

                    <div class="col-span-12 sm:col-span-3">
                        <label for="page_title" class="block text-sm font-medium text-gray-700">Page title</label>
                        <input type="text" name="page_title" id="page_title" autocomplete="page_title"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            placeholder="Collection name" />
                        @error('page_title')
                        <p class="mt-2 text-sm text-red-500">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>
                    <div class="col-span-3">
                        <label for="seo_description" class="block text-sm font-medium text-gray-700">
                            Description
                        </label>
                        <div class="mt-1">
                            <textarea id="seo_description" name="seo_description" rows="5"
                                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md"></textarea>
                        </div>
                    </div>

                    <div class="col-span-3 sm:col-span-2">
                        <label for="slug" class="block text-sm font-medium text-gray-700">
                            URL and handle
                        </label>
                        <div class="mt-1 rounded-md shadow-sm flex">
                            <span
                                class="bg-gray-50 border border-r-0 border-gray-300 px-3 inline-flex items-center text-gray-500 sm:text-sm">
                                {{ Request::getHost() . '/collections/' }}
                            </span>
                            <input type="text" name="slug" id="slug" autocomplete="slug"
                                class="mt-1 block w-full border border-gray-300 shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                            @error('slug')
                            <p class="mt-2 text-sm text-red-500">
                                {{ $message }}
                            </p>
                            @enderror
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
                        Other options
                    </legend>
                    <div class="mt-4 space-y-4">
                        <div class="flex items-start">
                            <div class="h-5 flex items-center">
                                <input id="status" name="status" type="checkbox"
                                    class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded"
                                    checked value="1" />
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="status" class="font-medium text-gray-700">Active</label>
                                <p class="text-gray-500">
                                    Set this collection active in your store.
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
                        Collection image
                    </h3>
                </div>
                <div class=" mt-1 border-2 border-gray-300 border-dashed rounded-md px-6 pt-5 pb-6 flex justify-center">
                    <div class="space-y-1 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                            viewBox="0 0 48 48" aria-hidden="true">
                            <path
                                d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="flex text-sm text-gray-600">
                            <label for="image_url"
                                class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                <span>Upload a file</span>
                                <input id="image_url" name="image_url" type="file" class="sr-only" />
                            </label>
                            <p class="pl-1">or drag and drop</p>
                        </div>
                        <p class="text-xs text-gray-500">
                            PNG, JPG, GIF up to 10MB
                        </p>
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
                    <a href="{{ route('tenant.collections.index') }}"
                        class="py-1 px-4 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out">
                        Cancel
                    </a>
                </span>
                <span class="ml-3 inline-flex rounded-md shadow-sm">
                    <button type="submit"
                        class="py-1 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 shadow-sm hover:bg-indigo-500 focus:outline-none focus:shadow-outline-blue focus:bg-indigo-500 active:bg-indigo-600 transition duration-150 ease-in-out">
                        Save Collection
                    </button>
                </span>
            </div>
        </div>
        </form>
    </div>
</div>

@endsection
