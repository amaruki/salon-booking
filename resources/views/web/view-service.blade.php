<x-app-layout>
    <div class="md:w-9/12 w-full mx-auto">
        <div class="relative bg-white rounded-lg shadow-xl overflow-hidden my-8">
            <!-- Breadcrumb -->
            <div class="bg-gray-50 px-6 py-3 text-sm">
                <a href="/" class="text-gray-500 hover:text-pink-500">Beranda</a> &raquo;
                <a href="/services" class="text-gray-500 hover:text-pink-500">Layanan</a> &raquo;
                <span class="text-gray-700">{{ $service->name }}</span>
            </div>
            
            <!-- Main Content -->
            <div class="grid grid-cols-1 md:grid-cols-12 gap-8 p-6">
                <!-- Image Section -->
                <div class="md:col-span-5 lg:col-span-5">
                    <div class="aspect-w-1 aspect-h-1 rounded-lg overflow-hidden bg-gray-100 shadow">
                        <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->name . ' image' }}"
                            class="object-cover object-center w-full h-full transition-all hover:scale-105">
                    </div>
                </div>

                <!-- Details Section -->
                <div class="md:col-span-7 lg:col-span-7">
                    <div class="flex justify-between items-start">
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900">{{ $service->name }}</h1>
                            <div class="flex items-center mt-2">
                                <span class="px-3 py-1 bg-pink-100 text-pink-700 rounded-full text-sm font-medium">{{ $service->category->name }}</span>
                            </div>
                        </div>
                        <div class="text-3xl font-bold text-pink-600">Rp {{ number_format($service->price, 0, '.', '.') }}</div>
                    </div>

                    <!-- Admin Controls -->
                    @if (Auth::user()?->role_id == 1 || Auth::user()?->role_id == 2)
                        <div class="mt-4">
                            <a href="{{ route('manageservices') }}?search={{ $service->slug }}" class="inline-flex items-center px-4 py-2 bg-pink-500 text-white rounded-md hover:bg-pink-600 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                </svg>
                                Kelola
                            </a>
                        </div>
                    @endif

                    <!-- Description -->
                    <div class="mt-6 prose prose-pink">
                        <h2 class="text-xl font-semibold border-b border-gray-200 pb-2 mb-3">Deskripsi</h2>
                        <p class="text-gray-700">{{ $service->description }}</p>
                    </div>

                    <!-- Tabs for Additional Information -->
                    <div class="mt-8 border rounded-lg overflow-hidden">
                        <div x-data="{ activeTab: 'benefits' }" class="bg-white">
                            <!-- Tab Headers -->
                            <div class="flex border-b">
                                @if($service->benefits)
                                <button 
                                    @click="activeTab = 'benefits'" 
                                    :class="{'bg-pink-50 border-pink-500 text-pink-600': activeTab === 'benefits', 'border-transparent': activeTab !== 'benefits'}"
                                    class="px-4 py-2 text-sm font-medium border-b-2 focus:outline-none">
                                    Manfaat
                                </button>
                                @endif

                                @if($service->cautions)
                                <button 
                                    @click="activeTab = 'cautions'" 
                                    :class="{'bg-pink-50 border-pink-500 text-pink-600': activeTab === 'cautions', 'border-transparent': activeTab !== 'cautions'}"
                                    class="px-4 py-2 text-sm font-medium border-b-2 focus:outline-none">
                                    Peringatan
                                </button>
                                @endif

                                @if($service->allergens)
                                <button 
                                    @click="activeTab = 'allergens'" 
                                    :class="{'bg-pink-50 border-pink-500 text-pink-600': activeTab === 'allergens', 'border-transparent': activeTab !== 'allergens'}"
                                    class="px-4 py-2 text-sm font-medium border-b-2 focus:outline-none">
                                    Alergen
                                </button>
                                @endif

                                @if($service->aftercare_tips)
                                <button 
                                    @click="activeTab = 'aftercare'" 
                                    :class="{'bg-pink-50 border-pink-500 text-pink-600': activeTab === 'aftercare', 'border-transparent': activeTab !== 'aftercare'}"
                                    class="px-4 py-2 text-sm font-medium border-b-2 focus:outline-none">
                                    Perawatan
                                </button>
                                @endif
                            </div>

                            <!-- Tab Content -->
                            @if($service->benefits)
                            <div x-show="activeTab === 'benefits'" class="p-4">
                                <p class="text-gray-700">{{ $service->benefits }}</p>
                            </div>
                            @endif

                            @if($service->cautions)
                            <div x-show="activeTab === 'cautions'" class="p-4">
                                <p class="text-gray-700">{{ $service->cautions }}</p>
                            </div>
                            @endif

                            @if($service->allergens)
                            <div x-show="activeTab === 'allergens'" class="p-4">
                                <p class="text-gray-700">{{ $service->allergens }}</p>
                            </div>
                            @endif

                            @if($service->aftercare_tips)
                            <div x-show="activeTab === 'aftercare'" class="p-4">
                                <p class="text-gray-700">{{ $service->aftercare_tips }}</p>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Call to Action -->
                    <div class="mt-8">
                        <livewire:adding-service-to-cart :service="$service" />
                    </div>
                </div>
            </div>

            <!-- Analytics Section for Admin -->
            @if (Auth::user()?->role_id == 1 || Auth::user()?->role_id == 2)
                <div class="border-t border-gray-200 mt-8 px-6 py-6 bg-gray-50">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Wawasan Analitik</h2>
                    
                    <!-- Summary Stats -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                        <div class="bg-white p-4 rounded-lg shadow">
                            <span class="text-sm text-gray-500">Total Dilihat</span>
                            <div class="flex items-center justify-between mt-1">
                                <span class="text-2xl font-bold">{{ $views }}</span>
                                <span class="px-2 py-1 rounded text-sm @if($percentageViewsChangeLastWeek > 0) bg-green-100 text-green-800 @elseif($percentageViewsChangeLastWeek < 0) bg-red-100 text-red-800 @else bg-gray-100 text-gray-800 @endif">
                                    @if($percentageViewsChangeLastWeek !== 'N/A')
                                        @if($percentageViewsChangeLastWeek > 0)
                                            ↑ {{ $percentageViewsChangeLastWeek }}%
                                        @elseif($percentageViewsChangeLastWeek < 0)
                                            ↓ {{ abs($percentageViewsChangeLastWeek) }}%
                                        @else
                                            0%
                                        @endif
                                    @else
                                        N/A
                                    @endif
                                </span>
                            </div>
                            <span class="text-xs text-gray-500">Minggu Lalu: {{ $viewsLastWeek }}</span>
                        </div>

                        <div class="bg-white p-4 rounded-lg shadow">
                            <span class="text-sm text-gray-500">Total Janji Temu</span>
                            <div class="flex items-center justify-between mt-1">
                                <span class="text-2xl font-bold">{{ $appointmentsTotal }}</span>
                                <span class="px-2 py-1 rounded text-sm @if($percentageAppointmentsChangeLastWeek > 0) bg-green-100 text-green-800 @elseif($percentageAppointmentsChangeLastWeek < 0) bg-red-100 text-red-800 @else bg-gray-100 text-gray-800 @endif">
                                    @if($percentageAppointmentsChangeLastWeek !== 'N/A')
                                        @if($percentageAppointmentsChangeLastWeek > 0)
                                            ↑ {{ $percentageAppointmentsChangeLastWeek }}%
                                        @elseif($percentageAppointmentsChangeLastWeek < 0)
                                            ↓ {{ abs($percentageAppointmentsChangeLastWeek) }}%
                                        @else
                                            0%
                                        @endif
                                    @else
                                        N/A
                                    @endif
                                </span>
                            </div>
                            <span class="text-xs text-gray-500">Minggu Lalu: {{ $appointmentsLastWeek }}</span>
                        </div>

                        <div class="bg-white p-4 rounded-lg shadow">
                            <span class="text-sm text-gray-500">Janji Temu (Bulanan)</span>
                            <div class="flex items-center justify-between mt-1">
                                <span class="text-2xl font-bold">{{ $appointmentsLastMonth }}</span>
                                <span class="px-2 py-1 rounded text-sm @if($percentageAppointmentsChangeLastMonth > 0) bg-green-100 text-green-800 @elseif($percentageAppointmentsChangeLastMonth < 0) bg-red-100 text-red-800 @else bg-gray-100 text-gray-800 @endif">
                                    @if($percentageAppointmentsChangeLastMonth !== 'N/A')
                                        @if($percentageAppointmentsChangeLastMonth > 0)
                                            ↑ {{ $percentageAppointmentsChangeLastMonth }}%
                                        @elseif($percentageAppointmentsChangeLastMonth < 0)
                                            ↓ {{ abs($percentageAppointmentsChangeLastMonth) }}%
                                        @else
                                            0%
                                        @endif
                                    @else
                                        N/A
                                    @endif
                                </span>
                            </div>
                            <span class="text-xs text-gray-500">Perubahan Bulanan</span>
                        </div>

                        <div class="bg-white p-4 rounded-lg shadow">
                            <span class="text-sm text-gray-500">Total Pendapatan</span>
                            <div class="flex items-center justify-between mt-1">
                                <span class="text-2xl font-bold">Rp {{ number_format($totalRevenue, 0, '.', '.') }}</span>
                                <span class="px-2 py-1 rounded text-sm @if($percentageRevenueChangeLastWeek > 0) bg-green-100 text-green-800 @elseif($percentageRevenueChangeLastWeek < 0) bg-red-100 text-red-800 @else bg-gray-100 text-gray-800 @endif">
                                    @if($percentageRevenueChangeLastWeek !== 'N/A')
                                        @if($percentageRevenueChangeLastWeek > 0)
                                            ↑ {{ $percentageRevenueChangeLastWeek }}%
                                        @elseif($percentageRevenueChangeLastWeek < 0)
                                            ↓ {{ abs($percentageRevenueChangeLastWeek) }}%
                                        @else
                                            0%
                                        @endif
                                    @else
                                        N/A
                                    @endif
                                </span>
                            </div>
                            <span class="text-xs text-gray-500">Minggu Lalu: Rp {{ number_format($totalRevenueLastWeek, 0, '.', '.') }}</span>
                        </div>
                    </div>

                    <!-- Time Slots Analysis -->
                    <div x-data="{ activeAnalytic: 'weekly' }">
                        <div class="bg-gray-100 rounded-lg p-1 inline-flex mb-4">
                            <button 
                                @click="activeAnalytic = 'weekly'" 
                                :class="{'bg-white shadow': activeAnalytic === 'weekly'}"
                                class="px-4 py-2 text-sm font-medium rounded-md">
                                Mingguan
                            </button>
                            <button 
                                @click="activeAnalytic = 'allTime'" 
                                :class="{'bg-white shadow': activeAnalytic === 'allTime'}"
                                class="px-4 py-2 text-sm font-medium rounded-md">
                                Sepanjang Waktu
                            </button>
                        </div>

                        <div x-show="activeAnalytic === 'weekly'" class="bg-white rounded-lg shadow overflow-hidden">
                            <div class="px-4 py-3 bg-gray-50 border-b">
                                <h3 class="font-medium">Slot Waktu Terpopuler Minggu Lalu</h3>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Slot Waktu</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Persentase</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @php
                                            $totalWeekly = array_sum(array_column($timeSlotsStatsLastWeek, 'count'));
                                        @endphp
                                        @foreach ($timeSlotsStatsLastWeek as $timeSlotStat)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    {{ date('g:i a', strtotime($timeSlotStat['time_slot']->start_time)) . ' - ' . date('g:i a', strtotime($timeSlotStat['time_slot']->end_time)) }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $timeSlotStat['count'] }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    <div class="flex items-center">
                                                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                                                            <div class="bg-pink-500 h-2.5 rounded-full" style="width: {{ $totalWeekly > 0 ? ($timeSlotStat['count'] / $totalWeekly * 100) : 0 }}%"></div>
                                                        </div>
                                                        <span class="ml-2">{{ $totalWeekly > 0 ? number_format(($timeSlotStat['count'] / $totalWeekly * 100), 1) : 0 }}%</span>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div x-show="activeAnalytic === 'allTime'" class="bg-white rounded-lg shadow overflow-hidden">
                            <div class="px-4 py-3 bg-gray-50 border-b">
                                <h3 class="font-medium">Slot Waktu Terpopuler Sepanjang Waktu</h3>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Slot Waktu</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Persentase</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @php
                                            $totalAllTime = array_sum(array_column($timeSlotsStats, 'count'));
                                        @endphp
                                        @foreach ($timeSlotsStats as $timeSlotStat)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    {{ date('g:i a', strtotime($timeSlotStat['time_slot']->start_time)) . ' - ' . date('g:i a', strtotime($timeSlotStat['time_slot']->end_time)) }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $timeSlotStat['count'] }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    <div class="flex items-center">
                                                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                                                            <div class="bg-pink-500 h-2.5 rounded-full" style="width: {{ $totalAllTime > 0 ? ($timeSlotStat['count'] / $totalAllTime * 100) : 0 }}%"></div>
                                                        </div>
                                                        <span class="ml-2">{{ $totalAllTime > 0 ? number_format(($timeSlotStat['count'] / $totalAllTime * 100), 1) : 0 }}%</span>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</x-app-layout>