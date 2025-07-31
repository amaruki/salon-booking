<x-dashboard>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __("Riwayat Transaksi") }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        {{ __("Pelanggan") }}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{ __("Layanan") }}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{ __("Lokasi") }}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{ __("Tanggal & Waktu") }}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{ __("Total") }}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{ __("Status") }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($appointments as $appointment)
                                    <tr class="bg-white border-b">
                                        <td class="px-6 py-4">
                                            {{ $appointment->user->name }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $appointment->service->name }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $appointment->service->locations->first()->name ?? 'N/A' }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ \Carbon\Carbon::parse($appointment->date)->translatedFormat('d F Y') }}
                                            {{ date('g:i a', strtotime($appointment->start_time)) }}
                                        </td>
                                        <td class="px-6 py-4">
                                            Rp.{{ number_format($appointment->total, 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $appointment->status->statusBadge() }}">
                                                {{ $appointment->status->getLabel() }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-4 text-center">
                                            {{ __("Tidak ada riwayat transaksi.") }}
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $appointments->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dashboard>