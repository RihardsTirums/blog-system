@extends('layouts.app-view')

@section('content')
<div class="container mx-auto p-6">
    <div class="max-w-4xl mx-auto bg-white shadow-md rounded-md">
        <div class="p-6">
            <h1 class="text-3xl font-bold mb-4">{{ $post->title }}</h1>
            <p class="text-gray-600 mb-6">By {{ $post->user->name }} | {{ $post->created_at->format('F j, Y \a\t H:i:s') }}</p>

            @if ($post->created_at != $post->updated_at)
            <p class="text-xs text-yellow-500 mb-6">Last updated on {{ $post->updated_at->format('F j, Y \a\t H:i:s') }}</p>
            @endif

            <p class="text-gray-700 text-lg mb-8">{{ $post->body_content }}</p>
        </div>

        @can('update', $post)
        <div class="p-6 flex justify-between items-center">
            <div class="flex space-x-4">
                <a href="{{ route('posts.edit', $post) }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                    </svg>
                    Edit
                </a>
                <form action="{{ route('posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?');" class="flex items-center">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5 mr-2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                        </svg>
                        Delete
                    </button>
                </form>
            </div>
        </div>
        @endcan

        <!-- Comments Section -->
        <div class="mt-8 p-6 bg-gray-50 rounded-md">
            <h2 class="text-2xl font-semibold mb-4">Comments ({{ $post->comments->count() }})</h2>

            @forelse ($post->comments->sortByDesc('created_at') as $comment)
            <div class="mb-4 p-4 bg-white rounded-md shadow-sm">
                <p class="text-gray-700">{{ $comment->body_content }}</p>
                <div class="flex justify-between items-center mt-4">
                    <div class="flex items-center text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5 mr-2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                        <span class="italic">{{ $comment->user->name }}</span>
                        <span class="ml-1">on {{ $comment->created_at->format('F j, Y \a\t H:i:s') }}</span>
                    </div>
                    @can('delete', $comment)
                    <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this comment?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-800">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                            </svg>
                        </button>
                    </form>
                    @endcan
                </div>
            </div>
            @empty
            <p class="text-gray-500">No comments yet.</p>
            @endforelse
        </div>

        @auth
        <div class="mt-8 p-6 bg-gray-100 rounded-md">
            <h2 class="text-2xl font-semibold mb-4">Add a Comment</h2>
            <form action="{{ route('comments.store', $post) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <textarea name="body_content" rows="4" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600" placeholder="Write your comment here..."></textarea>
                    @error('body_content')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5 mr-2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        Submit Comment
                    </button>
                </div>
            </form>
        </div>
        @endauth

    </div>
</div>
@endsection