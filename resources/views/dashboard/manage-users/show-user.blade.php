<x-dashboard>
    <div class="container mx-auto p-1">
        <div class="pb-2 mb-3">

            <div class="bg-white p-3 shadow-sm rounded-sm" x-data="{ showFullInfo: false }">
                <div class="text-center my-2">
                    <img class="h-16 w-16 rounded-full mx-auto" src="{{ $user->profile_photo_url }}" alt="">
                    <h1 class="text-gray-900 font-bold text-xl leading-8 my-1">{{ $user->name }}</h1>
                    <h3 class="text-gray-600 font-lg text-semibold leading-6">{{ $user->role->name }}</h3>
                </div>
                <div class="text-gray-700">
                    <div class="grid md:grid-cols-2 text-sm">
                        <div class="grid grid-cols-2">
                            <div class="px-4 py-2 font-semibold">{{ __('Phone No.') }}</div>
                            <div class="px-4 py-2">{{ $user->phone_number }}</div>
                        </div>
                        <div class="grid grid-cols-2">
                            <div class="px-4 py-2 font-semibold">{{ __('Email.') }}</div>
                            <div class="px-4 py-2">
                                <a class="text-blue-800" href="mailto:jane@example.com">{{ $user->email }}</a>
                            </div>
                        </div>
                    </div>
                    <ul
                        class="bg-gray-100 text-gray-600 hover:text-gray-700 hover:shadow py-2 px-3 mt-3 divide-y rounded shadow-sm">
                        <li class="flex items-center py-3">
                            <span>{{ __('Status') }}</span>
                            @if ($user->status == 1)
                                <span class="ml-auto"><span
                                        class="bg-green-500 py-1 px-2 rounded text-white text-sm">{{ __('Active') }}</span></span>
                            @else
                                <span class="ml-auto"><span
                                        class="bg-red-500 py-1 px-2 rounded text-white text-sm">{{ __('Inactive') }}</span></span>
                            @endif
                        </li>
                        <li class="flex items-center py-3">
                            <span>{{ __('Joined Date') }}</span>
                            <span class="ml-auto">{{ $user->created_at->toDateString() }}</span>
                        </li>

                            @php
                                $lastPastAppointment = $appointments->filter(function ($appointment) {
                                    return $appointment->status->value === 1 && $appointment->date <= \Carbon\Carbon::today()->toDateString();
                                })->sortByDesc('date')->first();
                                $lastAnyAppointment = $appointments->filter(function ($appointment) {
                                    return $appointment->status->value === 1;
                                })->sortByDesc('date')->first();
                                $lastPurchase = $appointments->filter(function ($appointment) {
                                    return $appointment->status->value === 3;
                                })->sortByDesc('created_at')->first();
                                $totalPurchases = $appointments->filter(function ($appointment) {
                                    return $appointment->status->value === 3;
                                })->sum('total');
                                $lastCancellation = $appointments->filter(function ($appointment) {
                                    return $appointment->status->value === 2;
                                })->sortByDesc('created_at')->first();
                            @endphp
                        <li class="flex items-center py-3">
                            <span>{{ __('Last Appointment') }}</span>
                            <span class="ml-auto">{{ $lastPastAppointment?->service->name }}</span>
                        </li>
                        <li class="flex items-center py-3">
                            <span>{{ __('Last Appointment Date') }}</span>
                            <span class="ml-auto">{{ $lastAnyAppointment?->date }}</span>
                        </li>
                        <div x-cloak x-show="showFullInfo">
                            <li class="flex items-center py-3">
                                <span>{{ __('Last Purchase') }}</span>
                                <span class="ml-auto">
                                    {{ $lastPurchase?->service->name }}
                                </span>
                            </li>
                            <li class="flex items-center py-3">
                                <span>{{ __('Last Purchase Date') }}</span>
                                <span class="ml-auto">
                                    {{ $lastPurchase?->created_at->toDateString() }}</span>
                            </li>
                            <li class="flex items-center py-3">
                                <span>{{ __('Last Purchase Amount') }}</span>
                                <span class="ml-auto">
                                    Rp.{{ $lastPurchase?->total }}</span>
                            </li>

                            <li class="flex items-center py-3">
                                <span>{{ __('Total Purchases') }}</span>
                                <span class="ml-auto">
                                    Rp.{{ $totalPurchases }}</span>
                            </li>
                            <li class="flex items-center py-3">
                                <span>{{ __('Last Cancellation') }}</span>
                                <span class="ml-auto">
                                    {{ $lastCancellation?->service->name }}</span>
                            </li>
                        </div>
                    </ul>
                </div>
                <button x-on:click="showFullInfo = !showFullInfo"
                    class="block w-full text-blue-800 text-sm font-semibold rounded-lg hover:bg-gray-100 focus:outline-none focus:shadow-outline focus:bg-gray-100 hover:shadow-xs p-3 my-4">{{ __('Show Full Information') }}</button>
            </div>
        </div>
    </div>
</x-dashboard>

