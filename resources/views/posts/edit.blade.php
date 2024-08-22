@extends('layouts.app-view')

@section('content')
<div class="container mx-auto p-6">
    <div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-md">
        <h1 class="text-3xl font-bold mb-4">Edit Post</h1>
        <x-post-form 
            :action="route('posts.update', $post->id)" 
            method="PATCH" 
            :post="$post" 
            :categories="$categories"
            :buttonText="'Update Post'" 
        />
    </div>
</div>
@endsection
