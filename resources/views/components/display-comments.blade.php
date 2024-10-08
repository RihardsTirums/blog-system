<div class="p-6 bg-gray-100">
    <h2 class="text-2xl font-semibold mb-4">{{ __('Comments') }} ({{ $post->comments->count() }})</h2>
    @forelse ($post->comments->sortByDesc('created_at') as $comment)
        <div class="mb-4 p-4 bg-white rounded-md shadow-sm">
            <p class="text-gray-700 break-words whitespace-pre-wrap">{{ $comment->body_content }}</p>
            <div class="mt-4">
                <div class="text-gray-500">
                    <div class="flex items-center flex-wrap sm:flex-nowrap">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                            <span class="italic">{{ $comment->user->name }}</span>
                        </div>
                        <div class="ml-1 flex flex-wrap sm:flex-nowrap">
                            <span class="block sm:inline">{{ __('on') }}</span>&nbsp;
                            <span class="block sm:inline">{{ $comment->created_at->format('F j, Y') }}</span>&nbsp;
                            <span class="block sm:inline">{{ __('at') }}</span>&nbsp;
                            <span class="block sm:inline">{{ $comment->created_at->format('H:i:s') }}</span>
                        </div>
                    </div>
                </div>
                @can('delete', $comment)
                    <div class="flex justify-end mt-2">
                        <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" onsubmit="return confirm('{{ addslashes(__('Are you sure you want to delete this comment?')) }}');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                            </button>
                        </form>
                    </div>
                @endcan
            </div>
        </div>
    @empty
        <p class="text-gray-500">{{ __('No comments yet.') }}</p>
    @endforelse
</div>