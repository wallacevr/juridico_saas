@extends('layouts.tenant', ['title' => __("Update variation") . __(" - {$variation->name}")])

@section('content')

<div class="lg:grid lg:grid-cols-12 lg:gap-x-5">
    <!-- LEFT FORM -->
    <div class="space-y-6 sm:px-6 lg:px-0 lg:col-span-12">
        <form id="variationForm" action="{{ route('tenant.variations.update', $variation->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="shadow sm:rounded-md sm:overflow-hidden">
                <div class="bg-white py-6 px-4 space-y-6 sm:p-6">
                    <div class="grid grid-cols-3 gap-6">
                        <div class="col-span-12">
                            @include('layouts.snippets.fields', ['type'=>'text','label'=>'Name','placeholder'=>'Page name','name'=>'name','value'=> $variation->name ])
                        </div>

                        <div class="col-end-12">
                            <span class="rounded-md shadow-sm">
                                <a href="{{ route('tenant.variations.index') }}" class="py-1 px-4 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out">
                                    {{ __('Cancel') }}
                                </a>
                            </span>
                            <span class="ml-3 rounded-md shadow-sm">
                                <button type="submit" class="py-1 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 shadow-sm hover:bg-indigo-500 focus:outline-none focus:shadow-outline-blue focus:bg-indigo-500 active:bg-indigo-600 transition duration-150 ease-in-out">
                                    {{ __('Save variation') }}
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <div class="shadow sm:rounded-md sm:overflow-hidden">
            <div class="bg-white py-6 px-4 space-y-6 sm:p-6">
                <div>
                    <div class="grid grid-cols-6 gap-4">
                        <div class="col-start-1 col-end-3">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">
                                {{ __('Options') }}
                            </h3>
                        </div>
                        <div class="col-end-8 col-span-1">
                            <a id="new-option-button" href="#" class="mr-8 px-5 py-2 items-end text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 active:bg-indigo-700 transition ease-in-out duration-150">
                                {{ __('New option') }}
                            </a>
                        </div>
                    </div>

                    @include('tenant.variations.options-table', $options)
                </div>
            </div>
        </div>
    </div>
</div>

@include('tenant.variations.options-modal', $variation)

@endsection

@push('js')
<script src="{{ URL::to('/') . '/js/variant-option-modal.js' }}"></script>
<script>
    $(document).ready(function() {
        $("#variationForm").validate({
            rules: {
                name: {
                    required: true
                },
            }
        });
    });
</script>
@endpush
