<div>
    

<div class="lg:grid lg:grid-cols-12 lg:gap-x-5">
    <!-- LEFT FORM -->
    <div class="space-y-6 sm:px-6 lg:px-0 lg:col-span-8">

                    @csrf
                    @method('POST')

                    <div class="shadow sm:rounded-md sm:overflow-hidden">

                        <div class="bg-white py-6 px-4 space-y-6 sm:p-6">
                            <div>
                                <h3 class="text-lg leading-6 font-medium text-gray-900">
                                    {{ __('Ticket details') }}
                                </h3>
                            </div>
                            <div class="grid grid-cols-3 gap-6">
                                <div class="col-span-12 sm:col-span-3">
                                    @include('layouts.snippets.fields', ['type'=>'text','label'=>'Name','placeholder'=>'Ticket name','name'=>'name','value'=> '','wiremodel'=>'name'])
                                </div>

                                <div class="col-span-12 sm:col-span-3">
                                    @include('layouts.snippets.fields', ['type'=>'text','label'=>'Ticket','placeholder'=>'Ticket','name'=>'validator','value'=> '' ,'wiremodel'=>'validator'])
                                </div>

                                
                                <div class="col-span-12 sm:col-span-3">

                                    <label for="discount_method_id" class="block text-sm font-medium leading-5 text-gray-700 ">{{ __("Method of discount") }}</label>
                                <select name="discount_method_id" id="discount_method_id" class="form-select w-full" wire:model="discount_method_id">
                                        <option value="1">{{ __("Percentage") }}</option>
                                        <option value="2"> {{ __("Fixed Value") }}</option>
                                </select>
                                </div>
                                <div class="col-span-12 sm:col-span-3">
                                    <label for="discount" class="block text-sm font-medium leading-5 text-gray-700 ">{{ __("Ticket") }}
                                        @if($discount_method_id==1)
                                        {{ __("(%)") }}
                                        @else
                                        {{ __("(R$)") }}
                                        @endif
                                    
                                     <span class="red">*</span></label>
                                    <div class="mt-1 rounded-md ">
                                    
                                        <input id="discount" type="number" name="discount"  class="form-input block w-full sm:text-sm sm:leading-5 border currency"  min="0" step="0.01" data-number-to-fixed="2" data-number-stepfactor="100"  required="" placeholder="Discount" wire:model="discount">
                                    </div>
                                    @error('discount')
                                    <p class="mt-2 text-sm text-red-600">
                                        {{ $message }}
                                    </p>
                                    @enderror
                                </div>
                                <div class="col-span-12 sm:col-span-3">
                                    @include('layouts.snippets.fields', ['type'=>'date','label'=>'Due Date','placeholder'=>'Due Date','name'=>'due_date','value'=> '','wiremodel'=>'due_date' ])
                                </div>

                                <div class="col-span-12 sm:col-span-3" wire:ignore>
                            <fieldset>
                                <legend class="text-base font-medium text-gray-900">
                                    {{ __('Collections') }}
                                </legend>
                                <div class="mt-4 space-y-4">
                                    <div class="flex items-start">
                                        <div class="h-5 my-4 flex items-center w-full">
                                         
                                            <select id="collections" name="collections[]" multiple="multiple" class="w-full">
                                                @foreach($collections as $collection)
                                                    <option value="{{$collection->id}}"
                                                     @if($ticket->collections->pluck('id')->contains($collection->id))
                                                            selected
                                                     @endif
                                                     >{{$collection->name}}</option>
                                                @endforeach
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
                                <legend class="text-base font-medium text-gray-900">
                                    {{ __('Products') }}
                                </legend>
                                <div class="mt-4 space-y-4">
                                    <div class="flex items-start">
                                        <div class="h-5 my-4 flex items-center w-full">
                                            <select id="products" name="products[]" multiple="multiple" class="w-full">
                                                @foreach($products as $product)
                                                    <option value="{{$product->id}}"
                                                    @if($ticket->products->pluck('id')->contains($product->id))
                                                            selected
                                                     @endif
                                                    
                                                     >{{$product->name}}</option>
                                                @endforeach
                                            </select>
                                            <script>
                                                    $(document).ready(function () {
                                            
                                            
                                                        $('#products').on('change', function (e) {
                                                            
                                                            var data = $('#products').select2("val");
                                                                @this.set('selectedproducts', data);
                                                            
                                                                
                                                        });
                                
                                                    });

                                             </script>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>

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
                                        <input id="status" name="status" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded"  value="1" wire:model="active"/>
                                    </div>
                                    <div class="ml-3 text-sm">
                                        <label for="status" class="font-medium text-gray-700">{{ __('Active') }}</label>
                                        <p class="text-gray-500">
                                            {{ __('Set this ticket active in your store.') }}
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
                            <a href="{{ route('tenant.customers.index') }}" class="py-1 px-4 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out">
                                {{ __('Cancel') }}
                            </a>
                        </span>
                        <span class="ml-3 inline-flex rounded-md shadow-sm">
                            <button wire:click="update" class="py-1 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 shadow-sm hover:bg-indigo-500 focus:outline-none focus:shadow-outline-blue focus:bg-indigo-500 active:bg-indigo-600 transition duration-150 ease-in-out">
                                {{ __('Save ticket') }}
                            </button>
                        </span>
                    </div>
                </div>

       
    </div>
</div>

</div>
