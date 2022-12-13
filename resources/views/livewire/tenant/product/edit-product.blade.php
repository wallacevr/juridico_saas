<div>

<div class="lg:grid lg:grid-cols-12 lg:gap-x-5">
        <!-- LEFT FORM -->
        <div class="space-y-6 sm:px-6 lg:px-0 lg:col-span-8">
            <form id="productForm" enctype="multipart/form-data">
                @csrf
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
                                    'value' => '',
                                    'require' => true,
                                    'wiremodel' =>'name'
                                ])
                            </div>

                            <div class="col-span-12" wire:ignore>
                                @include('layouts.snippets.text-editor-product', [
                                    'label' => 'Description',
                                    'name' => 'description',
                                    'value' => '',
                                    'wiremodel' =>'description'
                                ])
                                <script>
                                    const editor = CKEDITOR.replace('description');
                                    editor.on('change', function(event){
                                        console.log(event.editor.getData())
                                        @this.set('description', event.editor.getData());
                                    })
                            </script>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white py-6 px-4 space-y-6 sm:p-6 ">
                        <div class="w-full sm:w-1/3 md:w-1/3 lg:w-1/4 xl:w-1/6" >
                            @include('layouts.snippets.fields', [
                                'type' => 'text',
                                'label' => 'SKU',
                                'placeholder' => 'SKU',
                                'name' => 'sku',
                                'value' => '',
                                'require' => true,
                                'wiremodel' => 'sku'
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
                                    'value' => '',
                                    'require' => true,
                                    'wiremodel' => 'price'
                                ])
                            </div>

                            <div class="col-span-12 sm:col-span-3">
                                @include('layouts.snippets.fields', [
                                    'type' => 'text',
                                    'label' => 'Special price',
                                    'placeholder' => 'R$ 90,00',
                                    'name' => 'special_price',
                                    'value' => '',
                                    'require' => false,
                                    'wiremodel' => 'special_price'
                                ])
                            </div>

                            <div class="col-span-12 sm:col-span-3">
                                @include('layouts.snippets.fields', [
                                    'type' => 'text',
                                    'label' => 'Cost price',
                                    'placeholder' => 'R$ 90,00',
                                    'name' => 'cost',
                                    'value' => '',
                                    'require' => false,
                                    'wiremodel' => 'cost_price'
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
                                    <select name="manage_stock" wire:model="manage_stock">
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
                                    'value' => '1',
                                    'require' => false,
                                    'wiremodel' => 'qty'
                                ])
                            </div>
                            <div class="col-span-12 sm:col-span-3">
                                @include('layouts.snippets.fields', [
                                    'type' => 'number',
                                    'label' => 'Min Qty',
                                    'placeholder' => 'R$ 90,00',
                                    'name' => 'min_qty',
                                    'value' => '1',
                                    'require' => false,
                                    'wiremodel' => 'min_qty'
                                ])
                            </div>

                            <div class="col-span-12 sm:col-span-3">
                                @include('layouts.snippets.fields', [
                                    'type' => 'number',
                                    'label' => 'Max Qty',
                                    'placeholder' => 'R$ 90,00',
                                    'name' => 'max_qty',
                                    'value' => '0',
                                    'require' => false,
                                    'wiremodel' => 'max_qty'
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
                                'value' => '',
                                'require' => false,
                                'wiremodel' => 'meta_title'
                            ])
                        </div>

                        <div class="col-span-3">
                            <label for="meta_description" class="block text-sm font-medium text-gray-700">
                                {{ __('Description') }}
                            </label>
                            <div class="mt-1">
                                <textarea wire:model="meta_description" id="meta_description" name="meta_description" rows="5"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ old('seo_description') }}</textarea>
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
                                <input type="text" name="slug" id="slug" autocomplete="slug" wire:model="slug"
                                    class="block w-full border border-gray-300 shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    value="{{ old('slug') }}" />
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
                                <input type="checkbox" name="options" id="options" wire:model="habilitavariations"> {{ __('This product has options such as size or color') }}
                            </h3>

                        </div>
                @if($habilitavariations)

                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-12 sm:col-span-6">
                                    <legend class="text-base font-medium text-gray-900">

                                        {{ __("Product's variations ") }}

                                    </legend>
                                    <div class="mt-5 space-y-4 mb-5">
                                        <div class="flex items-start ">
                                            <div wire:ignore class="w-full">

                                                    <select class="form-control js-basic-multiple w-full" name="variations_id[]" id="select2" multiple="multiple" >

                                                        @foreach($variations as $variation)
                                                            <option value="{{ $variation->id }}"
                                                                @if(in_array( $variation->id,$selected))
                                                                        selected
                                                                @endif

                                                                    >{{ $variation->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <script>
                                                            $(document).ready(function () {

                                                                $('#select2').select2({
                                                                    placeholder: 'seletec the variations of this product ',
                                                                    allowClear: true   // Shows an X to allow the user to clear the value.
                                                                });
                                                                $('#select2').on('change', function (e) {

                                                                    var data = $('#select2').select2("val");
                                                                     @this.set('selected', data);


                                                                });

                                                            });

                                                    </script>
                                            </div>

                                        </div>

                                    </div>

                                     <div class="mt-1"  wire:poll="listaoptions">
                                            @if($selected)

                                                @foreach($variationsselected as $variationselected)

                                                            <div wire:ignore>
                                                                <select class="form-control js-basic-multiple w-full" name="{{ $variationselected->name }}options[]" id="{{ $variationselected->name }}options" multiple="multiple" >

                                                                        @foreach($variationselected->options as $option)

                                                                            <option value="{{ $option->id }}"
                                                                            @if(in_array($option->id,$selected2[$option->variation_id]))
                                                                                    selected
                                                                            @endif


                                                                                >{{ $option->name }}</option>
                                                                        @endforeach

                                                                </select>
                                                                <script>
                                                                            $(document).ready(function () {

                                                                                $('#{{ $variationselected->name }}options').select2({
                                                                                    placeholder: "seletec the {{$variationselected->name }}'s options of this product ",
                                                                                    allowClear: true   // Shows an X to allow the user to clear the value.
                                                                                });
                                                                                $('#{{ $variationselected->name }}options').on('change', function (e) {

                                                                                    var data = $('#{{ $variationselected->name }}options').select2("val");

                                                                                    @this.set('selected2.{{$variationselected->id}}', data);


                                                                                });

                                                                            });

                                                                    </script>
                                                            </div>

                                                    @endforeach
                                             @endif
                                     </div>
                            </div>

                    </div>
                @endif
            </div>

        </div>
        <br>
            <div class="shadow sm:rounded-md sm:overflow-hidden">
                    <div class="bg-white py-6 px-4 space-y-6 sm:p-6">
                                <div>

                                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                                        {{ __("Input the option's price and  qty in stock") }}
                                    </h3>

                                </div>
                                @if($habilitavariations)

                                        <div class="grid grid-cols-6 gap-6">
                                            <div class="col-span-12 sm:col-span-6">

                                                <div class="mt-5 space-y-4 mb-5">
                                                    <div class="flex items-start ">
                                                        <div class="w-full">
                                                            <table>
                                                                @php
                                                                 $x=0;
                                                                @endphp
                                                                @foreach($combinacoes as $combinacao)
                                                                    <tr>

                                                                        @foreach($combinacao as $option)

                                                                            <td>{{$this->getOption($option)}}</td>

                                                                        @endforeach
                                                                        <td class="w-1/4 px-2.5">

                                                                                @include('layouts.snippets.optionsfields', [
                                                                                    'type' => 'text',
                                                                                    'label' => 'Price',
                                                                                    'placeholder' => 'R$90,00',
                                                                                    'name' => 'price',
                                                                                    'value' => '',
                                                                                    'require' => false,
                                                                                    'wiremodel' => 'optionprice',
                                                                                    'i'=> $x
                                                                                ])

                                                                        </td>
                                                                            <td class="w-1/4 px-2.5">

                                                                                    @include('layouts.snippets.optionsfields', [
                                                                                        'type' => 'number',
                                                                                        'label' => 'Qty',
                                                                                        'placeholder' => 'Qty',
                                                                                        'name' => 'qty',
                                                                                        'value' => '',
                                                                                        'require' => false,
                                                                                        'min' => 0,
                                                                                        'wiremodel' => 'optionqty',
                                                                                        'i'=> $x
                                                                                    ])

                                                                            </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="{{(count($variationsselected)+2)}}" >
                                                                       {{-- <x-input.filepond wire:model="optionimages.{{ $x }}" multiple></x-input> --}}


                                                                                <input wire:model="optionimages.{{ $x }}" class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" type="file" multiple>
                                                                                <div wire:loading wire:target="optionimages.{{ $x }}">Uploading...</div>

                                                                        </td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td colspan="{{(count($variationsselected)+2)}}" >
                                                                             @isset($optionimages[$x])
                                                                                <div class="flex ...">
                                                                                     @php
                                                                                       $position=1;
                                                                                     @endphp
                                                                                     <div class="w-full ">Selecione a imagem Pricipal</div>

                                                                                       @foreach($optionimages[$x] as $key=>$photo)
                                                                                       <div class="w-1/5 ">
                                                                                            <img src="{{ $photo->temporaryUrl() }}">
                                                                                            <a href="#" wire:click="removerimagem({{$x}},{{$key}})">
                                                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6" >
                                                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                                                                </svg>
                                                                                            </a>
                                                                                            <input type="radio" name="principaloptionimage{{$x}}" wire:model="principaloptionimage.{{$x}}" value="{{$key}}"
                                                                                            {{ dd($photo->main) }}
                                                                                            @if($photo->main == 1)
                                                                                                selected
                                                                                            @endif
                                                                                            >

                                                                                        </div>

                                                                                        @php
                                                                                            $position=$position+1;
                                                                                        @endphp

                                                                                       @endforeach

                                                                                </div>
                                                                              @endisset
                                                                              @isset($optionimagessaveds[$x])
                                                                                <div class="flex ...">
                                                                                     @php
                                                                                       $position=1;
                                                                                     @endphp

                                                                                       @foreach($optionimagessaveds[$x] as $key=>$photo)

                                                                                       <div class="w-1/5 ">
                                                                                            <img  src="{{  tenant_public_path()  }}/images/catalog/{{$productid}}/{{$photo['product_options_id']}}/{{$photo['image_url']}}" >
                                                                                            <a href="#" wire:click="deleteimagem({{$photo['id']}},{{$x}},{{$key}})">
                                                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6" >
                                                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                                                                </svg>
                                                                                            </a>
                                                                                            <input type="radio" name="principaloptionimage{{$x}}" wire:model="principaloptionimage.{{$x}}" >

                                                                                        </div>

                                                                                        @php
                                                                                            $position=$position+1;
                                                                                        @endphp

                                                                                       @endforeach

                                                                                </div>
                                                                                <div class="">
                                                                                    <x-input.filepondoptions name="optionimages{{ $x }}" wire:model="optionimages.{{ $x }}" data-key="{{ $x }}"  data-file-metadata-key="{{ $x }}" data-optionid="10" multiple></x-input>
                                                                    
                                                                                </div>
                                                                              @endisset
                                                                        </td>
                                                                    </tr>
                                                                    @php
                                                                            $x=$x+1;
                                                                    @endphp
                                                                @endforeach
                                                            </table>

                                                        </div>

                                                    </div>

                                                 </div>


                                            </div>

                                         </div>
                                 @endif
                    </div>

                </div>
                <br>
                <div class="shadow sm:rounded-md sm:overflow-hidden" wire:ignore>
                    <div class="bg-white py-6 px-4 space-y-6 sm:p-6">
                        <div>
                            <h3 class="text-lg leading-6 font-medium text-gray-900">
                                {{ __('Upload product images') }}
                            </h3>
                        </div>

                        <div class="">
                                <x-input.filepond wire:model="productimages" multiple></x-input>
                        </div>
                        <script>


                        </script>
                        @error('image_url')
                            <p class="mt-2 text-sm text-red-500">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>
                </div>
                <div>
                    @error('productimages')
                    <p class="mt-2 text-sm text-red-500">
                        {{ $message }}
                    </p>
                @enderror
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
                                    <input id="status" name="status" type="checkbox" wire:model="status"
                                        class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded"
                                        {{ old('status') ? 'checked' : '' }} value="1" />
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
                <div class="bg-white py-6 px-4 space-y-6 sm:p-6" >
                    <fieldset>
                        <legend class="text-base font-medium text-gray-900">
                            {{ __('Collections') }}
                        </legend>
                        <div class="mt-4 space-y-4">
                            <div class="flex items-start">
                                <div class="h-5 flex items-center w-full" wire:ignore>
                                    <select id="collections" name="collections[]" multiple="multiple" class="w-full">
                                            @foreach($collections as $collection)
                                                <option value="{{$collection->id}}"
                                                  @if($newselectedcollections==[])
                                                    @if($selectedcollections->contains($collection->id))
                                                        selected
                                                    @endif
                                                        >{{$collection->name}}</option>
                                                  @else
                                                    @if( in_array($collection->id,$newselectedcollections))
                                                     
                                                        selected
                                                     @endif
                                                        >{{$collection->name}}</option>

                                                  @endif
                                            @endforeach
                                    </select>
                                    
                                    <script>
                                            $(document).ready(function () {
                                                $('#collections').select2();

                                                $('#collections').on('change', function (e) {

                                                    var datax = $('#collections').select2("val")+ '';
                                                        console.log(datax);
                                                        @this.set('newselectedcollections', datax.split(','));


                                                });

                                            });

                                    </script>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                </div>
                <div class="bg-white py-6 px-4 space-y-6 sm:p-6" >
                    <fieldset>
                        <legend class="text-base font-medium text-gray-900">
                            {{ __('Brands') }}
                        </legend>
                        <div class="mt-4 space-y-4">
                            <div class="flex items-start">
                                <div class="h-5 flex items-center w-full" wire:ignore>
                                    <select id="brands" name="brands[]" multiple="multiple" class="w-full">
                                            @foreach($brands as $brand)
                                                <option value="{{$brand->id}}"
                                                @if($newselectedbrands==[])
                                                    @if($selectedbrands->contains($brand->id))
                                                        selected
                                                    @endif
                                                    
                                                @else
                                               
                                                    @if( in_array($brand->id,$newselectedbrands))
                                                        selected
                                                    @endif

                                                @endif
                                                >{{$brand->name}}</option>
                                            @endforeach
                                    </select>
                        <script>
                            $(document).ready(function () {
                                $('#brands').select2();
                                $('#brands').on('change', function (e) {
                                    var data = $('#brands').select2("val");
                                    console.log(data);
                                @this.set('newselectedbrands', data);
                                });
                            });
                        </script>
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
                        <button type="button" wire:click="store"
                            class="py-1 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 shadow-sm hover:bg-indigo-500 focus:outline-none focus:shadow-outline-blue focus:bg-indigo-500 active:bg-indigo-600 transition duration-150 ease-in-out">
                            {{ __('Save') }}
                        </button>
                    </span>
                </div>
            </div>
            </form>

        </div>
    </div>
@push('js')
<script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
@endpush
</div>
