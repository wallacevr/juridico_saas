@push('head')
    <link rel="stylesheet" href="{{ URL::to('/') . '/css/jquery.fileuploader.min.css' }}">
    <link rel="stylesheet" href="{{ URL::to('/') . '/font/font-fileuploader.css' }}">
    <link rel="stylesheet" href="{{ URL::to('/') . '/css/jquery.fileuploader-theme-gallery.css' }}">
@endpush

@extends('layouts.tenant', ['title' => __('Create product')])

@section('content')
<form action="{{ route('tenant.products.destroy', ['product' => $product->id]) }}" method="post" style="margin-top: 4px;">
        @csrf
        @method('DELETE')
        <button type="submit" class="delete-resource-button">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
            </svg>
        </button>
    </form>
<div class="lg:grid lg:grid-cols-12 lg:gap-x-5">
    <!-- LEFT FORM -->
    <div class="space-y-6 sm:px-6 lg:px-0 lg:col-span-8">
        <form id="productForm" action="{{ route('tenant.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="shadow sm:rounded-md sm:overflow-hidden shadow-indigo-200">
                    <div class="px-4 py-5 sm:px-6 ">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">{{ __('Basic information') }}</h3>
                        <p class="mt-1 max-w-2xl text-sm text-gray-500"></p>
                    </div>
                    <div class="bg-white py-6 px-4 space-y-6 sm:p-6">
                        <div class="grid grid-cols-3 gap-6">
                            <div class="col-span-12 sm:col-span-12">
                                @include('layouts.snippets.fields', [
                                    'type' => 'text',
                                    'label' => 'Name',
                                    'placeholder' => 'Product name',
                                    'name' => 'name',
                                    'value' => $product->name,
                                    'require' => true,
                                ])
                            </div>
                                   
                            <div class="col-span-12">
                                @include('layouts.snippets.text-editor', [
                                    'label' => 'Description',
                                    'name' => 'description',
                                    'value' => $product->description,
                                ])
                            </div>
                        </div>
                    </div>
                    <div class="bg-white py-6 px-4 space-y-6 sm:p-6 ">
                        <div class="w-full sm:w-1/3 md:w-1/3 lg:w-1/4 xl:w-1/6">
                            @include('layouts.snippets.fields', [
                                'type' => 'text',
                                'label' => 'SKU',
                                'placeholder' => 'SKU',
                                'name' => 'sku',
                                'value' => $product->sku,
                                'require' => true,
                            ])
                        </div>
                    </div>
                </div>
                <br>
                <div class="shadow sm:rounded-md sm:overflow-hidden">
                    <div class="bg-white py-6 px-4 space-y-6 sm:p-6">
                        <div class="grid grid-cols-3 gap-6">
                            <div class="col-span-12 sm:col-span-3">
                                @include('layouts.snippets.fields', [
                                    'type' => 'text',
                                    'label' => 'Price',
                                    'placeholder' => 'R$ 90,00',
                                    'name' => 'price',
                                    'value' => $product->price,
                                    'require' => true,
                                ])
                            </div>

                            <div class="col-span-12 sm:col-span-3">
                                @include('layouts.snippets.fields', [
                                    'type' => 'text',
                                    'label' => 'Special price',
                                    'placeholder' => 'R$ 90,00',
                                    'name' => 'special_price',
                                    'value' => $product->special_price,
                                    'require' => false,
                                ])
                            </div>

                            <div class="col-span-12 sm:col-span-3">
                                @include('layouts.snippets.fields', [
                                    'type' => 'text',
                                    'label' => 'Cost price',
                                    'placeholder' => 'R$ 90,00',
                                    'name' => 'cost',
                                    'value' => $product->cost,
                                    'require' => false,
                                ])
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="shadow sm:rounded-md sm:overflow-hidden">
                    <div class="bg-white py-6 px-4 space-y-6 sm:p-6">
                        <div class="grid grid-cols-3 gap-6">
                            <div class="col-span-12 sm:col-span-3">
                                <label for="meta_description" class="block text-sm font-medium text-gray-700">
                                    {{ __('Manage Stock') }}
                                </label>
                                <div class="mt-1">
                                    <select name="manage_stock">
                                        <option>{{ __('Select') }}</option>
                                        <option value="1" selected>{{ __('Yes') }}</option>
                                        <option value="0">{{ __('No') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-span-12 sm:col-span-3">
                                @include('layouts.snippets.fields', [
                                    'type' => 'number',
                                    'label' => 'Qty',
                                    'placeholder' => 'R$ 90,00',
                                    'name' => 'qty',
                                    'value' => $product->qty,
                                    'require' => false,
                                ])
                            </div>
                            <div class="col-span-12 sm:col-span-3">
                                @include('layouts.snippets.fields', [
                                    'type' => 'number',
                                    'label' => 'Min Qty',
                                    'placeholder' => 'R$ 90,00',
                                    'name' => 'min_qty',
                                    'value' => $product->min_qty,
                                    'require' => false,
                                ])
                            </div>

                            <div class="col-span-12 sm:col-span-3">
                                @include('layouts.snippets.fields', [
                                    'type' => 'number',
                                    'label' => 'Max Qty',
                                    'placeholder' => 'R$ 90,00',
                                    'name' => 'max_qty',
                                    'value' => $product->max_qty,
                                    'require' => false,
                                ])
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
                                {{ __('Add a title and description to see how this product might appear in a search engine listing.') }}
                            </p>
                        </div>

                        <div class="col-span-12 sm:col-span-3">
                            @include('layouts.snippets.fields', [
                                'type' => 'text',
                                'label' => 'Title',
                                'placeholder' => 'Meta title',
                                'name' => 'meta_title',
                                'value' => $product->meta_title,
                                'require' => false,
                            ])
                        </div>

                        <div class="col-span-3">
                            <label for="meta_description" class="block text-sm font-medium text-gray-700">
                                {{ __('Description') }}
                            </label>
                            <div class="mt-1">
                                <textarea id="meta_description" name="meta_description" rows="5"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ $product->meta_description }}</textarea>
                            </div>
                        </div>

                        <div class="col-span-3 sm:col-span-2">
                            <label for="slug" class="block text-sm font-medium text-gray-700">
                                {{ __('URL and handle') }}
                            </label>
                            <div class="mt-1 rounded-md shadow-sm flex">
                                <span
                                    class="bg-gray-50 border border-r-0 border-gray-300 px-3 inline-flex items-center text-gray-500 sm:text-sm">
                                    https://{{ Request::getHost() . '/' }}
                                </span>
                                <input type="text" name="slug" id="slug" autocomplete="slug"
                                    class="block w-full border border-gray-300 shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    value="{{ $product->slug }}" />
                            </div>
                            @error('slug')
                                <p class="mt-2 text-sm text-red-500">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                </div>
                <br>
                <div class="shadow sm:rounded-md sm:overflow-hidden">
                    <div class="bg-white py-6 px-4 space-y-6 sm:p-6">
                        <div>
                            <h3 class="text-lg leading-6 font-medium text-gray-900">
                                {{ __('Upload product images') }}
                            </h3>
                        </div>
                        
                        <div class="">
                            <div class="file-upload">
                                <div id="file-upload-content" class="form">
                                    @php
                                        $imageview="";
                                        foreach($product->images as $image){
                                            $imageview= $imageview. '{"name":"'. $image->image_url .'","type":"image\/jpeg","size":71135,"file":"'. tenant_public_path().'/images\/catalog\/'. $image->image_url .'","local":"'. tenant_public_path().'/images\/catalog\/'. $image->image_url .'","data":{"url":"'. tenant_public_path().'/images\/catalog\/'. $image->image_url .'","thumbnail":"'. tenant_public_path().'/images\/catalog\/'. $image->image_url .'","readerForce":true}},';
                                        }
                                        $imageview= rtrim($imageview, ",");
                                    @endphp
                                    <input type="file" name="files" class="gallery_media" data-fileuploader-files='[
                                            {{$imageview}}
                                   
                                        
                                        ]'>
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
                                    <input id="status" name="status" type="checkbox"
                                        class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded"
                                        {{ $product->status? 'checked' : '' }} value="1" />
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="status" class="font-medium text-gray-700">{{ __('Active') }}</label>
                                    <p class="text-gray-500">
                                        {{ __('Set this product active in your store.') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="bg-white py-6 px-4 space-y-6 sm:p-6">
                    <fieldset>
                        <legend class="text-base font-medium text-gray-900">
                            {{ __('Collections') }}
                        </legend>
                        <div class="mt-4 space-y-4">
                            <div class="flex items-start">
                                <div class="h-5 flex items-center w-full">
                                   
                                    <select id="collections" name="collections[]" multiple="multiple" class="w-full">
                                     @foreach($collections as $collection)
                                            <option value="{{$collection->id}}"
                                                @if($product->collections->pluck('id')->contains($collection->id))
                                                    selected
                                                @endif
                                                >{{$collection->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>


            <div class="bg-white py-6 px-4 space-y-6 sm:p-6">
                <div class="flex justify-end">
                    <span class="inline-flex rounded-md shadow-sm">
                        <a href="{{ route('tenant.products.index') }}"
                            class="py-1 px-4 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out">
                            {{ __('Cancel') }}
                        </a>
                    </span>
                    <span class="ml-3 inline-flex rounded-md shadow-sm">
                        <button type="submit"
                            class="py-1 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 shadow-sm hover:bg-indigo-500 focus:outline-none focus:shadow-outline-blue focus:bg-indigo-500 active:bg-indigo-600 transition duration-150 ease-in-out">
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
    <script src="{{ URL::to('/') . '/js/jquery.fileuploader.min.js' }}"></script>
    <script src="{{ URL::to('/') . '/js/string-slugger.js' }}"></script>
    <script>
        $(document).ready(function() {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $('#collections').select2({
                selectOnClose: true,
                tags: false,
                multiple: true,
                language: "pt-BR",
                ajax: {
                    url: "{{ route('tenant.collections.all') }}",
                    dataType: 'json',
                    type: "get",
                    delay: 250,
                    data: function(params) {
                        return {
                            _token: CSRF_TOKEN,
                            search: params
                        };
                    }
                }
            });

            // enable fileuploader plugin
            var $fileuploader = $('input.gallery_media').fileuploader({
                limit: 100,
                fileMaxSize: 20,
                extensions: ['image/*', 'video/*'],
                changeInput: ' ',
                theme: 'gallery',
                enableApi: true,
                thumbnails: {
                    box: '<div class="fileuploader-items">' +
                        '<ul class="fileuploader-items-list">' +
                        '<li class="fileuploader-input"><button type="button" class="fileuploader-input-inner"><i class="fileuploader-icon-main"></i> <span>${captions.feedback}</span></button></li>' +
                        '</ul>' +
                        '</div>',
                    item: '<li class="fileuploader-item">' +
                        '<div class="fileuploader-item-inner">' +
                        '<div class="actions-holder">' +
                        '<button type="button" class="fileuploader-action fileuploader-action-sort is-hidden" title="${captions.sort}"><i class="fileuploader-icon-sort"></i></button>' +
                        '<button type="button" class="fileuploader-action fileuploader-action-settings is-hidden" title="${captions.edit}"><i class="fileuploader-icon-settings"></i></button>' +
                        '<button type="button" class="fileuploader-action fileuploader-action-remove" title="${captions.remove}"><i class="fileuploader-icon-remove"></i></button>' +
                        '<div class="gallery-item-dropdown">' +
                        '<a class="gallery-action-rename">${captions.setting_rename}</a>' +
                        '<a class="gallery-action-asmain">${captions.setting_asMain}</a>' +
                        '</div>' +
                        '</div>' +
                        '<div class="thumbnail-holder">' +
                        '${image}' +
                        '<span class="fileuploader-action-popup"></span>' +
                        '<div class="progress-holder"><span></span>${progressBar}</div>' +
                        '</div>' +
                        '<div class="content-holder"><h5 title="${name}">${name}</h5><span>${size2}</span><input type="text" name="imagename[]" value="${title}"></div>' +
                        '<div class="type-holder">${icon}</div>' +
                        '</div>' +
                        '</li>',
                    item2: '<li class="fileuploader-item file-main-${data.isMain}">' +
                        '<div class="fileuploader-item-inner">' +
                        '<div class="actions-holder">' +
                        '<button type="button" class="fileuploader-action fileuploader-action-sort" title="${captions.sort}"><i class="fileuploader-icon-sort"></i></button>' +
                        '<button type="button" class="fileuploader-action fileuploader-action-settings" title="${captions.edit}"><i class="fileuploader-icon-settings"></i></button>' +
                        '<button type="button" class="fileuploader-action fileuploader-action-remove" title="${captions.remove}"><i class="fileuploader-icon-remove"></i></button>' +
                        '<div class="gallery-item-dropdown">' +
                        '<a href="${data.url}" target="_blank">${captions.setting_open}</a>' +
                        '<a href="${data.url}" download>${captions.setting_download}</a>' +
                        '<a class="fileuploader-action-popup">${captions.setting_edit}</a>' +
                        '<a class="gallery-action-rename">${captions.setting_rename}</a>' +
                        '<a class="gallery-action-asmain">${captions.setting_asMain}</a>' +
                        '</div>' +
                        '</div>' +
                        '<div class="thumbnail-holder">' +
                        '${image}' +
                        '<span class="fileuploader-action-popup"></span>' +
                        '</div>' +
                        '<div class="content-holder"><h5 title="${name}">${name}</h5><span>${size2}</span></div>' +
                        '<div class="type-holder">${icon}</div>' +
                        '</div>' +
                        '</li>',
                    itemPrepend: true,
                    startImageRenderer: true,
                    canvasImage: false,
                    onItemShow: function(item, listEl, parentEl, newInputEl, inputEl) {
                        var api = $.fileuploader.getInstance(inputEl),
                            color = api.assets.textToColor(item.format),
                            $plusInput = listEl.find('.fileuploader-input'),
                            $progressBar = item.html.find('.progress-holder');

                        // put input first in the list
                        $plusInput.prependTo(listEl);

                        // color the icon and the progressbar with the format color
                        item.html.find('.type-holder .fileuploader-item-icon')[api.assets.isBrightColor(
                            color) ? 'addClass' : 'removeClass']('is-bright-color').css(
                            'backgroundColor', color);
                    },
                    onImageLoaded: function(item, listEl, parentEl, newInputEl, inputEl) {
                        var api = $.fileuploader.getInstance(inputEl);

                        // add icon
                        item.image.find('.fileuploader-item-icon i').html('')
                            .addClass('fileuploader-icon-' + (['image', 'video', 'audio'].indexOf(item
                                .format) > -1 ? item.format : 'file'));

                        // check the image size
                        if (item.format == 'image' && item.upload && !item.imU) {
                            if (item.reader.node && (item.reader.width < 100 || item.reader.height <
                                    100)) {
                                alert(api.assets.textParse(api.getOptions().captions.imageSizeError,
                                    item));
                                return item.remove();
                            }

                            item.image.hide();
                            item.reader.done = true;
                            item.upload.send();
                        }

                    },
                    onItemRemove: function(html) {
                        html.fadeOut(250);
                    }
                },
                dragDrop: {
                    container: '.fileuploader-theme-gallery .fileuploader-input'
                },
                upload: {
                    url: "{{ route('tenant.upload.upload') }}",
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    type: 'POST',
                    enctype: 'multipart/form-data',
                    start: true,
                    synchron: true,
                    beforeSend: function(item) {
                        // check the image size first (onImageLoaded)
                        if (item.format == 'image' && !item.reader.done)
                            return false;

                        // add editor to upload data after editing
                        if (item.editor && (typeof item.editor.rotation != "undefined" || item.editor
                                .crop)) {
                            item.imU = true;
                            item.upload.data.name = item.name;
                            item.upload.data.id = item.data.listProps.id;
                            item.upload.data._editorr = JSON.stringify(item.editor);
                        }

                        item.html.find('.fileuploader-action-success').removeClass(
                            'fileuploader-action-success');
                    },
                    onSuccess: function(result, item) {
                        var data = {};

                        try {
                            data = JSON.parse(result);
                        } catch (e) {
                            data.hasWarnings = true;
                        }

                        // if success update the information
                        if (data.isSuccess && data.files.length) {
                            if (!item.data.listProps)
                                item.data.listProps = {};
                            item.title = data.files[0].title;
                            item.name = data.files[0].name;
                            item.size = data.files[0].size;
                            item.size2 = data.files[0].size2;
                            item.data.url = data.files[0].url;
                            item.data.listProps.id = data.files[0].id;

                            item.html.find('.content-holder h5').attr('title', item.name).text(item
                                .name);
                            item.html.find('.content-holder input').val(item.title);
                            item.html.find('.content-holder span').text(item.size2);
                            item.html.find('.gallery-item-dropdown [download]').attr('href', item.data
                                .url);
                        }

                        // if warnings
                        if (data.hasWarnings) {
                            for (var warning in data.warnings) {
                                alert(data.warnings[warning]);
                            }

                            item.html.removeClass('upload-successful').addClass('upload-failed');
                            return this.onError ? this.onError(item) : null;
                        }

                        delete item.imU;
                        item.html.find('.fileuploader-action-remove').addClass(
                            'fileuploader-action-success');

                        setTimeout(function() {
                            item.html.find('.progress-holder').hide();

                            item.html.find(
                                    '.fileuploader-action-popup, .fileuploader-item-image')
                                .show();
                            item.html.find('.fileuploader-action-sort').removeClass(
                                'is-hidden');
                            item.html.find('.fileuploader-action-settings').removeClass(
                                'is-hidden');
                        }, 400);
                    },
                    onError: function(item) {
                        item.html.find(
                            '.progress-holder, .fileuploader-action-popup, .fileuploader-item-image'
                        ).hide();

                        // add retry button
                        item.upload.status != 'cancelled' && !item.imU && !item.html.find(
                                '.fileuploader-action-retry').length ? item.html.find('.actions-holder')
                            .prepend(
                                '<button type="button" class="fileuploader-action fileuploader-action-retry" title="Retry"><i class="fileuploader-icon-retry"></i></button>'
                            ) : null;
                    },
                    onProgress: function(data, item) {
                        var $progressBar = item.html.find('.progress-holder');

                        if ($progressBar.length) {
                            $progressBar.show();
                            $progressBar.find('span').text(data.percentage >= 99 ? 'Uploading...' : data
                                .percentage + '%');
                            $progressBar.find('.fileuploader-progressbar .bar').height(data.percentage +
                                '%');
                        }

                        item.html.find('.fileuploader-action-popup, .fileuploader-item-image').hide();
                    }
                },
                sorter: {
                    onSort: function(list, listEl, parentEl, newInputEl, inputEl) {
                        var api = $.fileuploader.getInstance(inputEl),
                            fileList = api.getFiles(),
                            list = [];

                        // prepare the sorted list
                        api.getFiles().forEach(function(item) {
                            console.log(item.data);
                            if (item.data.listProps)
                                list.push({
                                    name: item.name,
                                    title: item.title,
                                    id: item.data.listProps.id,
                                    index: item.index
                                });
                        });

                        // send request
                        $.post('php/ajax.php?type=sort', {
                            list: JSON.stringify(list)
                        });
                    }
                },
                afterRender: function(listEl, parentEl, newInputEl, inputEl) {
                    var api = $.fileuploader.getInstance(inputEl),
                        $plusInput = listEl.find('.fileuploader-input');

                    // bind input click
                    $plusInput.on('click', function() {
                        api.open();
                    });

                    // set drop container
                    api.getOptions().dragDrop.container = $plusInput;

                    // bind dropdown buttons
                    $('body').on('click', function(e) {
                        var $target = $(e.target),
                            $item = $target.closest('.fileuploader-item'),
                            item = api.findFile($item);

                        // toggle dropdown
                        $('.gallery-item-dropdown').hide();
                        if ($target.is('.fileuploader-action-settings') || $target.parent().is(
                                '.fileuploader-action-settings')) {
                            $item.find('.gallery-item-dropdown').show(150);
                        }

                        // rename
                        if ($target.is('.gallery-action-rename')) {
                            var x = prompt(api.getOptions().captions.rename, item.title);

                            if (x && item.data.listProps) {


                                //debugger;
                                item.title = x;
                                $item.find('.content-holder h5').attr(
                                    'title', item.title).html(item.title);
                                $item.find('.content-holder input').val(item.title);
                                api.updateFileList();



                            }
                        }

                        // set main
                        if ($target.is('.gallery-action-asmain') && item.data.listProps) {
                            api.getFiles().forEach(function(val) {
                                delete val.data.isMain;
                                val.html.removeClass(
                                    'file-main-0 file-main-1');
                            });
                            item.html.addClass('file-main-1');
                            item.data.isMain = true;

                            api.updateFileList();
                        }
                    });
                },
                onRemove: function(item) {
                    // send request
                    if (item.data.listProps)
                        $.post('php/ajax.php?type=remove', {
                            name: item.name,
                            id: item.data.listProps.id
                        });
                },
                captions: $.extend(true, {}, $.fn.fileuploader.languages['en'], {
                    feedback: 'Drag & Drop',
                    setting_asMain: 'Imagem principal',
                    setting_download: 'Download',
                    setting_edit: 'Editar',
                    setting_open: 'Abrir',
                    setting_rename: 'Editar Alt',
                    rename: 'Adiciome o ALT que quer alterar',
                    renameError: 'Please enter another name.',
                    imageSizeError: 'The image ${name} is too small.',
                })
            });

            // preload the files
            $.post('/upload?type=preload', null, function(result) {
                var api = $.fileuploader.getInstance($fileuploader),
                    preload = [];

                try {
                    // preload the files
                    preload = JSON.parse(result);

                    api.append(preload);
                } catch (e) {}
            });
        });
    </script>
@endpush
