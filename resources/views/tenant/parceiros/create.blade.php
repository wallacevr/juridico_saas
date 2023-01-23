@push('head')
    <link rel="stylesheet" href="{{ URL::to('/') . '/css/jquery.fileuploader.min.css' }}">
    <link rel="stylesheet" href="{{ URL::to('/') . '/font/font-fileuploader.css' }}">
    <link rel="stylesheet" href="{{ URL::to('/') . '/css/jquery.fileuploader-theme-gallery.css' }}">
    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
@endpush

@extends('layouts.tenant', ['title' => __('Create Parceiro')])

@section('wrapper')

@livewire('tenant.parceiros.create-parceiro')
@endsection

@push('js')
    <script src="{{ URL::to('/') . '/js/jquery.fileuploader.min.js' }}"></script>
    <script src="{{ URL::to('/') . '/js/string-slugger.js' }}"></script>
   
@endpush
