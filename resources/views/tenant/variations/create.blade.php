@extends('layouts.tenant', ['title' => __('Create variation')])

@section('content')

<div class="lg:grid lg:grid-cols-12 lg:gap-x-5">
    <div class="space-y-6 sm:px-6 lg:px-0 lg:col-span-12">
        <form id="variationForm" action="{{ route('tenant.variations.store') }}" method="POST">
            @csrf
            <div class="shadow sm:rounded-md sm:overflow-hidden">
                <div class="bg-white py-6 px-4 space-y-6 sm:p-6">
                    <div class="grid grid-cols-3 gap-6">
                        <div class="col-span-12">
                            @include('layouts.snippets.fields', ['type'=>'text','label'=>'Name','placeholder'=>'Variation name','name'=>'name','value'=> '' ])
                        </div>

                        <div class="col-span-12">
                            <label for="type" class="block text-sm font-medium text-gray-700">
                                {{ __('Type') }}
                            </label>
                            <select name="type" class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option selected value="none" {{ old('type')==='none' ? 'selected' : '' }}>
                                    {{ __('None') }}
                                </option>
                                <option value="color" {{ old('type')==='color' ? 'selected' : '' }}>
                                    {{ __('Color') }}
                                </option>
                            </select>
                            @error('type')
                            <p class="mt-2 text-sm text-red-500">
                                {{ $message }}
                            </p>
                            @enderror
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
    </div>
</div>

@endsection

@push('js')
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
