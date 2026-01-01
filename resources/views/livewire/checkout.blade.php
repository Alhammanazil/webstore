<div class="bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen py-10">
    <div class="container mx-auto max-w-[85rem] w-full px-4 sm:px-6 lg:px-8">
        <div class="mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-2">Complete Your Order</h1>
            <p class="text-gray-600">Secure checkout in just a few steps</p>
        </div>

        <div class="grid gap-8 lg:grid-cols-3">
            <!-- Left Column - Forms -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Section 1: Billing Contact -->
                <div
                    class="p-8 bg-white border border-gray-200 rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <div class="flex items-center gap-3 mb-6">
                        <div
                            class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold">
                            1</div>
                        <h2 class="text-xl font-bold text-gray-900">Billing Contact</h2>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        {{-- Full Name --}}
                        <div class="col-span-2">
                            <label class="block mb-2 text-sm font-semibold text-gray-700">Full Name <span
                                    class="text-red-600">*</span></label>
                            <input id="af-payment-billing-contact" wire:model="data.full_name" type="text"
                                class="w-full px-4 py-3 border-2 rounded-lg transition-all duration-200 focus:outline-none @error('data.full_name') border-red-600 focus:border-red-500 focus:ring-2 focus:ring-red-200 @else border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 @enderror shadow-sm"
                                placeholder="Your full name" required>
                            @error('data.full_name')
                                <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div>
                            <label class="block mb-2 text-sm font-semibold text-gray-700">Email <span
                                    class="text-red-600">*</span></label>
                            <input type="email" wire:model="data.email"
                                class="w-full px-4 py-3 border-2 rounded-lg transition-all duration-200 focus:outline-none @error('data.email') border-red-600 focus:border-red-500 focus:ring-2 focus:ring-red-200 @else border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 @enderror shadow-sm"
                                placeholder="your@email.com" required>
                            @error('data.email')
                                <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Phone Number --}}
                        <div>
                            <label class="block mb-2 text-sm font-semibold text-gray-700">Phone Number <span
                                    class="text-red-600">*</span></label>
                            <input type="tel" wire:model="data.phone_number"
                                class="w-full px-4 py-3 border-2 rounded-lg transition-all duration-200 focus:outline-none @error('data.phone_number') border-red-600 focus:border-red-500 focus:ring-2 focus:ring-red-200 @else border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 @enderror shadow-sm"
                                placeholder="+62 812 3456 7890" required>
                            @error('data.phone_number')
                                <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Section 2: Billing Address -->
                <div
                    class="p-8 bg-white border border-gray-200 rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <div class="flex items-center gap-3 mb-6">
                        <div
                            class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold">
                            2</div>
                        <h2 class="text-xl font-bold text-gray-900">Billing Address</h2>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label class="block mb-2 text-sm font-semibold text-gray-700">Street Address <span
                                    class="text-red-600">*</span></label>
                            <input id="af-payment-billing-address" type="text" wire:model="data.street_address"
                                class="py-3 px-4 block w-full border-2 rounded-lg shadow-sm focus:outline-none transition-all duration-200 @error('data.street_address') border-red-600 focus:border-red-500 focus:ring-2 focus:ring-red-200 @else border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 @enderror"
                                placeholder="Street Address (House number, RT/RW, Gang, etc)" required>
                            @error('data.street_address')
                                <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <div x-data="{ open: false }" class="relative w-full">
                                <label class="block mb-2 text-sm font-semibold text-gray-700">Location <span
                                        class="text-red-600">*</span></label>
                                <div class="relative">
                                    <input type="text" wire:model.live.debounce.500ms="region_selector.keyword"
                                        @focus="open = true" @click.outside="open = false"
                                        class="py-3 px-4 block w-full border-2 border-gray-300 shadow-sm rounded-lg transition-all duration-200 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                                        placeholder="Search Location (Village/Postal Code)">
                                    <div wire:loading wire:target="region_selector.keyword"
                                        class="absolute right-3 top-1/2 -translate-y-1/2 animate-spin inline-block w-4 h-4 border-[3px] border-current border-t-transparent text-blue-500 rounded-full"
                                        role="status" aria-label="loading">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </div>

                                @if (count($this->regions) > 0)
                                    <ul class="absolute z-10 w-full mt-2 overflow-y-auto bg-white border-2 border-gray-200 rounded-lg shadow-xl max-h-60"
                                        x-show="open">
                                        @foreach ($this->regions as $region)
                                            <li class="px-4 py-3 cursor-pointer hover:bg-blue-50 transition-colors duration-150 border-b border-gray-100 last:border-b-0"
                                                @click="open = false; $wire.set('region_selector.region_selected', {{ json_encode($region) }}); $wire.set('region_selector.keyword', '{{ $region->label }}')">
                                                <span class="font-medium text-gray-900">{{ $region->label }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif

                                @if (data_get($region_selector, 'region_selected'))
                                    <div class="mt-3 p-4 bg-green-50 border-2 border-green-200 rounded-lg">
                                        <p class="text-xs text-green-700 font-semibold">✓ Selected Location:</p>
                                        <p class="text-sm text-green-900 font-medium mt-1">
                                            {{ data_get($region_selector, 'region_selected.label') }}</p>
                                    </div>
                                @else
                                    <p class="mt-3 text-xs text-gray-500 italic">No location selected yet</p>
                                @endif
                                @error('region_selector.region_selected')
                                    <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 3: Shipping Method -->
                <div
                    class="p-8 bg-white border border-gray-200 rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <div class="flex items-center gap-3 mb-6">
                        <div
                            class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold">
                            3</div>
                        <h2 class="text-xl font-bold text-gray-900">Shipping Method</h2>
                    </div>

                    <div class="space-y-3">
                        <div class="w-full text-center relative flex justify-center">
                            <div wire:loading wire:target="region_selector.region_selected"
                                class="animate-spin inline-block w-4 h-4 border-[3px] border-current border-t-transparent text-blue-500 rounded-full"
                                role="status" aria-label="loading">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>

                        <div class="space-y-3">
                            @forelse ($this->shipping_methods as $group_name => $shipping_method_groups)
                                <div>
                                    <p class="text-sm font-bold text-gray-700 mb-3">{{ $group_name }}</p>
                                    <div class="space-y-2">
                                        @foreach ($shipping_method_groups as $i => $shipping_method)
                                            <label for="shipping_method_{{ $shipping_method->hash }}"
                                                class="flex items-center justify-between w-full gap-4 p-4 text-sm bg-gradient-to-r from-gray-50 to-white border-2 border-gray-200 rounded-xl hover:border-blue-400 hover:from-blue-50 hover:to-blue-50 cursor-pointer transition-all duration-200 group">
                                                <div class="flex items-center justify-start gap-3 flex-1">
                                                    <input wire:key="shipping_method_{{ $shipping_method->hash }}"
                                                        wire:model.live="shipping_selector.shipping_method"
                                                        value="{{ $shipping_method->hash }}"
                                                        class="w-5 h-5 border-2 border-gray-300 rounded-full text-blue-600 focus:ring-2 focus:ring-blue-300 checked:border-blue-600 cursor-pointer transition-all flex-shrink-0"
                                                        id="shipping_method_{{ $shipping_method->hash }}"
                                                        type="radio">

                                                    @if ($shipping_method->logo_url)
                                                        <img src="{{ $shipping_method->logo_url }}"
                                                            class="h-6 object-contain flex-shrink-0" />
                                                    @endif

                                                    <div class="flex-1">
                                                        <span
                                                            class="block text-sm font-semibold text-gray-900 group-hover:text-blue-600 transition-colors">
                                                            {{ $shipping_method->label }}
                                                        </span>
                                                        <span class="text-xs text-gray-500">
                                                            {{ $shipping_method->weight_formatted }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <span
                                                    class="text-sm font-bold text-blue-600 whitespace-nowrap flex-shrink-0">
                                                    {{ $shipping_method->cost_formatted }}
                                                </span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            @empty
                                <div class="p-4 bg-yellow-50 border-2 border-yellow-200 rounded-lg">
                                    <p class="text-sm text-yellow-800 font-medium">⚠️ Please fill in the shipping
                                        address first</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Section 4: Payment Method -->
                <div
                    class="p-8 bg-white border border-gray-200 rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <div class="flex items-center gap-3 mb-6">
                        <div
                            class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold">
                            4</div>
                        <h2 class="text-xl font-bold text-gray-900">Payment Method</h2>
                    </div>

                    <div class="grid space-y-3">
                        @php
                            $payment_methods = [
                                ['id' => 'qris', 'name' => 'QRIS', 'icon' => '📱'],
                                ['id' => 'dana', 'name' => 'Dana', 'icon' => '💳'],
                                ['id' => 'bca', 'name' => 'Bank Transfer - BCA', 'icon' => '🏦'],
                                ['id' => 'bni', 'name' => 'Bank Transfer - BNI', 'icon' => '🏦'],
                                ['id' => 'va_bca', 'name' => 'Virtual Account BCA', 'icon' => '💰'],
                            ];
                        @endphp
                        @foreach ($payment_methods as $key => $item)
                            <label for="payment_method_{{ $key }}"
                                class="flex items-center gap-4 w-full p-4 text-sm bg-gradient-to-r from-gray-50 to-white border-2 border-gray-200 rounded-xl hover:border-blue-400 hover:from-blue-50 hover:to-blue-50 cursor-pointer transition-all duration-200 group">
                                <input type="radio" name="hs-vertical-radio-in-form" wire:model="payment_method"
                                    value="{{ $item['id'] }}"
                                    class="w-5 h-5 border-2 border-gray-300 rounded-full text-blue-600 focus:ring-2 focus:ring-blue-300 checked:border-blue-600 cursor-pointer transition-all"
                                    id="payment_method_{{ $key }}">
                                <div class="flex items-center gap-3 flex-1">
                                    <span class="text-2xl">{{ $item['icon'] }}</span>
                                    <span
                                        class="font-semibold text-gray-900 group-hover:text-blue-600 transition-colors">{{ $item['name'] }}</span>
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Right Column - Order Summary (Sticky) -->
            <div class="lg:col-span-1">
                <div
                    class="sticky top-4 p-6 bg-gradient-to-br from-blue-50 to-indigo-50 border-2 border-blue-200 rounded-2xl shadow-xl">
                    <!-- Header -->
                    <div class="mb-5 pb-4 border-b-2 border-blue-200">
                        <h2 class="text-xl font-bold text-gray-900 mb-1">Order Summary</h2>
                        <p class="text-xs text-gray-600">Review before checkout</p>
                    </div>

                    <!-- Products List -->
                    <div class="space-y-3 mb-5 pb-5 border-b-2 border-blue-200 max-h-48 overflow-y-auto">
                        @forelse ($cart->items as $item)
                            <x-single-product-list :cart-item="$item" />
                        @empty
                            <p class="text-xs text-gray-600 text-center py-3">No items in cart</p>
                        @endforelse
                    </div>

                    <!-- Price Breakdown -->
                    <div class="space-y-2 mb-4">
                        <div class="flex items-center justify-between text-xs">
                            <span class="text-gray-700">Sub Total</span>
                            <span
                                class="font-bold text-gray-900">{{ data_get($this->summaries, 'sub_total_formatted') }}</span>
                        </div>
                        <div class="flex items-center justify-between text-xs">
                            <div class="flex flex-col">
                                <span class="text-gray-700">Shipping</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <div wire:loading wire:target="shipping_selector.shipping_method"
                                    class="animate-spin inline-block w-3 h-3 border-[2px] border-current border-t-transparent text-blue-500 rounded-full"
                                    role="status" aria-label="loading">
                                    <span class="sr-only">Loading...</span>
                                </div>
                                <div wire:loading wire:target="shipping_selector.shipping_method"
                                    class="animate-spin inline-block w-4 h-4 border-[3px] border-current border-t-transparent text-black rounded-full"
                                    role="status" aria-label="loading">
                                    <span class="sr-only">Loading...</span>
                                </div>
                                <span wire:loading.remove wire:target="shipping_selector.shipping_method"
                                    class="font-bold text-teal-600">{{ data_get($this->summaries, 'shipping_total_formatted') }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Total Amount - Compact -->
                    <div class="p-4 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-lg mb-4 shadow-lg">
                        <p class="text-xs text-blue-100 mb-1">Total Amount</p>
                        <p class="text-3xl font-bold text-white">
                            {{ data_get($this->summaries, 'grand_total_formatted') }}</p>
                        <div class="mt-3 pt-3 border-t border-blue-400 flex items-center gap-1 text-xs text-blue-100">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 111.414 1.414L7.414 9l3.293 3.293a1 1 0 11-1.414 1.414l-4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span>🔒 Secure payment</span>
                        </div>
                    </div>

                    <!-- Action Button -->
                    <button type="button" wire:click="placeAnOrder" wire:loading.attr="disabled"
                        class="w-full px-3 py-3 text-sm font-bold text-white bg-gradient-to-r from-blue-600 to-blue-700 rounded-lg hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-300 disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105 flex items-center justify-center gap-2">
                        <!-- Loading Spinner -->
                        <svg wire:loading wire:target="placeAnOrder" class="animate-spin w-4 h-4" fill="none"
                            viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                        <!-- Check Icon -->
                        <svg wire:loading.remove wire:target="placeAnOrder" class="w-4 h-4" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        <span wire:loading.remove wire:target="placeAnOrder">Place Order</span>
                        <span wire:loading wire:target="placeAnOrder">Processing...</span>
                    </button>

                    <!-- Error Summary / Info Text -->
                    <div class="mt-3">
                        @if ($errors->any())
                            <div class="p-3 bg-red-50 border border-red-200 rounded-lg">
                                <p class="text-xs font-semibold text-red-800 mb-2 flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Please complete the following:
                                </p>
                                <ul class="space-y-1">
                                    @error('data.full_name')
                                        <li class="text-xs text-red-700">• Full Name is required</li>
                                    @enderror
                                    @error('data.email')
                                        <li class="text-xs text-red-700">• Email is required</li>
                                    @enderror
                                    @error('data.phone_number')
                                        <li class="text-xs text-red-700">• Phone Number is required</li>
                                    @enderror
                                    @error('data.street_address')
                                        <li class="text-xs text-red-700">• Street Address is required</li>
                                    @enderror
                                    @error('region_selector.region_selected')
                                        <li class="text-xs text-red-700">• Location must be selected</li>
                                    @enderror
                                    @error('payment_method')
                                        <li class="text-xs text-red-700">• Payment Method must be selected</li>
                                    @enderror
                                </ul>
                            </div>
                        @else
                            <p class="text-xs text-gray-600 text-center">Redirected to payment page</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener('livewire:initialized', () => {
            // Listen for validation errors
            Livewire.hook('commit', ({
                component,
                commit,
                respond,
                succeed,
                fail
            }) => {
                succeed(({
                    snapshot,
                    effect
                }) => {
                    // Check if there are validation errors
                    if (component.serverMemo.errors && Object.keys(component.serverMemo.errors)
                        .length > 0) {
                        // Get the first error key
                        const firstErrorKey = Object.keys(component.serverMemo.errors)[0];

                        // Find the input element with error
                        let errorElement = null;

                        // Try to find by wire:model attribute
                        errorElement = document.querySelector(`[wire\\:model="${firstErrorKey}"]`);

                        if (!errorElement) {
                            // Try to find by id if it's a nested property like 'data.full_name'
                            const fieldName = firstErrorKey.split('.').pop();
                            errorElement = document.querySelector(`[wire\\:model*="${fieldName}"]`);
                        }

                        if (errorElement) {
                            // Scroll to the error field with smooth behavior
                            errorElement.scrollIntoView({
                                behavior: 'smooth',
                                block: 'center'
                            });

                            // Add shake animation
                            errorElement.classList.add('animate-shake');
                            setTimeout(() => {
                                errorElement.classList.remove('animate-shake');
                            }, 500);

                            // Focus on the field after scroll
                            setTimeout(() => {
                                errorElement.focus();
                            }, 300);
                        }
                    }
                });
            });
        });
    </script>
@endpush

@push('styles')
    <style>
        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            10%,
            30%,
            50%,
            70%,
            90% {
                transform: translateX(-5px);
            }

            20%,
            40%,
            60%,
            80% {
                transform: translateX(5px);
            }
        }

        .animate-shake {
            animation: shake 0.5s;
        }
    </style>
@endpush
