@extends('layouts.tenant', ['title' => 'Clientes'])

@section('content')
    <table id="table-users" class="table-auto border-collapse border-black">
        <thead>
            <tr>
                <td>Cliente</td>
                <td>E-mail</td>
                <td>Ação</td>
            </tr>
        </thead>
        <tbody>
                @foreach($customers as $customer)
                    <tr>
                        <td> {{$customer->name}}  </td>
                        <td> {{$customer->email}} </td>
                        <td> 
                            <a href="/admin/customers/{{$customer->id}}">visualizar</a>
                            <a href="/admin/customers/edit/{{$customer->id}}">editar</a>
                            <a href="/admin/customers/delete/{{$customer->id}}">excluir</a>
                        </td>
                    </tr>
                @endforeach
            
        </tbody>
        
    </table>
    <style>
        #table-users{
            min-width:80%;
        }
        #table-users td, tr {
            border: solid 1px black;
        }
    </style>   
@endsection