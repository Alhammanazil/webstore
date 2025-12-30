@props(['title' => 'Title Section', 'url' => '#', 'products' => []])
<!-- Title -->
<div class="max-w-2xl mx-auto text-center mb-10 animate-fade-in-up">
    <h2
        class="text-3xl font-bold md:text-4xl md:leading-tight bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
        {{ $title }}</h2>
    <div class="w-24 h-1 mx-auto mt-4 bg-gradient-to-r from-blue-600 to-purple-600 rounded-full"></div>
</div>
<!-- End Title -->
<!-- Card Blog -->
<div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 mx-auto">
    <!-- Grid -->
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 animate-fade-in-up" style="animation-delay: 0.2s;">
        @forelse ($products as $product)
            <x-single-product-card :product="$product" />
        @empty
            <div class="col-span-full text-center text-gray-500">
                No products available
            </div>
        @endforelse
    </div>
    <div class="flex justify-center w-full mt-10 animate-fade-in-up" style="animation-delay: 0.4s;">
        <a href="{{ $url }}"
            class="group flex items-center px-6 py-3 text-gray-700 font-medium border-2 border-gray-300 rounded-full hover:border-blue-600 hover:text-blue-600 transition-all duration-300 hover:shadow-lg hover:scale-105">
            <span>
                Show More Product
            </span>
            <svg class="size-5 ml-2 group-hover:translate-x-2 transition-transform duration-300"
                xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="m9 18 6-6-6-6" />
            </svg>
        </a>
    </div>
    <!-- End Grid -->
</div>
<!-- End Card Blog -->
