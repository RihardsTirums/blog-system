<div class="mb-4 flex flex-wrap">
    @foreach($post->categories as $category)
        <span class="bg-yellow-300 text-yellow-800 text-xs font-semibold mr-2 mb-2 px-2.5 py-0.5 rounded">
            {{ $category->name }}
        </span>
    @endforeach
</div>

<h1 class="text-3xl font-bold mb-4 break-words">
    {{ $post->title }}
</h1>

<p class="text-gray-600 mb-6">
    {{ __('By') }} {{ $post->user->name }} {{ __('on') }}
    {{ $post->created_at->format('F j, Y \a\t H:i:s') }}
</p>

@if ($post->created_at != $post->updated_at)
    <p class="text-xs text-yellow-500 mb-6">
        {{ __('Last updated on') }}
        {{ $post->updated_at->format('F j, Y \a\t H:i:s') }}
    </p>
@endif

<p class="text-gray-700 text-lg mb-8 break-words whitespace-pre-wrap">
    {{ $post->body_content }}
</p>

@can('update', $post)
    <div class="flex justify-between items-center">
        <div class="flex space-x-4">
            <a href="{{ route('posts.edit', $post) }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                </svg>
                {{ __('Edit') }}
            </a>
            <form action="{{ route('posts.destroy', $post) }}" method="POST" onsubmit="return confirm('{{ addslashes(__('Are you sure you want to delete this post?')) }}');" class="flex items-center">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                    </svg>
                    {{ __('Delete') }}
                </button>
            </form>
        </div>
    </div>
@endcan