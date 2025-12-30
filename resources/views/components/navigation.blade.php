<!-- ========== HEADER ========== -->
<header class="z-50 w-full bg-white border-b border-gray-200 shadow-md sticky top-0">
    <nav
        class="relative max-w-[85rem] w-full mx-auto px-4 sm:px-6 lg:px-8 py-4 md:flex md:items-center md:justify-between">
        <!-- Logo w/ Collapse Button -->
        <div class="flex items-center justify-between">
            <a class="flex items-center gap-2 text-2xl font-extrabold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent hover:opacity-80 transition-opacity focus:outline-hidden"
                href="{{ url('/') }}" aria-label="Brand">
                <div class="p-2 bg-gradient-to-br from-blue-600 to-purple-600 rounded-lg">
                    <svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6.253v13m0-13C6.5 6.253 2 10.753 2 16.253s4.5 10 10 10 10-4.5 10-10-4.5-10-10-10z" />
                    </svg>
                </div>
                {{ config('app.name') }}
            </a>

            <!-- Collapse Button -->
            <div class="md:hidden">
                <button type="button"
                    class="relative flex items-center justify-center text-sm font-semibold text-gray-800 border border-gray-200 rounded-lg hs-collapse-toggle size-10 hover:bg-gray-100 hover:border-gray-300 focus:outline-hidden focus:bg-gray-100 transition-colors disabled:opacity-50 disabled:pointer-events-none"
                    id="hs-header-classic-collapse" aria-expanded="false" aria-controls="hs-header-classic"
                    aria-label="Toggle navigation" data-hs-collapse="#hs-header-classic">
                    <svg class="hs-collapse-open:hidden size-5" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <line x1="3" x2="21" y1="6" y2="6" />
                        <line x1="3" x2="21" y1="12" y2="12" />
                        <line x1="3" x2="21" y1="18" y2="18" />
                    </svg>
                    <svg class="hidden hs-collapse-open:block shrink-0 size-5" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 6 6 18" />
                        <path d="m6 6 12 12" />
                    </svg>
                    <span class="sr-only">Toggle navigation</span>
                </button>
            </div>
            <!-- End Collapse Button -->
        </div>
        <!-- End Logo w/ Collapse Button -->

        <!-- Collapse -->
        <div id="hs-header-classic"
            class="hidden overflow-hidden transition-all duration-300 hs-collapse basis-full grow md:block md:basis-auto"
            aria-labelledby="hs-header-classic-collapse">
            <div
                class="overflow-hidden overflow-y-auto max-h-[75vh] md:max-h-none [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300">
                <div class="py-2 md:py-0 flex flex-col md:flex-row md:items-center md:justify-end gap-1 md:gap-2">
                    <!-- Home Link -->
                    <a class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-all duration-300
                        {{ request()->routeIs('home')
                            ? 'text-blue-600 bg-blue-50 border-l-4 border-blue-600 md:border-l-0 md:bg-transparent md:border-b-2 md:border-blue-600'
                            : 'text-gray-700 hover:text-blue-600 hover:bg-gray-50 md:hover:bg-transparent' }}"
                        href="{{ url('/') }}" {{ request()->routeIs('home') ? 'aria-current="page"' : '' }}>
                        <svg class="size-5 me-2" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z" />
                        </svg>
                        Home
                    </a>

                    <!-- Collection Link -->
                    <a class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-all duration-300
                        {{ request()->routeIs('product-catalog')
                            ? 'text-blue-600 bg-blue-50 border-l-4 border-blue-600 md:border-l-0 md:bg-transparent md:border-b-2 md:border-blue-600'
                            : 'text-gray-700 hover:text-blue-600 hover:bg-gray-50 md:hover:bg-transparent' }}"
                        href="{{ route('product-catalog') }}"
                        {{ request()->routeIs('product-catalog') ? 'aria-current="page"' : '' }}>
                        <svg class="size-5 me-2" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path
                                d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.14 0-.25-.11-.25-.25l.03-.12.9-1.63h7.45c.75 0 1.41-.41 1.75-1.03l3.58-6.49c.08-.14.12-.31.12-.48 0-.55-.45-1-1-1H5.21l-.94-2H1zm16 16c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2z" />
                        </svg>
                        Collection
                    </a>

                    <!-- Cart Count -->
                    <div class="px-2 md:px-0">
                        <livewire:cart-count />
                    </div>
                </div>
            </div>
        </div>
        <!-- End Collapse -->
    </nav>
</header>
<!-- ========== END HEADER ========== -->
