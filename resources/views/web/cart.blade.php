<x-app-layout>
    <div class="bg-gray-100 py-8">
        <div class="container mx-auto px-4 md:w-11/12">
            <h1 class="text-2xl font-semibold mb-4">{{ __('Keranjang') }}</h1>
            @if (session('unavailable_time_slots'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">{{ __('Ups!') }}</strong>
                    <span
                        class="block sm:inline">{{ __('Beberapa slot waktu tidak tersedia. Harap batalkan pilihan atau hapus dari keranjang.') }}</span>
                    <ul class="mt-2 list-disc list-inside text-sm text-red-600">
                        @foreach (session('unavailable_time_slots') as $unavailable_time_slot)
                            <li>
                                {{ $unavailable_time_slot['service_name'] }} pada {{ $unavailable_time_slot['date'] }}
                                ({{ date('g:i a', strtotime($unavailable_time_slot['start_time'])) }}
                                -
                                {{ date('g:i a', strtotime($unavailable_time_slot['end_time'])) }})
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="flex flex-col md:flex-row gap-4" x-data="{ total: {{ isset($cart) ? $cart->services->sum('pivot.price') : 0 }} }">
                <div class="md:w-3/4">
                    <div class="bg-white rounded-lg shadow-md p-6 mb-4">
                        <table class="w-full">
                            <thead>
                                <tr>
                                    <th class="text-left font-semibold"></th>
                                    <th class="text-left font-semibold">{{ __('Layanan') }}</th>
                                    <th class="text-left font-semibold">{{ __('Harga') }}</th>
                                    <th class="text-left font-semibold">{{ __('Jadwal') }}</th>
                                    <th class="text-left font-semibold">{{ __('Lokasi') }}</th>
                                    <th class="text-left font-semibold"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($cart) && $cart->services->isNotEmpty())
                                    @foreach ($cart->services as $service)
                                        <tr>
                                            <td class="py-4">
                                                <input type="checkbox" name="selected_services[]"
                                                    value="{{ $service->pivot->id }}" form="checkout-form" checked
                                                    @change="total += $event.target.checked ? {{ $service->pivot->price }} : -{{ $service->pivot->price }}">
                                            </td>
                                            <td class="py-4">
                                                <div class="flex items-center">
                                                    <img class="h-16 w-16 mr-4 rounded"
                                                        src="{{ '/storage/' . $service->image }}"
                                                        alt="{{ $service->name . ' image' }}">
                                                    <span class="font-semibold"> {{ $service->name }}</span>
                                                </div>
                                            </td>
                                            <td class="py-4">
                                                Rp.{{ number_format($service->pivot->price, 0, ',', '.') }}</td>
                                            <td class="py-4">
                                                {{ \Carbon\Carbon::parse($service->pivot->date)->translatedFormat('d F Y') }}
                                                <br>
                                                <span class="text-sm text-gray-600">
                                                    {{ date('g:i a', strtotime($service->pivot->start_time)) }}
                                                    -
                                                    {{ date('g:i a', strtotime($service->pivot->end_time)) }}
                                                </span>
                                            </td>
                                            <td class="py-4">
                                                {{ optional($service->locations->first())->name }}</td>
                                            <td class="py-4">
                                                <form
                                                    action="{{ route('cart.remove-item', ['cart_service_id' => $service->pivot->id]) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit"
                                                        class="text-red-500 hover:text-red-700 font-semibold">{{ __('Hapus') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6" class="text-center py-8">
                                            {{ __('Tidak ada item di keranjang') }}</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="md:w-1/4">
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-lg font-semibold mb-4">{{ __('Ringkasan') }}</h2>
                        <div class="flex justify-between mb-2">
                            <span>{{ __('Subtotal') }}</span>
                            <span x-text="'Rp.' + new Intl.NumberFormat('id-ID').format(total)">Rp.0</span>
                        </div>
                        <hr class="my-2">
                        <div class="flex justify-between mb-2">
                            <span class="font-semibold">{{ __('Total') }}</span>
                            <span class="font-semibold"
                                x-text="'Rp.' + new Intl.NumberFormat('id-ID').format(total)">Rp.0</span>
                        </div>
                        <form id="checkout-form" action="{{ route('cart.checkout') }}" method="post">
                            @csrf
                            <button type="submit"
                                class="bg-pink-500 text-white py-2 px-4 rounded-lg mt-4 w-full">
                                {{ __('Checkout') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
