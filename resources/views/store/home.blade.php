@extends('layouts.store', ['title' => 'Home'])

@section('content')

@includeWhen(isset($pageBanners),'store.banners.full-banners', $pageBanners)

@endsection
