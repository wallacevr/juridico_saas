@extends('layouts.tenant', ['title' => 'Grupos'])
 
@section('content')

<div class="space-y-6 sm:px-6 lg:px-0 lg:col-span-8">
        <form action="{{ route('tenant.groups.update', $group->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
            <div class="shadow sm:rounded-md sm:overflow-hidden">
                <div class="bg-white py-6 px-4 space-y-6 sm:p-6">
                    <div class="grid grid-cols-3 gap-6">
                        <div class="col-span-12 sm:col-span-3">
                            <label for="name" class="block text-sm font-medium text-gray-700">Nome</label>
                            <input type="text" name="name" id="name" autocomplete="name" value="{{$group->name}}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Brand name">
                                                    </div>

                        <div class="col-span-3">
                            <label for="description" class="block text-sm font-medium text-gray-700">
                                Descrição
                            </label>
                            <div class="mt-1">
                                <textarea id="description" name="description" rows="5" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm "></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            
                <div class="px-4 sm:px-6 py-2 bg-gray-50 flex justify-end">
                    <button class="py-1 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 shadow-sm hover:bg-indigo-500 focus:outline-none focus:shadow-outline-blue focus:bg-indigo-500 active:bg-indigo-600 transition duration-150 ease-in-out">
                    Salvar
                    </button>
                </div>
            
            </div>
           
            
            
    </form></div>

@endsection
