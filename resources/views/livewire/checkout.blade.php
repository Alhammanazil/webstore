<div>
    <div class="container mx-auto max-w-[85rem] w-full px-4 sm:px-6 lg:px-8 py-10">
        <h1 class="mb-8 text-3xl font-light">Checkout</h1>
        <div class="grid gap-8 md:gap-10 md:grid-cols-3">
            <div class="md:col-span-2">
                <!-- Section Billing Contact -->
                <div class="p-6 mb-6 bg-white border border-gray-200 rounded-lg">
                    <h2 class="mb-4 text-lg font-semibold text-gray-900">Billing Contact</h2>

                    <div class="grid grid-cols-2 gap-4">
                        {{-- Full Name --}}
                        <div class="col-span-2">
                            <label class="block mb-2 text-sm font-medium text-gray-700">Full Name <span
                                    class="text-red-600">*</span></label>
                            <input id="af-payment-billing-contact" wire:model="data.full_name" type="text"
                                class="w-full px-4 py-2.5 border rounded-lg focus:ring-2 transition-colors @error('data.full_name') border-red-600 focus:border-red-500 focus:ring-red-200 @else border-gray-300 focus:border-blue-500 focus:ring-blue-200 @enderror"
                                placeholder="Your full name" required>
                            @error('data.full_name')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-700">Email <span
                                    class="text-red-600">*</span></label>
                            <input type="email" wire:model="data.email"
                                class="w-full px-4 py-2.5 border rounded-lg focus:ring-2 transition-colors @error('data.email') border-red-600 focus:border-red-500 focus:ring-red-200 @else border-gray-300 focus:border-blue-500 focus:ring-blue-200 @enderror"
                                placeholder="your@email.com" required>
                            @error('data.email')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @endError
                        </div>

                        {{-- Phone Number --}}
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-700">Phone Number <span
                                    class="text-red-600">*</span></label>
                            <input type="tel" wire:model="data.phone_number"
                                class="w-full px-4 py-2.5 border rounded-lg focus:ring-2 transition-colors @error('data.phone_number') border-red-600 focus:border-red-500 focus:ring-red-200 @else border-gray-300 focus:border-blue-500 focus:ring-blue-200 @enderror"
                                placeholder="+62 812 3456 7890" required>
                            @error('data.phone_number')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <!-- Section -->
                <div
                    class="py-6 mt-5 border-t border-gray-200 first:pt-0 last:pb-0 first:border-transparent dark:border-neutral-700 dark:first:border-transparent">
                    <label for="af-payment-billing-address" class="inline-block text-sm font-medium">
                        Billing address
                    </label>

                    <div class="mt-2 space-y-3">
                        <input id="af-payment-billing-address" type="text" wire:model="data.street_address"
                            class="py-1.5 sm:py-2 px-3 pe-11 block w-full border rounded-lg focus:ring-2 transition-colors @error('data.street_address') border-red-600 focus:border-red-500 focus:ring-red-200 @else border-gray-200 focus:border-blue-500 focus:ring-blue-200 @enderror shadow-sm sm:text-sm disabled:opacity-50 disabled:pointer-events-none dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                            placeholder="Street Address" required>
                        @error('data.street_address')
                            <p class="mt-2 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                        <div>
                            <div x-data="{ open: false }" class="relative w-full">
                                <input type="text" @focus="open = true" @click.outside="open = false"
                                    class="py-1.5 sm:py-2 px-3 pe-11 block w-full border border-gray-200 shadow-sm sm:text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                    placeholder="Cari Lokasi">

                                <ul class="absolute z-10 w-full mt-1 overflow-y-auto bg-white border border-gray-200 rounded-b-lg max-h-60"
                                    x-show="open">
                                    <li class="p-2 cursor-pointer hover:bg-gray-100">
                                        Cikutra, Kota Bandung
                                    </li>
                                </ul>

                                <p class="mt-2 text-sm text-gray-600">
                                    Lokasi Dipilih
                                    <strong>Cikutra, Kota Bandung, 401900</strong>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Section -->
                <label for="af-shipping-method" class="inline-block text-sm font-medium">
                    Shipping Method
                </label>
                <div class="mt-2 space-y-3">
                    <div class="grid space-y-2">
                        <div class="text-xs font-bold">
                            Regular
                        </div>
                        @for ($i = 1; $i <= 3; $i++)
                            <label for="shipping_method_{{ $i }}"
                                class="flex items-center justify-between w-full gap-2 p-2 text-sm bg-white border border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 dark:border-neutral-700 dark:text-neutral-400">
                                <div class="flex items-center justify-start gap-2">
                                    <input type="radio" name="shipping_method" value="{{ $i }}"
                                        class="shrink-0 mt-0.5 border-gray-200 rounded-full text-blue-600 focus:ring-blue-500 checked:border-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500"
                                        id="shipping_method_{{ $i }}">
                                    <img src="{{ asset('images/shipping/jntexpress.svg') }}" class="h-5" />

                                    <span class="text-sm text-gray-500 ms-3 dark:text-neutral-400">JNT
                                        - YES
                                        <span class="text-xs text-gray-500">(1-2 Day)</span>
                                    </span>
                                </div>
                                <span class="text-sm text-gray-800">
                                    Rp.12.000
                                </span>
                            </label>
                        @endfor
                        <div class="text-xs text-red-600">Fill Shipping Address First</div>
                    </div>
                </div>

                <label for="af-payment-method" class="inline-block mt-5 text-sm font-medium">
                    Payment Method
                </label>
                <div class="mt-2 space-y-3">
                    <div class="grid space-y-2">
                        @php
                            $payment_methods = [
                                'Bank Transfer - BCA',
                                'Bank Transfer - BNI',
                                'Virtual Account BCA',
                                'QRIS',
                                'Dana',
                            ];
                        @endphp
                        @foreach ($payment_methods as $key => $item)
                            <label for="payment_method_{{ $key }}"
                                class="flex w-full p-2 text-sm bg-white border border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 dark:border-neutral-700 dark:text-neutral-400">
                                <input type="radio" name="hs-vertical-radio-in-form"
                                    class="shrink-0 mt-0.5 border-gray-200 rounded-full text-blue-600 focus:ring-blue-500 checked:border-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500"
                                    id="payment_method_{{ $key }}">
                                <span
                                    class="text-sm text-gray-500 ms-3 dark:text-neutral-400">{{ $item }}</span>
                            </label>
                        @endforeach

                    </div>
                </div>
            </div>
            <div class="p-10">
                <h1 class="mb-5 text-2xl font-light">Order Summary</h1>
                <div>
                    @foreach ($cart->items as $item)
                        <x-single-product-list :cart-item="$item" />
                    @endforeach
                </div>
                <div class="grid gap-5">
                    <!-- List Group -->
                    <ul class="flex flex-col mt-3">
                        <li
                            class="inline-flex items-center px-4 py-3 -mt-px text-sm text-gray-800 border border-gray-200 gap-x-2 first:rounded-t-lg first:mt-0 last:rounded-b-lg dark:border-neutral-700">
                            <div class="flex items-center justify-between w-full">
                                <span>Sub Total</span>
                                <span>{{ data_get($this->summaries, 'sub_total_formatted') }}</span>
                            </div>
                        </li>
                        <li
                            class="inline-flex items-center px-4 py-3 -mt-px text-sm text-gray-800 border border-gray-200 gap-x-2 first:rounded-t-lg first:mt-0 last:rounded-b-lg dark:border-neutral-700">
                            <div class="flex items-center justify-between w-full">
                                <span class="flex flex-col">
                                    <span>Shipping (JNT YES)</span>
                                    <span class="text-xs">570 gram</span>
                                </span>
                                <span>{{ data_get($this->summaries, 'shipping_total_formatted') }}</span>
                            </div>
                        </li>
                        <li
                            class="inline-flex items-center px-4 py-3 -mt-px text-sm font-semibold text-gray-800 border border-gray-200 gap-x-2 first:rounded-t-lg first:mt-0 last:rounded-b-lg dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-200">
                            <div class="flex items-center justify-between w-full">
                                <span>Total</span>
                                <span>{{ data_get($this->summaries, 'grand_total_formatted') }}</span>
                            </div>
                        </li>
                    </ul>
                    <!-- End List Group -->
                    <button type="button" wire:click="placeAnOrder"
                        class="inline-flex items-center justify-center w-full px-3 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-lg gap-x-2 hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                        Place an Order
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
