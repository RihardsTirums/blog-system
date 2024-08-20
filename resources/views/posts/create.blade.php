@extends('layouts.app-view')

@section('content')
<div class="container mx-auto p-6">
<div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-md">
    <h1 class="text-3xl font-bold mb-4">Create New Post</h1>

    <form action="{{ route('posts.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="title" class="block text-gray-700">Title</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}" 
                   class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600">
            @error('title')
            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="body" class="block text-gray-700">Body</label>
            <textarea name="body" id="body" rows="6" 
                      class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600">{{ old('body') }}</textarea>
            @error('body')
            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end space-x-4">
            <a href="{{ route('posts.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">
                Cancel
            </a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                Create Post
            </button>
        </div>
    </form>
</div>
</div>
@endsection
