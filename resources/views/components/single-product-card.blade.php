<a class="flex flex-col bg-white group rounded-xl border border-gray-200 overflow-hidden hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 ease-in-out"
    href="{{ route('product', $product->slug) }}">
    <div class="overflow-hidden">
        <img class="object-cover rounded-t-xl aspect-square group-hover:scale-110 transition-transform duration-500 ease-in-out"
            src="{{ $product->cover_url }}" alt="{{ $product->name }}" />
    </div>
    <div class="p-5">
        <h3 class="text-lg font-bold text-gray-800 group-hover:text-blue-600 transition-colors duration-300">
            {{ $product->name }}
        </h3>
        <span class="text-sm text-gray-500">
            {{ $product->short_desc }}
        </span>
        <p class="mt-2 text-xl font-semibold text-gray-900">
            {{ $product->price_formatted }}
        </p>
    </div>
</a>
