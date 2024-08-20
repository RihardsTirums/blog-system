@extends('layouts.app-view')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">Blog Posts</h1>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($posts as $post)
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-xl font-semibold mb-2">{{ \Illuminate\Support\Str::limit($post->title, 50) }}</h2>
                <p class="text-gray-700">{{ \Illuminate\Support\Str::limit($post->body_content, 100) }}</p>
                <p class="text-sm text-gray-500 mt-2">By {{ $post->user->name }} on {{ $post->created_at->format('F j, Y') }}</p>

                <div class="mt-4 flex justify-between">
                    <a href="{{ route('posts.show', $post) }}" class="text-blue-500 hover:underline">Read More</a>
                    
                    @can('update', $post)
                        <a href="{{ route('posts.edit', $post) }}" class="text-yellow-500 hover:underline">Edit</a>
                    @endcan

                    @can('delete', $post)
                        <form action="{{ route('posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline">Delete</button>
                        </form>
                    @endcan
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
