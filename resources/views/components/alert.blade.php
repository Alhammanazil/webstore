@props([
    'type' => session()->has('success') ? 'success' : (session()->has('error') ? 'error' : 'info'),
    'message' => session('success') ?? (session('error') ?? ''),
])

@if ($message || $errors->any())
    <div {{ $attributes->merge(['class' => "alert alert-{$type}"]) }}>
        @if ($message)
            <p>{{ $message }}</p>
        @endif

        @if ($errors->any())
            <ul class="mt-2 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
    </div>
@endif
