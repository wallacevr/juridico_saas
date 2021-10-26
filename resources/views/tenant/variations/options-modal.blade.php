@push('head')
<link rel="stylesheet" href="{{ URL::to('/') . '/css/image-preview-input.css' }}">
@endpush

<div id="option-modal" class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true" style="display: none">
    <div class="flex justify-center h-screen items-center bg-gray-500 bg-opacity-75 transition-opacity antialiased">
        <div class="flex flex-col w-11/12 sm:w-5/6 lg:w-1/2 max-w-2xl mx-auto rounded-lg border border-gray-300 shadow-xl">
            <form id="optionForm" action="{{ route('tenant.options.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="variation_id" name="variation_id" value="{{ $variation->id }}">
                <input type="hidden" id="option_id" name="option_id">
                <input type="hidden" id="_method" name="_method">
                <div class="flex flex-row justify-between p-6 bg-white border-b border-gray-200 rounded-tl-lg rounded-tr-lg">
                    <p id="add-label" class="font-semibold text-gray-800">{{ __('Add option') }}</p>
                    <p id="update-label" class="font-semibold text-gray-800 hidden">{{ __('Update option') }}</p>

                    <a href="#">
                        <svg class="w-6 h-6 close-modal" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </a>
                </div>

                <div class="flex flex-col px-6 py-5 bg-gray-50">
                    @include('layouts.snippets.fields', ['type'=>'text','label'=>'Option name','placeholder'=>'e.g. Small','name'=>'option_name','value'=> '' ])
                    <br>
                    <div class="grid grid-cols-3 gap-6">
                        @if ($variation->type === 'COLOR')
                        <div class="sm:col-span-1">
                            <label for="type" class="block text-sm font-medium text-gray-700">
                                {{ __('Type') }}
                            </label>
                            <select id="type" name="type" class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="COLOR">
                                    {{ __('Color') }}
                                </option>
                                <option value="IMAGE">
                                    {{ __('Image') }}
                                </option>
                            </select>
                        </div>

                        <div class="sm:col-span-1 py-2 color-block">
                            <label for="color-picker" class="block text-sm font-medium text-gray-700">
                                {{ __('Select a color') }}
                            </label>
                            <input type="color" name="color-picker" id="color-picker" class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none sm:text-sm">
                        </div>

                        <div class="sm:col-span-1 color-block">
                            <label for="value" class="block text-sm font-medium text-gray-700">
                                {{ __('Hex color') }}
                            </label>
                            <input name="value" type="text" id="color-input" class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" readonly>
                        </div>

                        <div class="sm:col-span-3 image-block hidden">
                            <label for="image_url" class="block text-sm font-medium text-gray-700">
                                {{ __('Option image') }}
                            </label>
                            <div class="shadow sm:rounded-md sm:overflow-hidden">
                                <div class="bg-white py-6 px-4 space-y-6 sm:p-6">
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
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="sm:col-span-3">
                            @include('layouts.snippets.fields', ['type'=>'text','label'=>'Option value','placeholder'=>'e.g. S','name'=>'value','value'=> '' ])
                        </div>
                        @endif
                    </div>
                </div>

                <div class="flex flex-row items-center justify-between p-5 bg-white border-t border-gray-200 rounded-bl-lg rounded-br-lg">
                    <button type="button" class="close-modal mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm">
                        {{ __('Cancel') }}
                    </button>
                    <button id="save-option" type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-500 text-base font-medium text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                        {{ __('Save option') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


@push('js')
<script src="{{ URL::to('/') . '/js/image-preview-input.js' }}"></script>
<script>
    $(document).ready(function() {
        $("#optionForm").validate({
            rules: {
                option_name: {
                    required: true
                },
                value: {
                    required: true
                },
            }
        });
    });
</script>
@endpush
