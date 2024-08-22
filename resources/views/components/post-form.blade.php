@props(['action', 'method' => 'POST', 'post' => null, 'categories' => [], 'buttonText' => 'Submit'])

<form action="{{ $action }}" method="POST">
    @csrf
    @if($method !== 'POST')
        @method($method)
    @endif

    <div class="mb-4">
        <label for="title" class="block text-gray-700">Title</label>
        <input type="text" name="title" id="title" value="{{ old('title', $post->title ?? '') }}" 
               class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600">
        @error('title')
        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="body" class="block text-gray-700">Body</label>
        <textarea name="body_content" id="body" rows="6" 
                  class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600">{{ old('body_content', $post->body_content ?? '') }}</textarea>
        @error('body_content')
        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
        @enderror
    </div>

    <!-- Category Dropdown -->
    <div class="mb-4" x-data="{ open: false, selected: @json(old('categories', $post?->categories->pluck('id')->toArray() ?? [])) }">
        <label for="categories" class="block text-gray-700">Categories</label>
        <div class="relative">
            <button @click="open = !open" type="button" class="w-full px-4 py-2 border rounded-md bg-white text-left focus:outline-none focus:ring-2 focus:ring-blue-600 flex justify-between items-center">
                <span>Select Categories</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform transition-transform duration-200" :class="{ 'rotate-180': open }" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06 0L10 10.43l3.71-3.22a.75.75 0 111.06 1.06l-4 3.5a.75.75 0 01-1.06 0l-4-3.5a.75.75 0 010-1.06z" clip-rule="evenodd" />
                </svg>
            </button>
            <div x-show="open" @click.away="open = false" class="absolute z-10 w-full mt-1 bg-white border border-gray-300 rounded-md shadow-lg transition-opacity duration-200" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                <ul class="max-h-60 overflow-y-auto py-1">
                    @foreach($categories as $category)
                    <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer">
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                                x-model="selected"
                                :checked="selected.includes({{ $category->id }})"
                                class="form-checkbox h-4 w-4 text-blue-600 transition duration-150 ease-in-out">
                            <span>{{ $category->name }}</span>
                        </label>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        @error('categories')
        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
        @enderror
    </div>

    <!-- Submit button -->
    <div class="flex justify-end space-x-4">
        <a href="{{ route('posts.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">
            Cancel
        </a>
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
            {{ $buttonText }}
        </button>
    </div>
</form>
