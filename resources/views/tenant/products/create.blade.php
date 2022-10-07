@push('head')
    <link rel="stylesheet" href="{{ URL::to('/') . '/css/jquery.fileuploader.min.css' }}">
    <link rel="stylesheet" href="{{ URL::to('/') . '/font/font-fileuploader.css' }}">
    <link rel="stylesheet" href="{{ URL::to('/') . '/css/jquery.fileuploader-theme-gallery.css' }}">
    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
@endpush

@extends('layouts.tenant', ['title' => __('Create product')])

@section('content')
@livewire('tenant.product.create-product')
@endsection

@push('js')
    <script src="{{ URL::to('/') . '/js/jquery.fileuploader.min.js' }}"></script>
    <script src="{{ URL::to('/') . '/js/string-slugger.js' }}"></script>
    <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
    <script>
    // Get a reference to the file input element
    const inputElement = document.querySelector('input[type="file" class="my-pond"]');

    // Create a FilePond instance
    const pond = FilePond.create(inputElement);
</script>
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
