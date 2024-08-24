@extends('layouts.app-view')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">{{ __('Blog Posts') }}</h1>

    @auth
    <div class="mb-6 flex justify-end">
        <a href="{{ route('posts.create') }}" 
           class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 flex items-center"
           aria-label="{{ __('Create New Post') }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path d="M10 5a1 1 0 011 1v8a1 1 0 11-2 0V6a1 1 0 011-1zM15 10a1 1 0 01-1 1H6a1 1 0 010-2h8a1 1 0 011 1z" />
            </svg>
            {{ __('Create New Post') }}
        </a>
    </div>
    @endauth

    <x-search-form action="{{ route('posts.index') }}" />

    <x-alert :message="session('success')" />

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($posts as $post)
            <x-post-card :post="$post" />
        @empty
            <p class="text-gray-500">{{ __('No posts available.') }}</p>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $posts->links() }}
    </div>
</div>
@endsection