@extends('layouts.tenant', ['title' => __('Logos configuration')])
@push('head')
@livewireStyles
@endpush

@section('content')
    @livewire('tenant.logo.set-logo') 
       
@endsection
@push('body')
@livewireScripts
@endpush
@push('js')
   @endpush
