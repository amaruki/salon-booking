<div>
    <div>
        <div class="flex justify-between mx-7">
            <h2 class="text-2xl font-bold">
                {{ __('Transaction History') }}
            </h2>
        </div>

        <div class="overflow-auto rounded-lg border border-gray-200 shadow-md m-5">
            <table class="w-full border-collapse bg-white text-left text-sm text-gray-500 overflow-x-scroll min-w-screen">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="pl-6 py-4 font-medium text-gray-900">{{ __('Code') }}</th>
                        <th scope="col" class="px-4 py-4 font-medium text-gray-900">{{ __('Service') }}</th>
                        <th scope="col" class="px-4 py-4 font-medium text-gray-900">{{ __('Date') }}</th>
                        <th scope="col" class="px-4 py-4 font-medium text-gray-900">{{ __('Time Slot') }}</th>
                        <th scope="col" class="px-4 py-4 font-medium text-gray-900">{{ __('Location') }}</th>
                        <th scope="col" class="px-4 py-4 font-medium text-gray-900">{{ __('Total') }}</th>
                        <th scope="col" class="px-4 py-4 font-medium text-gray-900">{{ __('Status') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 border-t border-gray-100">
                    @if ($appointments->count() == 0)
                        <tr class="hover:bg-gray-50 text-center">
                            <td class="pl-6 py-4 max-w-0" colspan="7">{{ __('No Transactions Found') }}</td>
                        </tr>
                    @else
                        @foreach ($appointments as $appointment)
                            <tr class="hover:bg-gray-50">
                                <td class="pl-6 py-4 max-w-0">{{ $appointment->appointment_code }}</td>
                                <td class="px-6 py-4 max-w-xs font-medium text-gray-700">{{ $appointment->service->name ?? 'N/A' }}</td>
                                <td class="px-6 py-4 max-w-xs font-medium text-gray-700">{{ $appointment->date }}</td>
                                <td class="px-6 py-4 max-w-xs font-medium text-gray-700">
                                    {{ ($appointment->timeSlot->start_time ?? 'N/A') . ' - ' . ($appointment->timeSlot->end_time ?? 'N/A') }}
                                </td>
                                <td class="px-6 py-4 max-w-xs font-medium text-gray-700">{{ $appointment->location->name ?? 'N/A' }}</td>
                                <td class="px-6 py-4 max-w-xs font-medium text-gray-700">{{ $appointment->total }}</td>
                                <td class="px-6 py-4 max-w-xs font-medium text-gray-700">
                                    @switch($appointment->status)
                                        @case(0)
                                            {{ __('Unpaid') }}
                                            @break
                                        @case(1)
                                            {{ __('Paid') }}
                                            @break
                                        @case(2)
                                            {{ __('Cancelled') }}
                                            @break
                                        @case(3)
                                            {{ __('Completed') }}
                                            @break
                                        @default
                                            {{ __('Unknown') }}
                                    @endswitch
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            <div class="p-5">
                {{ $appointments->links() }}
            </div>
        </div>
    </div>
</div>