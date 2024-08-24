@extends('layouts.app-view')

@section('content')
<div class="container mx-auto p-6">
    <div class="max-w-4xl mx-auto bg-white shadow-md rounded-md">
        <div class="p-6">
            <x-alert :message="session('success')" />
            
            <x-single-post :post="$post" />

            @auth
            <x-add-comment :post="$post" />
            @endauth

            <x-display-comments :post="$post" />
        </div>
    </div>
</div>
@endsection