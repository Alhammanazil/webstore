<div>
    <div class="container mx-auto max-w-[85rem] w-full px-4 sm:px-6 lg:px-8 py-10">
        <div class="grid grid-cols-1 gap-10 md:grid-cols-10">
            <div class="grid grid-cols-1 gap-10 pr-6 border-r border-gray-200 md:col-span-3">
                <div>
                    <div class="space-y-3">
                        <label for="search-input" class="block text-sm font-medium text-gray-700 sr-only">Search
                            products</label>
                        <input id="search-input" type="text" placeholder="Search" wire:model.blur="search"
                            class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none"
                            aria-label="Search products by name">
                        @error('search')
                            <p class="mt-2 text-sm text-red-600" role="alert">{{ $message }}</p>
                        @enderror
                    </div>
                    <fieldset class="mt-5">
                        <legend class="block mb-2 text-lg font-semibold text-gray-800">Collections</legend>
                        @error('select_collections')
                            <p class="mt-2 text-sm text-red-600" role="alert">{{ $message }}</p>
                        @enderror
                        <div class="block space-y-4 mt-3">
                            @forelse ($collections as $collection)
                                <div class="flex items-center justify-between">
                                    <div class="flex">
                                        <input type="checkbox" wire:model.debounce-500ms="select_collections"
                                            value="{{ $collection->id }}"
                                            class="shrink-0 mt-0.5 border-gray-200 rounded-sm text-blue-600 focus:ring-blue-500 checked:border-blue-500 disabled:opacity-50 disabled:pointer-events-none"
                                            id="collection-{{ $collection->id }}"
                                            aria-label="Filter by {{ $collection->name }}">
                                        <label for="collection-{{ $collection->id }}" class="text-sm font-light ms-3">
                                            {{ $collection->name }}
                                        </label>
                                    </div>
                                    <span
                                        class="text-xs text-gray-800 font-light">({{ $collection->product_count }})</span>
                                </div>
                            @empty
                                <p class="text-sm text-gray-500">No collections available</p>
                            @endforelse
                        </div>
                    </fieldset>
                    <div class="grid grid-cols-2 mt-10 gap-2">
                        <button type="button" wire:click="applyFilters" wire:loading.attr="disabled"
                            wire:target="applyFilters"
                            class="inline-flex items-center justify-center px-4 py-3 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-lg cursor-pointer gap-x-2 hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                            <span wire:loading.remove wire:target="applyFilters">Apply Filter</span>
                            <div wire:loading wire:target="applyFilters"
                                class="animate-spin inline-block size-4 border-3 border-current border-t-transparent text-white-600 rounded-full dark:text-white-500"
                                role="status" aria-label="loading">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </button>
                        <button type="button" wire:click="resetFilters" wire:loading.attr="disabled"
                            wire:target="resetFilters"
                            class="inline-flex items-center justify-center text-sm font-semibold text-blue-600 rounded-lg cursor-pointer gap-x-2 hover:text-blue-800 focus:outline-hidden focus:text-blue-800 disabled:opacity-50 disabled:pointer-events-none">
                            <span wire:loading.remove wire:target="resetFilters">Reset</span>
                            <div wire:loading wire:target="resetFilters"
                                class="animate-spin inline-block size-4 border-3 border-current border-t-transparent text-blue-600 rounded-full"
                                role="status" aria-label="loading">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-span-1 md:col-span-7">
                <div class="flex items-center justify-between gap-5">
                    <div class="font-light text-gray-800">Results:
                        {{ is_array($products) ? count($products) : $products?->total() ?? 0 }}</div>
                    <div class="flex items-center gap-2" role="group" aria-label="Product sorting options">
                        <label for="sort-select" class="text-sm font-light text-gray-800">
                            Sort By :
                        </label>
                        <div class="space-y-1">
                            <select id="sort-select" wire:model.live.debounce-300ms="sort_by"
                                class="px-3 py-2 text-sm border-gray-200 rounded-lg pe-9 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none"
                                aria-label="Sort products by">
                                <option value="latest">Latest</option>
                                <option value="oldest">Oldest</option>
                                <option value="price_low_high">Price: Low to High</option>
                                <option value="price_high_low">Price: High to Low</option>
                            </select>
                            @error('sort_by')
                                <p class="text-sm text-red-600" role="alert">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-5 my-5 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3">
                    @forelse ($products as $product)
                        <x-single-product-card :product="$product" />
                    @empty
                        <div class="col-span-full">
                            No products found
                        </div>
                    @endforelse
                </div>
                @if (is_object($products) && method_exists($products, 'links'))
                    {{ $products->links() }}
                @endif
            </div>
        </div>
    </div>
</div>
