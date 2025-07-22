<div>
    <div>
        <div class="flex justify-between mx-7">
            <h2 class="text-2xl font-bold">

                @if ($selectFilter == 'upcoming')
                    {{ __('Upcoming') }}
                @elseif ($selectFilter == 'previous')
                    {{ __('Previous') }}
                @elseif ($selectFilter == 'cancelled')
                    {{ __('Cancelled') }}
                @elseif ($selectFilter == 'unpaid')
                    {{ __('Unpaid') }}
                @endif

                {{ __('Appointments') }}
            </h2>

        </div>
        <div class="mt-4">
            @if (session()->has('message'))
                <div class="px-4 py-2 text-white bg-green-500 rounded-md">
                    {{ session('message') }}
                </div>
            @endif
        </div>

        <div class="overflow-auto rounded-lg border border-gray-200 shadow-md m-5">

            <div class="w-full m-4 flex">

                <div class="w-1/2 mx-2">
                    <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only ">{{ __('Search') }}</label>
                    <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only ">{{ __('Search') }}</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                        <input type="search" wire:model="search" id="default-search" name="search"
                            class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="{{ __('Search Appointments...') }}">
                        <button type="submit"
                            class="text-white absolute right-2.5 bottom-2.5 bg-pink-600 hover:bg-pink-700 focus:ring-4 focus:outline-none focus:ring-pink-300 font-medium rounded-lg text-sm px-4 py-2">{{ __('Search') }}</button>
                    </div>
                </div>

                <select class="border text-gray-900  border-gray-300 rounded-lg" wire:model="selectFilter">
                @if (auth()->user()->role->name == 'Owner' || auth()->user()->role->name == 'Cashier')    
                <option value="unpaid">{{ __('Unpaid') }}</option>
                @endif
                    <option value="unpaid">{{ __('Upcoming') }}</option>
                    <option value="previous">{{ __('Previous') }}</option>
                    <option value="cancelled">{{ __('Cancelled') }}</option>
                </select>


            </div>

            <table
                class="w-full border-collapse bg-white text-left text-sm text-gray-500 overflow-x-scroll min-w-screen">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="pl-6 py-4 font-medium text-gray-900">{{ __('Code') }}</th>
                        <th scope="col" class="px-4 py-4 font-medium text-gray-900">{{ __('Queue Number') }}</th>
                        <th scope="col" class="px-4 py-4 font-medium text-gray-900">{{ __('Service') }}</th>
                        <th scope="col" class="px-4 py-4 font-medium text-gray-900">{{ __('Date') }}</th>
                        <th scope="col" class="px-4 py-4 font-medium text-gray-900">{{ __('Time Slot') }}</th>
                        <th scope="col" class="px-4 py-4 font-medium text-gray-900">{{ __('Location') }}</th>
                        @if (auth()->user()->role->name == 'Customer')
                            <th scope="col" class="px-4 py-4 font-medium text-gray-900">{{ __('Address') }}</th>
                            <th scope="col" class="px-4 py-4 font-medium text-gray-900">{{ __('Contact No') }}</th>
                        @elseif (auth()->user()->role->name == 'Owner' || auth()->user()->role->name == 'Cashier')
                            <th scope="col" class="px-4 py-4 font-medium text-gray-900">{{ __('Customer') }}</th>
                            <th scope="col" class="px-4 py-4 font-medium text-gray-900">{{ __('Contact No') }}</th>
                            <th scope="col" class="px-4 py-4 font-medium text-gray-900">{{ __('Email') }}</th>
                        @endif
                        <th scope="col" class="px-4 py-4 font-medium text-gray-900">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 border-t border-gray-100">
                    @if ($appointments->count() == 0)
                        <tr class="hover:bg-gray-50 text-center">
                            <td class="pl-6 py-4  max-w-0
                        " colspan="9">{{ __('No Appointments Found') }}
                            </td>
                        </tr>
                    @else
                        @foreach ($appointments as $appointment)
                            <tr class="hover:bg-gray-50">
                                <td class="pl-6 py-4  max-w-0">{{ $appointment->appointment_code }}</td>
                                <td class="px-6 py-4 max-w-xs font-medium text-gray-700">{{ $appointment->queue_number }}</td>

                                <td class="px-6 py-4 max-w-xs font-medium text-gray-700">
                                    {{ $appointment->service->name ?? 'N/A' }}</td>
                                <td class="px-6 py-4 max-w-xs font-medium text-gray-700">{{ $appointment->date }}</td>
                                <td class="px-6 py-4 max-w-xs font-medium text-gray-700">
                                    {{ ($appointment->timeSlot->start_time ?? 'N/A') . ' - ' . ($appointment->timeSlot->end_time ?? 'N/A') }}
                                </td>
                                <td class="px-6 py-4 max-w-xs font-medium text-gray-700">
                                    {{ $appointment->location->name ?? 'N/A' }}</td>

                                @if (auth()->user()->role->name == 'Customer')
                                    <td class="px-6 py-4 max-w-xs font-medium text-gray-700">
                                        {{ $appointment->location->address }}</td>
                                    <td class="px-6 py-4 max-w-xs font-medium text-gray-700">
                                        {{ $appointment->location->telephone_number }}</td>
                                @elseif (auth()->user()->role->name == 'Owner' || auth()->user()->role->name == 'Cashier')
                                    <td class="px-6 py-4 max-w-xs font-medium text-gray-700">
                                        {{ $appointment->user->name }}</td>
                                    <td class="px-6 py-4 max-w-xs font-medium text-gray-700">
                                        {{ $appointment->user->phone_number }}</td>
                                    <td class="px-6 py-4 max-w-xs font-medium text-gray-700">
                                        {{ $appointment->user->email }}</td>
                                @endif

                                <td>
                                    <div class="flex gap-1 mt-5">
                                        @if (auth()->user()->role->name == 'Owner' || auth()->user()->role->name == 'Cashier')
                                            @if ($appointment->status == 0) {{-- 0 for unpaid --}}
                                                <x-button wire:click="markAsPaid({{ $appointment->id }})" wire:loading.attr="disabled">
                                                    {{ __('Mark as Paid') }}
                                                </x-button>
                                            @endif
                                        @endif
                                        @if (auth()->user()->role->name == 'Customer')
                                        @if ($selectFilter == 'unpaid' || $selectFilter == 'upcoming')
                                            <x-button wire:click="confirmAppointmentEdit({{ $appointment }})" wire:loading.attr="disabled">
                                                {{ __('Edit') }}
                                            </x-button>
                                            <x-danger-button wire:click="confirmAppointmentCancellation({{ $appointment->id }})"
                                                wire:loading.attr="disabled">
                                                Cancel
                                            </x-danger-button>
                                        @endif
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif

                </tbody>
            </table>
            <div class="p-5">
                {{ $appointments->links() }}
            </div>
            <x-dialog-modal wire:model="confirmingAppointmentCancellation">
                <x-slot name="title">
                    {{ __('Cancel Appointment') }}
                </x-slot>

                <x-slot name="content">
                    {{ __('Are you sure you want to cancel the appointment?') }}

                </x-slot>

                <x-slot name="footer">
                    <div class="flex gap-3">
                        <x-secondary-button wire:click="$set('confirmingAppointmentCancellation', false)"
                            wire:loading.attr="disabled">
                            {{ __('Back') }}
                        </x-secondary-button>

                        <x-danger-button wire:click="cancelAppointment()"
                            wire:loading.attr="disabled">
                            {{ __('Cancel') }}
                        </x-danger-button>
                    </div>

                </x-slot>
            </x-dialog-modal>

            <x-dialog-modal wire:model="confirmingAppointmentEdit">
                <x-slot name="title">
                    {{ __('Edit Appointment') }}
                </x-slot>

                <x-slot name="content">
                    <div class="col-span-6 sm:col-span-4">
                        <x-label for="date" value="{{ __('Date') }}" />
                        <x-input id="date" type="date" class="mt-1 block w-full" wire:model="appointment.date" />
                        <x-input-error for="appointment.date" class="mt-2" />
                    </div>

                    <div class="col-span-6 sm:col-span-4 mt-4">
                        <x-label for="time_slot_id" value="{{ __('Time Slot') }}" />
                        <select id="time_slot_id" class="mt-1 block w-full" wire:model="appointment.time_slot_id">
                            <option value="">{{ __('Select Time Slot') }}</option>
                            @foreach ($timeSlots as $timeSlot)
                                <option value="{{ $timeSlot->id }}">{{ $timeSlot->start_time }} - {{ $timeSlot->end_time }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="appointment.time_slot_id" class="mt-2" />
                    </div>

                    <div class="col-span-6 sm:col-span-4 mt-4">
                        <x-label for="service_id" value="{{ __('Service') }}" />
                        <select id="service_id" class="mt-1 block w-full" wire:model="appointment.service_id">
                            <option value="">{{ __('Select Service') }}</option>
                            @foreach ($services as $service)
                                <option value="{{ $service->id }}">{{ $service->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="appointment.service_id" class="mt-2" />
                    </div>

                    <div class="col-span-6 sm:col-span-4 mt-4">
                        <x-label for="location_id" value="{{ __('Location') }}" />
                        <select id="location_id" class="mt-1 block w-full" wire:model="appointment.location_id">
                            <option value="">{{ __('Select Location') }}</option>
                            @foreach ($locations as $location)
                                <option value="{{ $location->id }}">{{ $location->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="appointment.location_id" class="mt-2" />
                    </div>
                </x-slot>

                <x-slot name="footer">
                    <div class="flex gap-3">
                        <x-secondary-button wire:click="$set('confirmingAppointmentEdit', false)"
                            wire:loading.attr="disabled">
                            {{ __('Cancel') }}
                        </x-secondary-button>

                        <x-button wire:click="updateAppointment()" wire:loading.attr="disabled">
                            {{ __('Save') }}
                        </x-button>
                    </div>
                </x-slot>
            </x-dialog-modal>
        </div>
    </div>
</div>
