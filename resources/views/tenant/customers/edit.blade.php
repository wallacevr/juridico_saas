@extends('layouts.tenant', ['title' => 'Cliente'])

@section('content')
<form method="post" action='/admin/customers/update/{{$customer->id}}'>
@csrf
        <div class="px-4 py-5 bg-white sm:p-6">
        <div>
            <label for="name" class="block text-sm font-medium leading-5 text-gray-700">Nome
            </label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <input id="name" autocomplete="off" name="name" value="{{$customer->name}}" class="form-input block w-full sm:text-sm sm:leading-5" placeholder="">
            </div>
        </div>
    </div>


    <div class="px-4 py-5 bg-white sm:p-6">
        <div>
            <label for="email" class="block text-sm font-medium leading-5 text-gray-700">E-mail
            </label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <input id="email" autocomplete="off" name="email" value="{{$customer->email}}" class="form-input block w-full sm:text-sm sm:leading-5" placeholder="">
            </div>
        </div>
    </div>

    <div class="px-4 py-5 bg-white sm:p-6">
        <div>
            <label for="Senha" class="block text-sm font-medium leading-5 text-gray-700">Senha
            </label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <input id="password" autocomplete="off" name="password" value="" class="form-input block w-full sm:text-sm sm:leading-5" placeholder="">
            </div>
        </div>
    </div>

    <div class="flex flex-row flex-wrap mb-4 ">
    <div class="mt-4 md:mt-0 w-full pl-0">
        <div class="shadow bg-gray-50">
            <div class="px-4 py-5  sm:p-6">
                <div class="px-4 sm:px-6 py-2  flex justify-end">
                    <button class="py-1 px-4 border  text-sm font-medium rounded-md text-white bg-indigo-600 shadow-sm hover:bg-indigo-500 focus:outline-none focus:shadow-outline-blue focus:bg-indigo-500 active:bg-indigo-600 transition duration-150 ease-in-out">
                        Salvar
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>

    </form>


@endsection