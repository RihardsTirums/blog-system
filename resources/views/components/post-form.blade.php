<form action="{{ $action }}" method="POST">
    @csrf
    @if($method !== 'POST')
        @method($method)
    @endif

    <div class="mb-4">
        <label for="title" class="block text-gray-700">{{ __('Title') }}</label>
        <input 
            type="text" 
            name="title" 
            id="title" 
            value="{{ old('title', $post->title ?? '') }}" 
            class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600"
            aria-label="{{ __('Post Title') }}"
        >
        @error('title')
        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="body" class="block text-gray-700">{{ __('Body') }}</label>
        <textarea 
            name="body_content" 
            id="body" 
            rows="6" 
            class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600"
            aria-label="{{ __('Post Body') }}"
        >{{ old('body_content', $post->body_content ?? '') }}</textarea>
        @error('body_content')
        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4" x-data="{ open: false, selected: @json(old('categories', $post?->categories->pluck('id')->toArray() ?? [])) }">
        <label for="categories" class="block text-gray-700">{{ __('Categories') }}</label>
        <div class="relative">
            <button 
                @click="open = !open" 
                type="button" 
                class="w-full px-4 py-2 border rounded-md bg-white focus:outline-none focus:ring-2 focus:ring-blue-600"
                aria-expanded="false"
                aria-controls="category-list"
            >
                {{ __('Select Categories') }}
            </button>
            <div 
                x-show="open" 
                @click.away="open = false" 
                class="absolute z-10 w-full mt-1 bg-white border border-gray-300 rounded-md shadow-lg"
                id="category-list"
                x-transition:enter="transition ease-out duration-200" 
                x-transition:enter-start="opacity-0" 
                x-transition:enter-end="opacity-100" 
                x-transition:leave="transition ease-in duration-200" 
                x-transition:leave-start="opacity-100" 
                x-transition:leave-end="opacity-0"
            >
                <ul class="max-h-60 overflow-y-auto" aria-label="{{ __('Category List') }}">
                    @foreach($categories as $category)
                    <li class="px-4 py-2 hover:bg-gray-100">
                        <label class="flex items-center space-x-2">
                            <input 
                                type="checkbox" 
                                name="categories[]" 
                                value="{{ $category->id }}"
                                x-model="selected"
                                :checked="selected.includes({{ $category->id }})"
                                class="form-checkbox h-4 w-4 text-blue-600 transition duration-150 ease-in-out"
                                aria-label="{{ $category->name }}"
                            >
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

    <div class="flex justify-end space-x-4">
        <a href="{{ route('posts.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">
            {{ __('Cancel') }}
        </a>
        <button 
            type="submit" 
            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700"
            aria-label="{{ __('Submit Post Form') }}"
        >
            {{ $buttonText }}
        </button>
    </div>
</form>