<form action="{{ $action }}" method="GET" class="mb-6">
    <div class="flex items-center">
        <input 
            type="text" 
            name="search" 
            placeholder="Search posts..." 
            value="{{ request('search') }}" 
            class="w-full px-4 py-2 border rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-600"
        >
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-r-md hover:bg-blue-700">
            Search
        </button>
    </div>
</form>
