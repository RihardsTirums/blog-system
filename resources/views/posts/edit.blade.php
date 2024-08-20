@extends('layouts.app-view')

@section('content')
<div class="container mx-auto p-6">
<form action="{{ route('posts.update', $post->id) }}" method="POST">
    @csrf
    @method('PATCH')

    <div class="mb-4">
        <label for="title" class="block text-gray-700">Title</label>
        <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}" 
               class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600">
        @error('title')
        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="body" class="block text-gray-700">Body</label>
        <textarea name="body" id="body" rows="6" 
                  class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600">{{ old('body', $post->body_content) }}</textarea>
        @error('body')
        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex justify-end space-x-4">
        <a href="{{ route('posts.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">
            Cancel
        </a>
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
            Update Post
        </button>
    </div>
</form>
</div>
@endsection
