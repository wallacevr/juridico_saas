<div>
    <div class="grid grid-cols-12 gap-6">
            <div class="col-span-12  sm:col-span-3">
                @include('layouts.snippets.fields', [
                    'type' => 'text',
                    'label' => 'Search',
                    'placeholder' => 'Search by',
                    'name' => 'search',
                    'value' => '',
                    'require' => true,
                    'wiremodel' =>'search',
                    'wirekeydown'=>'search'
                ])
            </div>
            <div class="col-span-12  sm:col-span-3">
                <label for="collection" class="block text-sm font-medium leading-5 text-gray-700 ">{{__('Collection')}}</label>
                <select class="form-select"  wire:model="collectionid" wire:change="search">
                    <option value="0" 
                    @if( $collectionid ==0)
                            selected
                        @endif
                    >{{__('All Collections')}}</option>
                    @foreach($collections as $collection)
                        <option value="{{$collection->id}}" 
                        @if($collection->id == $collectionid)
                            selected
                        @endif
                        >{{$collection->name}}</option>
                    @endforeach

                </select>
            </div>
    </div>
    <div class="col-1">            
        <input type="checkbox" name="searchindescription"  wire:model="searchindescription" wire:click="search">
        <label for="searchindescription">{{__('Search in Description')}}</label>
    </div>
    <h2 class="mb-6 text-3xl leading-9 title-primary ">{{__('Searching by:')}}{{ $search }}</h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4 gap-4">
    @foreach($products as $key => $product)
    <div class="group mb-6">
        @include('store.product.product', ['product' => $product])
    </div>
    @endforeach
</div>