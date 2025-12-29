<div>
    <div class="container mx-auto max-w-[85rem] w-full px-4 sm:px-6 lg:px-8 py-10">
        <div class="grid grid-cols-1 gap-10 md:grid-cols-10">
            <div class="grid grid-cols-1 gap-10 pr-6 border-r border-gray-200 md:col-span-3">
                <div>
                    <div class="space-y-3">
                        <input type="text" placeholder="Search" wire:model="search"
                            class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none">
                    </div>
                    <span class="block mt-5 mb-2 text-lg font-semibold text-gray-800">
                        Collections
                    </span>
                    <div class="block space-y-4">
                        @forelse ($collections as $collection)
                            <div class="flex items-center justify-between">
                                <div class="flex">
                                    <input type="checkbox" wire:model="select_collections" value="{{ $collection->id }}"
                                        class="shrink-0 mt-0.5 border-gray-200 rounded-sm text-blue-600 focus:ring-blue-500 checked:border-blue-500 disabled:opacity-50 disabled:pointer-events-none"
                                        id="collection-{{ $collection->id }}">
                                    <label for="collection-{{ $collection->id }}" class="text-sm font-light ms-3">
                                        {{ $collection->name }}
                                    </label>
                                </div>
                                <span class="text-xs text-gray-800 font-light">({{ $collection->product_count }})</span>
                            </div>
                        @empty
                            <p class="text-sm text-gray-500">No collections available</p>
                        @endforelse
                    </div>
                    <div class="grid grid-cols-2 mt-10">
                        <button type="button" wire:click="applyFilters"
                            class="inline-flex items-center justify-center px-4 py-3 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-lg cursor-pointer gap-x-2 hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                            Apply Filter
                        </button>
                        <button type="button" wire:click="resetFilters"
                            class="inline-flex items-center justify-center text-sm font-semibold text-blue-600 rounded-lg cursor-pointer gap-x-2 hover:text-blue-800 focus:outline-hidden focus:text-blue-800 disabled:opacity-50 disabled:pointer-events-none">
                            Reset
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-span-1 md:col-span-7">
                <div class="flex items-center justify-between gap-5">
                    <div class="font-light text-gray-800">Results: {{ $products->total() }}</div>
                    <div class="flex items-center gap-2">
                        <span class="text-sm font-light text-gray-800">
                            Sort By :
                        </span>
                        <select wire:model="sort_by"
                            class="px-3 py-2 text-sm border-gray-200 rounded-lg pe-9 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none">
                            <option selected="">Open this select menu</option>
                            <option value="newest">Product Newest</option>
                            <option value="latest">Product Latest</option>
                            <option value="price_asc">Product Price A-Z</option>
                            <option value="price_desc">Product Price Z-A</option>
                        </select>
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
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>
