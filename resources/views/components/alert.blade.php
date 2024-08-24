@if ($message)
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert" aria-label="{{ __('Success Message') }}">
        <p>{{ $message }}</p>
    </div>
@endif