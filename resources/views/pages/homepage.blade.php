<x-store-layout title="Homepage">
    <div class="container mx-auto max-w-[85rem] w-full">
        <div class="mt-10">
            <x-product-sections title="Feature Product" :products="$featuredProducts" :url="route('product-catalog')" />
            <x-featured-icon />
            <x-product-sections title="Latest Products" :products="$latestProducts" :url="route('product-catalog')" />
        </div>
    </div>
</x-store-layout>
