<a class="flex flex-col bg-white group rounded-xl border border-gray-200" href="{{ route('product') }}">
    <img class="object-cover rounded-md aspect-square"
        src="{{ $product->cover_url }}"
        alt="{{ $product->name }}" />
    <div class="py-5">
        {{-- {{ dd($product) }} --}}
        <h3 class="text-lg font-bold text-gray-800">
            {{ $product->name }}
        </h3>
        <span class="text-sm text-gray-500">
            {{ $product->short_desc }}
        </span>
        <p class="mt-1 font-semibold text-gray-900">
            {{ $product->price_formatted }}
        </p>
    </div>
</a>
