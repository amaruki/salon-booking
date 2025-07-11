<x-app-layout>
    <div class="md:w-9/12 w-full mx-auto">
        <div class="relative bg-white rounded-lg shadow-xl overflow-hidden my-8">
            <!-- Breadcrumb -->
            <div class="bg-gray-50 px-6 py-3 text-sm">
                <a href="/" class="text-gray-500 hover:text-pink-500">{{ __('Beranda') }}</a> &raquo;
                <a href="/deals" class="text-gray-500 hover:text-pink-500">{{ __('Penawaran') }}</a> &raquo;
                <span class="text-gray-700">{{ $deal->name }}</span>
            </div>
            
            <!-- Main Content -->
            <div class="grid grid-cols-1 md:grid-cols-12 gap-8 p-6">
                <!-- Image Section -->
                <div class="md:col-span-5 lg:col-span-5">
                    <div class="aspect-w-1 aspect-h-1 rounded-lg overflow-hidden bg-gray-100 shadow">
                        <img src="{{ asset('storage/' . $deal->service->image) }}" alt="{{ $deal->name . ' image' }}"
                            class="object-cover object-center w-full h-full transition-all hover:scale-105">
                    </div>
                </div>

                <!-- Details Section -->
                <div class="md:col-span-7 lg:col-span-7">
                    <div class="flex justify-between items-start">
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900">{{ $deal->name }}</h1>
                        </div>
                        <div class="text-right">
                            <div class="text-3xl font-bold text-pink-600">Rp {{ number_format($deal->discounted_price, 0, ',', '.') }}</div>
                            @if ($deal->discounted_price < $deal->service->price)
                                <div class="text-lg text-gray-500 line-through">Rp {{ number_format($deal->service->price, 0, ',', '.') }}</div>
                            @endif
                        </div>
                    </div>

                    <!-- Owner Controls -->
                    @if (Auth::user()?->role_id == 1 || Auth::user()?->role_id == 2)
                        <div class="mt-4">
                            <a href="{{ route('managedeals') }}?search={{ $deal->id }}" class="inline-flex items-center px-4 py-2 bg-pink-500 text-white rounded-md hover:bg-pink-600 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                </svg>
                                {{ __('Kelola') }}
                            </a>
                        </div>
                    @endif

                    <!-- Description -->
                    <div class="mt-6 prose prose-pink">
                        <h2 class="text-xl font-semibold border-b border-gray-200 pb-2 mb-3">{{ __('Deskripsi') }}</h2>
                        <p class="text-gray-700">{{ $deal->description }}</p>
                    </div>

                    <!-- Included Service -->
                    <div class="mt-6">
                        <h2 class="text-xl font-semibold border-b border-gray-200 pb-2 mb-3">{{ __('Layanan yang Termasuk') }}</h2>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="flex items-center">
                                <img class="h-16 w-16 mr-4 rounded-md" src="{{ asset('storage/' . $deal->service->image) }}" alt="{{ $deal->service->name . ' image' }}">
                                <div>
                                    <h3 class="font-semibold text-lg">{{ $deal->service->name }}</h3>
                                    <p class="text-gray-600">{{ $deal->service->category->name }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Call to Action -->
                    <div class="mt-8">
                        <livewire:adding-service-to-cart :service="$deal->service" />
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</x-app-layout>