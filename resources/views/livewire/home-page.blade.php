<div>
    <!-- Hero Section -->
    <section class="relative overflow-hidden bg-gradient-to-br from-blue-600 via-purple-600 to-pink-600">
        <div class="absolute inset-0 bg-black opacity-10"></div>
        <div class="container mx-auto max-w-[85rem] w-full px-4 sm:px-6 lg:px-8">
            <div class="relative grid gap-8 py-20 lg:py-32 lg:grid-cols-2 lg:gap-16 items-center">
                <!-- Left Content -->
                <div class="text-white animate-fade-in-left">
                    <h1 class="text-4xl font-extrabold tracking-tight sm:text-5xl lg:text-6xl mb-6">
                        Discover Amazing
                        <span class="block text-yellow-300">Learning Products</span>
                    </h1>
                    <p class="text-lg sm:text-xl mb-8 text-gray-100">
                        Elevate your skills with our curated collection of premium courses and e-books. Start your
                        learning journey today!
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('product-catalog') }}"
                            class="inline-flex items-center px-8 py-4 text-base font-semibold text-blue-600 bg-white rounded-full hover:bg-gray-100 hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl">
                            Shop Now
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </a>
                        <a href="#featured"
                            class="inline-flex items-center px-8 py-4 text-base font-semibold text-white border-2 border-white rounded-full hover:bg-white hover:text-blue-600 transition-all duration-300 hover:scale-105">
                            Learn More
                        </a>
                    </div>

                    <!-- Stats -->
                    <div class="grid grid-cols-3 gap-6 mt-12">
                        <div class="text-center">
                            <div class="text-3xl font-bold text-yellow-300">100+</div>
                            <div class="text-sm text-gray-200">Products</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-yellow-300">5K+</div>
                            <div class="text-sm text-gray-200">Happy Students</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-yellow-300">4.8</div>
                            <div class="text-sm text-gray-200">Rating</div>
                        </div>
                    </div>
                </div>

                <!-- Right Content - Floating Images -->
                <div class="relative hidden lg:block animate-fade-in-right">
                    <div class="relative w-full h-96">
                        @if ($feature_products && $feature_products->count() >= 2)
                            <!-- Floating Card 1 -->
                            <div class="absolute top-0 right-0 w-64 h-80 animate-float" style="animation-delay: 0s;">
                                <div class="w-full h-full bg-white rounded-2xl shadow-2xl transform rotate-6 hover:rotate-0 transition-transform duration-500 overflow-hidden group cursor-pointer"
                                    onclick="window.location.href='{{ route('product', $feature_products[0]->slug) }}'">
                                    <div class="h-3/4 overflow-hidden">
                                        <img src="{{ $feature_products[0]->cover_url }}"
                                            alt="{{ $feature_products[0]->name }}"
                                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" />
                                    </div>
                                    <div class="p-3 h-1/4">
                                        <h4 class="text-sm font-bold text-gray-800 line-clamp-1">
                                            {{ $feature_products[0]->name }}</h4>
                                        <p class="text-xs text-blue-600 font-semibold">
                                            {{ $feature_products[0]->price_formatted }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Floating Card 2 -->
                            <div class="absolute top-20 left-0 w-64 h-80 animate-float" style="animation-delay: 0.5s;">
                                <div class="w-full h-full bg-white rounded-2xl shadow-2xl transform -rotate-6 hover:rotate-0 transition-transform duration-500 overflow-hidden group cursor-pointer"
                                    onclick="window.location.href='{{ route('product', $feature_products[1]->slug) }}'">
                                    <div class="h-3/4 overflow-hidden">
                                        <img src="{{ $feature_products[1]->cover_url }}"
                                            alt="{{ $feature_products[1]->name }}"
                                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" />
                                    </div>
                                    <div class="p-3 h-1/4">
                                        <h4 class="text-sm font-bold text-gray-800 line-clamp-1">
                                            {{ $feature_products[1]->name }}</h4>
                                        <p class="text-xs text-blue-600 font-semibold">
                                            {{ $feature_products[1]->price_formatted }}</p>
                                    </div>
                                </div>
                            </div>

                            @if ($feature_products->count() >= 3)
                                <!-- Floating Card 3 (Optional) -->
                                <div class="absolute top-40 right-20 w-56 h-72 animate-float hidden md:block"
                                    style="animation-delay: 1s;">
                                    <div class="w-full h-full bg-white rounded-2xl shadow-xl transform rotate-3 hover:rotate-0 transition-transform duration-500 overflow-hidden group cursor-pointer"
                                        onclick="window.location.href='{{ route('product', $feature_products[2]->slug) }}'">
                                        <div class="h-3/4 overflow-hidden">
                                            <img src="{{ $feature_products[2]->cover_url }}"
                                                alt="{{ $feature_products[2]->name }}"
                                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" />
                                        </div>
                                        <div class="p-3 h-1/4">
                                            <h4 class="text-sm font-bold text-gray-800 line-clamp-1">
                                                {{ $feature_products[2]->name }}</h4>
                                            <p class="text-xs text-blue-600 font-semibold">
                                                {{ $feature_products[2]->price_formatted }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @else
                            <!-- Fallback mockup cards jika products kosong -->
                            <!-- Floating Card 1 -->
                            <div class="absolute top-0 right-0 w-64 h-80 animate-float" style="animation-delay: 0s;">
                                <div
                                    class="w-full h-full bg-white rounded-2xl shadow-2xl transform rotate-6 hover:rotate-0 transition-transform duration-500 overflow-hidden">
                                    <div class="h-3/4 bg-gradient-to-br from-red-400 to-pink-500"></div>
                                    <div class="p-4">
                                        <div class="h-3 bg-gray-200 rounded mb-2"></div>
                                        <div class="h-3 bg-gray-200 rounded w-2/3"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Floating Card 2 -->
                            <div class="absolute top-20 left-0 w-64 h-80 animate-float" style="animation-delay: 0.5s;">
                                <div
                                    class="w-full h-full bg-white rounded-2xl shadow-2xl transform -rotate-6 hover:rotate-0 transition-transform duration-500 overflow-hidden">
                                    <div class="h-3/4 bg-gradient-to-br from-blue-400 to-indigo-600"></div>
                                    <div class="p-4">
                                        <div class="h-3 bg-gray-200 rounded mb-2"></div>
                                        <div class="h-3 bg-gray-200 rounded w-2/3"></div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Wave Shape -->
        <div class="absolute bottom-0 left-0 w-full">
            <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M0 120L60 105C120 90 240 60 360 45C480 30 600 30 720 37.5C840 45 960 60 1080 67.5C1200 75 1320 75 1380 75L1440 75V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0Z"
                    fill="white" />
            </svg>
        </div>
    </section>

    <!-- Main Content -->
    <div class="container mx-auto max-w-[85rem] w-full">
        <div class="mt-10" id="featured">
            <x-product-sections title="Featured Products" :products="$feature_products" :url="route('product-catalog')" />
            <x-featured-icon />
            <x-product-sections title="Latest Products" :products="$latest_products" :url="route('product-catalog')" />
        </div>
    </div>
</div>
