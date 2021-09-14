@extends('layouts.store', ['title' => $collection->page_title])

@section('content')

{{ 'Nome da coleção: ' . $collection->name }}

@endsection
