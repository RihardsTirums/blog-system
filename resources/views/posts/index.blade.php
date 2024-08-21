@extends('layouts.app-view')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">Blog Posts</h1>

    @if(session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
        <p>{{ session('success') }}</p>
    </div>
    @endif

    @auth
    <div class="mb-6 flex justify-end">
        <a href="{{ route('posts.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path d="M10 5a1 1 0 011 1v8a1 1 0 11-2 0V6a1 1 0 011-1zM15 10a1 1 0 01-1 1H6a1 1 0 010-2h8a1 1 0 011 1z" />
            </svg>
            Create New Post
        </a>
    </div>
    @endauth

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($posts as $post)
        <div class="relative bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-xl font-semibold mb-2 pr-10">{{ \Illuminate\Support\Str::limit($post->title, 50) }}</h2>
            <p class="text-gray-700">{{ \Illuminate\Support\Str::limit($post->body_content, 100) }}</p>
            <p class="text-sm text-gray-500 mt-2">By {{ $post->user->name }} on {{ $post->created_at->format('F j, Y') }} at {{ $post->created_at->format('H:i:s') }}</p>

            @if ($post->created_at != $post->updated_at)
            <p class="text-xs text-yellow-500 mt-1">Last updated on {{ $post->updated_at->format('F j, Y') }} at {{ $post->updated_at->format('H:i:s') }}</p>
            @endif

            <div class="absolute top-4 right-4 flex items-center text-gray-500">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5 mr-1">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 0 1-2.555-.337A5.972 5.972 0 0 1 5.41 20.97a5.969 5.969 0 0 1-.474-.065 4.48 4.48 0 0 0 .978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25Z" />
                </svg>
                <span>{{ $post->comments->count() }}</span>
            </div>

            <div class="mt-4 flex justify-between items-center">
                <a href="{{ route('posts.show', $post) }}" class="text-blue-500 hover:underline">Read More</a>

                <div class="flex space-x-2">
                    @can('update', $post)
                    <a href="{{ route('posts.edit', $post) }}" class="text-yellow-500 hover:underline flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5 mr-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                        </svg>
                        Edit
                    </a>
                    @endcan

                    @can('delete', $post)
                    <form action="{{ route('posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Are you sure?');" class="flex items-center">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:underline flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5 mr-1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                            </svg>
                            Delete
                        </button>
                    </form>
                    @endcan
                </div>
            </div>
        </div>
        @empty
        <p>No posts available.</p>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $posts->links() }}
    </div>
</div>
@endsection