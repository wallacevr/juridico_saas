<div>

<div class="lg:grid lg:grid-cols-12 lg:gap-x-5">
        <!-- LEFT FORM -->
        <div class="space-y-6 sm:px-6 lg:px-0 lg:col-span-8">
            <form id="productForm" action="{{ route('tenant.products.store') }}" method="POST" enctype="multipart/form-data">
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
                                    'type' => 'number',
                                    'min' =>'0',
                                    'step' =>'0.01',
                                    'datanumbertofixed' => '2',
                                    'datanumberstepfactor'=> '100',
                                    'class'=>'form-control currency',
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
                                    'type' => 'number',
                                    'min' =>'0',
                                    'step' =>'0.01',
                                    'datanumbertofixed' => '2',
                                    'datanumberstepfactor'=> '100',
                                    'class'=>'form-control currency',
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
                                    'type' => 'number',
                                    'min' =>'0',
                                    'step' =>'0.01',
                                    'datanumbertofixed' => '2',
                                    'datanumberstepfactor'=> '100',
                                    'class'=>'form-control currency',
                                    'label' => 'Cost price',
                                    'placeholder' => 'R$ 90,00',
                                    'name' => 'cost',
                                    'value' => '',
                                    'require' => false,
                                    'wiremodel' => 'cost_price'
                                ])
                            </div>
                        </div>
                        <div class="col-1">
                  
                                
                            <input type="checkbox" name="chkspecialpricing"  wire:model='usespecialprice'>
                            <label for="chkspecialpricing">Use Special pricing</label>
                        </div>
                        @if($usespecialprice)
                        <div class="w-full" >
                            <table>
                                <tr>
                      
                                    <td>

                                        <label for="customergroup{{count($groups)+1}}" class="block text-sm font-medium leading-5 text-gray-700 ">Customer Group<span class="red">*</span></label>
                                        <select name="customergroup" id="customergroup{{count($groups)+1}}"  class="form-control js-basic-multiple"    wire:model="grpcustomer.{{count($groups)+1}}">
                                            <option value="null">Selecione um Grupo</option>
                                            @foreach($customergroups as $group)

                                                <option value="{{$group->id}}">{{$group->name}}</option>
                                            @endforeach
                                        </select>
        
                                    </td>
                                    <td>
                                                      
                                            @include('layouts.snippets.optionsfields', [
                                                'type' => 'number',
                                                'label' => 'Min Qty',
                                                'placeholder' => 'Min Qty',
                                                'name' => 'minqtyspecialprice',
                                                'value' => '',
                                                'require' => true,
                                               
                                                'min' => 0,
                                                'wiremodel' => 'minqtyspecialprice',
                                                'i'=> count($groups)+1
                                            ])
                                    </td>
                                    <td>
                                            
                                            @include('layouts.snippets.optionsfields', [
                                                'type' => 'number',
                                                'min' =>'0',
                                                'step' =>'0.01',
                                                'datanumbertofixed' => '2',
                                                'datanumberstepfactor'=> '100',
                                                'class'=>'form-control currency',
                                                'label' => 'Price',
                                                'placeholder' => 'Price',
                                                'name' => 'specialpricegrp',
                                                'value' => '',
                                                'require' => true,
                                                'min' => 0,
                                                'wiremodel' => 'specialpricegrp',
                                                'i'=> count($groups)+1
                                            ])
                                    </td>
                                    <td class="pt-6"> 
                                        <button type="button" wire:click="addgrpcustomer"
                                            class="py-1 px-4 my-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 shadow-sm hover:bg-indigo-500 focus:outline-none focus:shadow-outline-blue focus:bg-indigo-500 active:bg-indigo-600 transition duration-150 ease-in-out">
                                            {{ __('Save') }}
                                        </button>
                                    </td>
                                </tr>
                                @foreach($groups as $key=>$group)
                                
                                  @isset($grpcustomer[$key+1])
                                            <tr>
                                                <td class="py-2"> 
                                                <button type="button" wire:click="removegroup({{$key}})"
                                                    class="py-1 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 shadow-sm hover:bg-red-500 focus:outline-none focus:shadow-outline-red focus:bg-red-500 active:bg-red-600 transition duration-150 ease-in-out">
                                                    {{ __('Remove') }}
                                                </button>
                                                </td>
                                                <td>
                                                 
                                                    <label for="customergroup{{($key)+1}}" class="block text-sm font-medium leading-5 text-gray-700 ">Customer Group<span class="red">*</span></label>
                                                    <select name="customergroup" id="customergroup{{($key+1)}}"  class="form-select r js-basic-multiple" wire:model="grpcustomer.{{($key)+1}}"  >
                                                        <option value="null">Selecione um Grupo</option>
                                                        @foreach($customergroups as $group)

                                                            <option value="{{$group->id}}">{{$group->name}}</option>
                                                        @endforeach
                                                    </select>
                                                 
                                                </td>
                                                <td>
                                                                
                                                        @include('layouts.snippets.optionsfields', [
                                                            'type' => 'number',
                                                            'label' => 'Min Qty',
                                                            'placeholder' => 'Min Qty',
                                                            'name' => 'minqtyspecialprice',
                                                            'value' => '',
                                                            'require' => true,
                                                            'min' => 0,
                                                            'wiremodel' => 'minqtyspecialprice',
                                                            'i'=> ($key)+1
                                                        ])
                                                </td>
                                                <td>
                                                        
                                                        @include('layouts.snippets.optionsfields', [
                                                            'type' => 'number',
                                                            'label' => 'Price',
                                                            'placeholder' => 'Price',
                                                            'name' => 'specialpricegrp',
                                                            'value' => '',
                                                            'require' => true,
                                                            'min' => 0,
                                                            'wiremodel' => 'specialpricegrp',
                                                            'i'=> ($key)+1
                                                        ])
                                                </td>
                                            </tr>
                                    @endisset

                                @endforeach
                            </table>
                              
      
                               
                        </div>
                        @endif
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
                                        
                                        <option value="1" selected>{{ __('Yes') }}</option>
                                        <option value="0">{{ __('No') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-span-12 sm:col-span-3">
                                @include('layouts.snippets.fields', [
                                    'type' => 'number',
                                    'label' => 'Qty',
                                    'placeholder' => '90',
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
                                    'placeholder' => '90',
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
                                    'placeholder' => '90',
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
                                                            <option value="{{ $variation->id }}">{{ $variation->name }}</option>
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
                                                                            <option value="{{ $option->id }}">{{ $option->name }}</option>
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
                     @if($habilitavariations)  
                    <div class="bg-white py-6 px-4 space-y-6 sm:p-6">
                                <div>
                                    
                                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                                        {{ __("Input the option's price and  qty in stock") }}
                                    </h3>
                            
                                </div>
                             
                                
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
                                                                                        'value' => '{{$option->qty_stock}}',
                                                                                        'require' => false,
                                                                                        'min' => 0,
                                                                                        'wiremodel' => 'optionqty',
                                                                                        'i'=> $x
                                                                                    ])

                                                                                        
                                                                            </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="{{(count($variationsselected)+2)}}" >
                                                                                @php
                                                                                    $optionid=$x;

                                                                                @endphp
                                                                                <x-input.filepondoptions wire:model="optionimages.{{ $x }}"></x-input>
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
                                 
                    </div>
                    @endif
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
                                <x-input.filepond name="productimages" wire:model="productimages" multiple></x-input>
      
                        </div>

                        <script>


                        </script>


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
                <div class="bg-white py-6 px-4 space-y-6 sm:p-6" wire:ignore>
                    <fieldset>
                        <legend class="text-base font-medium text-gray-900">
                            {{ __('Collections') }}
                        </legend>
                        <div class="mt-4 space-y-4">
                            <div class="flex items-start">
                                <div class="h-5 flex items-center w-full">
                                    <select id="collections" name="collections[]" multiple="multiple" class="w-full">
                                
                                    </select>
                                    <script>
                                            $(document).ready(function () {
                                    
                                      
                                                $('#collections').on('change', function (e) {
                                                    
                                                    var data = $('#collections').select2("val");
                                                        @this.set('selectedcollections', data);
                                                    
                                                        
                                                });
                        
                                            });

                                    </script>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                </div>


                <div class="bg-white py-6 px-4 space-y-6 sm:p-6" wire:ignore>
                    <fieldset>
                        <legend class="text-base font-medium text-gray-900">
                            {{ __('Brands') }}
                        </legend>
                        <div class="mt-4 space-y-4">
                            <div class="flex items-start">
                                <div class="h-5 flex items-center w-full">
                                    <select id="brands" name="brands[]" multiple="multiple" class="w-full">
                                
                                    </select>
                                    <script>
                                            $(document).ready(function () {
                                    
                                      
                                                $('#brands').on('change', function (e) {
                                                    
                                                    var data = $('#brands').select2("val");
                                                        @this.set('selectedbrands', data);
                                                    
                                                        
                                                });
                        
                                            });

                                    </script>
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
<script>
  $(function() {
    $('#price').maskMoney();
  })
</script>
@endpush
</div>
