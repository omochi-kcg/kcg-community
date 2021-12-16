@php
if (session('status') === 'success') {
    $bgColor = 'bg-green-200 border-green-600 text-green-600';
} elseif (session('status') === 'alert') {
    $bgColor = 'bg-red-200 border-red-600 text-red-600';
}
@endphp

@if (session('message'))
    <div class="{{ $bgColor }} border-l-4 p-4" role="alert">
        <p>
            {{ session('message') }}
        </p>
    </div>
@endif
