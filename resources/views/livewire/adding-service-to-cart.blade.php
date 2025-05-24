<section class="mt-10">
    <h3 class="text-2xl font-semibold text-gray-800 mb-6">Buat Janji Temu Anda</h3>

    <form wire:submit.prevent="addToCart" class="space-y-8 bg-white rounded-lg shadow-md p-6">
        <!-- Pilih Lokasi -->
        <div class="border-b pb-6">
            <h4 class="text-lg font-medium text-gray-900 mb-3 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-pink-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                Pilih Lokasi
            </h4>

            <fieldset x-data="{
                locations: @entangle('locations'),
                selectedLocation: @entangle('selectedLocation').defer
            }">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                    @foreach($locations as $location)
                        <label wire:key="location-{{ $location->id }}"
                            class="relative flex items-center justify-center rounded-md border py-3 px-4 text-sm font-medium uppercase focus:outline-none cursor-pointer transition-all duration-200 overflow-hidden group"
                            x-bind:class="{
                                'border-pink-500 ring-2 ring-pink-500 bg-pink-500 text-white shadow-md': selectedLocation === {{ $location->id }},
                                'border-gray-200 bg-gray-50 text-gray-800 hover:bg-pink-50 hover:border-pink-200': selectedLocation !== {{ $location->id }}
                            }"
                        >
                            <input type="radio" name="location-choice"
                                value="{{ $location->id }}" class="sr-only"
                                x-on:change="selectedLocation = {{ $location->id }}"
                                aria-labelledby="location-choice-{{ $location->id }}-label">
                            
                            <span id="location-choice-{{ $location->id }}-label" class="text-center">
                                {{ $location->name }}
                            </span>
                            
                            <span class="absolute bottom-0 left-0 h-1 w-full bg-pink-500 transform transition-transform duration-300"
                                x-bind:class="selectedLocation === {{ $location->id }} ? 'translate-y-0' : 'translate-y-full'"></span>
                        </label>
                    @endforeach
                </div>
            </fieldset>
        </div>

        <!-- Pilih Tanggal -->
        <div class="border-b pb-6">
            <h4 class="text-lg font-medium text-gray-900 mb-3 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-pink-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                Pilih Tanggal
            </h4>
            
            <div class="relative">
                <input type="date" 
                    class="w-full md:w-64 rounded-md py-3 px-4 border border-gray-300 focus:border-pink-500 focus:ring focus:ring-pink-200 focus:ring-opacity-50 bg-white shadow-sm transition-all"
                    wire:model.debounce.="selectedDate"
                    min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                    max="{{ \Carbon\Carbon::now()->addDays(30)->format('Y-m-d') }}" 
                    required>
            </div>
        </div>

        <!-- Pilih Waktu -->
        <div>
            <h4 class="text-lg font-medium text-gray-900 mb-3 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-pink-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Pilih Waktu
            </h4>
            
            <fieldset x-data="{ 
                timeSlots: @entangle('timeSlots'),
                selectedTimeSlot: @entangle('selectedTimeSlot').defer 
            }">
                <legend class="sr-only">Pilih waktu</legend>

                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
                    @foreach($timeSlots as $timeSlot)
                        <div wire:key="timeslot-{{ $timeSlot->id }}-element">
                            @if($timeSlot->available == true)
                                <label
                                    wire:key="timeslot-{{ $timeSlot->id }}-available"
                                    class="relative flex flex-col items-center justify-center rounded-md border py-3 px-4 text-sm font-medium focus:outline-none cursor-pointer transition-all duration-200"
                                    x-bind:class="{
                                        'border-pink-500 ring-2 ring-pink-500 bg-pink-500 text-white shadow-md': selectedTimeSlot === {{ $timeSlot->id }},
                                        'border-gray-200 bg-gray-50 text-gray-800 hover:bg-pink-50 hover:border-pink-200': selectedTimeSlot !== {{ $timeSlot->id }}
                                    }"
                                >
                                    <input type="radio" name="time-slot-choice"
                                        value="{{ $timeSlot->id }}" class="sr-only"
                                        x-on:change="selectedTimeSlot = {{ $timeSlot->id }}"
                                        aria-labelledby="time-slot-choice-{{ $timeSlot->id }}-label">
                                        
                                    <span id="time-slot-choice-{{ $timeSlot->id }}-label" class="block text-center">
                                        <span class="block mb-1 font-bold">
                                            {{ date('g:i', strtotime($timeSlot->start_time)) }}
                                        </span>
                                        <span class="text-xs opacity-80">
                                            hingga {{ date('g:i a', strtotime($timeSlot->end_time)) }}
                                        </span>
                                    </span>
                                    
                                    <span class="absolute bottom-0 left-0 h-1 w-full bg-pink-500 transform transition-transform duration-300"
                                        x-bind:class="selectedTimeSlot === {{ $timeSlot->id }} ? 'translate-y-0' : 'translate-y-full'"></span>
                                </label>
                            @else
                                <label
                                    wire:key="timeslot-{{ $timeSlot->id }}-unavailable"
                                    class="relative flex flex-col items-center justify-center rounded-md border border-gray-200 py-3 px-4 text-sm font-medium bg-gray-50 text-gray-300 cursor-not-allowed overflow-hidden">
                                    
                                    <input type="radio" name="time-slot-choice"
                                        value="{{ $timeSlot->id }}" disabled class="sr-only"
                                        aria-labelledby="time-slot-choice-{{ $timeSlot->id }}-disabled-label">
                                        
                                    <span id="time-slot-choice-{{ $timeSlot->id }}-disabled-label" class="block text-center">
                                        <span class="block mb-1 font-bold">
                                            {{ date('g:i', strtotime($timeSlot->start_time)) }}
                                        </span>
                                        <span class="text-xs opacity-80">
                                            hingga {{ date('g:i a', strtotime($timeSlot->end_time)) }}
                                        </span>
                                    </span>
                                    
                                    <span aria-hidden="true" class="absolute inset-0 pointer-events-none">
                                        <svg class="absolute inset-0 h-full w-full stroke-2 text-gray-200" viewBox="0 0 100 100"
                                            preserveAspectRatio="none" stroke="currentColor">
                                            <line x1="0" y1="100" x2="100" y2="0" vector-effect="non-scaling-stroke"/>
                                        </svg>
                                        <div class="absolute inset-0 bg-gray-100 bg-opacity-40"></div>
                                    </span>
                                    
                                    <span class="relative z-10 text-xs mt-1 text-red-400 font-medium">Tidak tersedia</span>
                                </label>
                            @endif
                        </div>
                    @endforeach
                </div>
            </fieldset>
        </div>

        <!-- Tombol Submit -->
        <div class="pt-4">
            <button type="submit"
                class="w-full flex items-center justify-center rounded-md bg-pink-600 px-8 py-4 text-base font-medium text-white hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                Tambahkan ke Keranjang
            </button>
        </div>
    </form>
</section>