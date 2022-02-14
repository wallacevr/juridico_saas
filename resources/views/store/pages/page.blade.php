@extends('layouts.store', ['title' => $page->page_title])

@section('content')

<div class="max-w-7xl mx-auto ">
<div class=" m-16 p-16 ">
  <div class=" px-4 sm:px-6 lg:px-8">
    <div class="text-lg max-w-prose  p-6">
      <h1>
        <span class="block text-base text-center font-bold  uppercase">{{  $page->title }}</span>
      </h1>
   
    </div>
    <div class="mx-auto">
    {!!  $page->content !!}
    </div>
  </div>
</div>
</div>
@endsection
