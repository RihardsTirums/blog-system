@extends('layouts.app-view')

@section('content')
<div class="container mx-auto p-6">
    <div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-md">
        <h1 class="text-3xl font-bold mb-4">{{ __('Create New Post') }}</h1>
        <x-post-form 
            :action="route('posts.store')" 
            method="POST"
            :post="null" 
            :categories="$categories" 
            buttonText="{{ __('Create Post') }}"
        />
    </div>
</div>
@endsection