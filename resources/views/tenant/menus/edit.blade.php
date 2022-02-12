@push('head')
<link rel="stylesheet" href="{{ URL::to('/') . '/css/sortable-menu.css' }}">
<link rel="stylesheet" href="{{ URL::to('/') . '/css/edit-side-menu.css' }}">
@endpush

@extends('layouts.tenant', ['title' => __('Edit menu') . __(" - {$menu->title}")])

@section('content')

@include('tenant.menus.edit-menu')

<div class="lg:grid lg:grid-cols-12 lg:gap-x-5">
    <!-- LEFT FORM -->
    <div class="space-y-6 sm:px-6 lg:px-0 lg:col-span-8">
        <form action="{{ route('tenant.menus.update', $menu->id) }}" method="POST"">
            @csrf
            @method('PUT')
            <div class=" shadow sm:rounded-md sm:overflow-hidden">
            <div class="bg-white py-6 px-4 space-y-6 sm:p-6">
                <div class="grid grid-cols-3 gap-6">
                    <div class="col-span-12 sm:col-span-3">
                        <label for="title" class="block text-sm font-medium text-gray-700">{{ __('label.Title') }}</label>
                        <input type="text" name="title" id="title" autocomplete="title" value="{{ old('title')  ? old('title') :  $menu->title}}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="{{ __('label.e.g. Bags & Shoes') }}" />
                        @error('title')
                        <p class="mt-2 text-sm text-red-500">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>
                </div>
            </div>
    </div>
    <br>
    <div class="shadow sm:rounded-md sm:overflow-hidden">
        <div class="bg-white py-6 px-4 space-y-6 sm:p-6">
            <div>
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    {{ __('label.Menu items') }}
                </h3>
                
                <div class="flex md:flex md:justify-center pt-3">
                    <input type="text" id="submenuTitle" value="{{ old('title') }}" class="flex-auto mx-1 mt-1 border border-gray-300 rounded-md shadow-sm py-2 px-5 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="{{ __('label.Submenu title') }}" />
                    <select class="" id="submenuUrl">
                        <option value="">{{ __('label.Submenu url') }}</option>
                    </select>
                    <button type="button" class="flex-auto mx-2 mt-1 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 add-menu border border-transparent rounded-md">
                        {{ __('Add menu item') }}
                    </button>
                </div>
            </div>
            <input type="hidden" id="menu-items-input" name="menu-items">
            <input type="hidden" id="menu-items-delete" name="menu-items-delete">
            <hr>
            <ol class='menu-items'>
                @foreach ($menu->children as $menuChild)

                <li id="{{'menu-'. $menuChild->id }}" data-id="{{ $menuChild->id }}" data-name="{{ $menuChild->title }}" data-url="{{ $menuChild->url }}">
                    <div>
                        <span class="submenu-title">{{ $menuChild->title }}</span>

                        <div class="float-right">
                            @include('tenant.menus.submenu-edit-buttons')
                        </div>
                    </div>


                    <ol>
                        @if (!empty($menuChild->children[0]))
                        @include('tenant.menus.submenu-child', [ 'menuChild' => $menuChild])
                        @endif
                    </ol>
                </li>

                @endforeach
            </ol>
        </div>
    </div>
</div>
<!-- RIGHT FORM -->
<div class="space-y-6 sm:px-6 lg:px-6 lg:col-span-4">
    <div class="shadow sm:rounded-md sm:overflow-hidden">
        <div class="bg-white py-6 px-4 space-y-6 sm:p-6">
            <fieldset>
                <legend class="text-base font-medium text-gray-900">
                    {{ __('label.Other options') }}
                </legend>
                <div class="mt-4 space-y-4">
                    <div class="flex items-start">
                        <div class="h-5 flex items-center">
                            <input id="status" name="status" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded" {{ old('status') || $menu->status ? 'checked' : '' }} value="1" />
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="status" class="font-medium text-gray-700">{{ __('label.Active') }}</label>
                            <p class="text-gray-500">
                                {{ __('label.Set this menu active in your store.') }}
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
                <a href="{{ route('tenant.menus.index') }}" class="py-1 px-4 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out">
                    {{ __('Cancel') }}
                </a>
            </span>
            <span class="ml-3 inline-flex rounded-md shadow-sm">
                <button type="submit" class="menu-submit py-1 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 shadow-sm hover:bg-indigo-500 focus:outline-none focus:shadow-outline-blue focus:bg-indigo-500 active:bg-indigo-600 transition duration-150 ease-in-out">
                    {{ __('Save') }}
                </button>
            </span>
        </div>
    </div>
    </form>
</div>
</div>

@endsection

@push('js')
<script src="{{ URL::to('/') . '/js/jquery-sortable.js' }}"></script>
<script src="{{ URL::to('/') . '/js/sortable-menu.js' }}"></script>
<script src="{{ URL::to('/') . '/js/edit-side-menu.js' }}"></script>
<script>
    function isValidHttpUrl(string) {
        let res = string.match(/(http(s)?:\/\/.)?(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)/g);
        return (res !== null)
    }

    // CSRF Token
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $(function() {
        $('#submenuUrl').select2({
            selectOnClose: true,
            tags: true,
            createTag: function(params) {
                // Don't offset to create a tag if there is no @ symbol
                if (!isValidHttpUrl(params.term)) {
                    // Return null to disable tag creation
                    return null;
                }

                return {
                    id: params.term,
                    text: params.term
                }
            },
            language: "pt-BR",
            ajax: {
                placeholder: "{{ __('label.Submenu url') }}",
                url: '{{ route("tenant.menus.get-url")}}',
                dataType: 'json',
                type: "post",
                delay: 250,
                data: function(params) {
                    return {
                        _token: CSRF_TOKEN,
                        search: params.term // search term
                    };
                },
                processResults: function(response) {
                    return {
                        results: response
                    };
                },
                cache: true
                // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
            }
        });
    })

    // $('#select2').on('change', function(e) {
    //     var item = $('#select2').select2("val");
    //     @this.set('viralSongs', item);
    // });

    console.log('select')
</script>
@endpush