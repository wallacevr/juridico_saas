@extends('layouts.tenant', ['title' => 'Blog'])

@section('content')

<div class="">
  <div class="max-w-7xl mx-auto">
    <a href="{{ route('tenant.posts.create') }}" class="px-5 py-2 text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 active:bg-indigo-700 transition ease-in-out duration-150">
      New post
    </a>
    <div class="">
      @foreach($posts as $post)
      <a href="{{ route('tenant.posts.show', $post) }}">
        <div class="block mt-8 rounded-lg shadow overflow-hidden">
          <div class="bg-white p-6">
              <h3 class="text-xl font-semibold text-gray-900">
                  {{ $post->title }} 
                </h3>
                <p class="mt-3 text-base text-gray-500">
                  {{ $post->body }}
                </p>
            <div class="mt-6 flex items-center">
              <div class="">
                <a href="#">
                  <img class="h-10 w-10 rounded-full" src="{{ $post->author->gravatar_url }}" alt="{{ $post->author->name }}" />
                </a>
              </div>
              <div class="ml-3">
                <p class="text-sm font-medium text-gray-900">
                  <a href="#" class="">
                    {{ $post->author->name }}
                  </a>
                </p>
                <div class="flex text-sm text-gray-500">
                  <time datetime="{{ $post->created_at->format('Y-m-d') }}">
                    {{ $post->created_at->format('M d, Y') }}
                  </time>
                  <span class="mx-1">
                    &middot;
                  </span>
                  <span>
                    {{ count(explode(' ', $post->body)) }} words
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </a>
      @endforeach
    </div>
  </div>
</div>

@endsection