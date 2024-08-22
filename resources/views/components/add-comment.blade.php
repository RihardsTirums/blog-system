<div class="mt-8 p-6 bg-gray-100">
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
