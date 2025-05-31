@php
    $userRole = Auth::user()?->role()?->first()?->name;
    $isAuthenticated = Auth::check();
    $currentUser = Auth::user();
@endphp

<nav x-data="{ open: false, profileOpen: false, teamOpen: false }" 
     class="bg-white/95 backdrop-blur-md border-b border-gray-200 sticky top-0 z-50 shadow-sm">
    
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            
            <!-- Left Side: Logo -->
            <div class="flex items-center">
                <div class="flex-shrink-0 flex items-center">
                    @php
                        $logoRoute = $mainLogoRoute ?? route('dashboard');
                    @endphp
                    <a href="{{ $logoRoute }}" class="transition-opacity hover:opacity-80">
                        <x-application-mark class="block h-9 w-auto" />
                    </a>
                </div>
            </div>

            <!-- Center: Desktop Navigation Links -->
            <div class="hidden lg:flex lg:items-center lg:justify-center flex-1">
                <div class="flex items-center space-x-1">
                    <x-nav-link href="{{ route('home') }}" :active="request()->routeIs('home')"
                                class="px-4 rounded-lg text-sm font-medium transition-all duration-200 hover:bg-gray-50 hover:text-pink-600">
                        {{ __('Home') }}
                    </x-nav-link>

                    <!-- Custom Web Navigation Links -->
                    <x-web.navlinks />

                    <!-- Dynamic Navigation Links -->
                    @isset($navlinks)
                        {{ $navlinks }}
                    @endisset

                    <!-- Auth-specific Navigation -->
                    @if($isAuthenticated)
                        <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')"
                                    class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 hover:bg-gray-50 hover:text-pink-600">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                        
                        @if($userRole === 'Admin')
                            <x-nav-link href="{{ route('manageusers') }}" :active="request()->routeIs('manageusers')"
                                        class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 hover:bg-gray-50 hover:text-pink-600">
                                {{ __('Manage Users') }}
                            </x-nav-link>
                        @endif
                    @endif
                </div>
            </div>

            <!-- Right Side: Auth & User Menu -->
            <div class="flex items-center space-x-3">
                
                @if(!$isAuthenticated)
                    <!-- Guest Navigation -->
                    <div class="hidden sm:flex sm:items-center sm:space-x-3">
                        <x-nav-link href="{{ route('login') }}" :active="request()->routeIs('login')"
                                    class="px-4 py-2 text-sm font-medium text-gray-600 hover:text-pink-600 hover:bg-pink-50 rounded-lg transition-all duration-200">
                            {{ __('Login') }}
                        </x-nav-link>
                        <x-nav-link href="{{ route('register') }}" :active="request()->routeIs('register')"
                                    class="px-4 py-2 bg-gradient-to-r from-pink-600 to-pink-700 text-white hover:text-white rounded-lg text-sm font-medium hover:from-pink-700 hover:to-pink-800 transform hover:scale-105 transition-all duration-200 shadow-md hover:shadow-lg">
                            {{ __('Register') }}
                        </x-nav-link>
                    </div>
                @else
                    <!-- Authenticated User Navigation -->
                    <div class="hidden sm:flex sm:items-center sm:space-x-3">
                        
                        <!-- Customer-specific Cart Icon -->
                        @if($userRole === 'Customer')
                            <a href="{{ route('cart') }}" 
                               class="relative p-2 text-gray-500 hover:text-pink-600 hover:bg-pink-50 rounded-lg transition-all duration-200 group">
                                <svg class="w-6 h-6 group-hover:scale-110 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.5 6M7 13l1.5-6M17 21a2 2 0 11-4 0 2 2 0 014 0zM9 21a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                {{-- You can add cart count badge here if needed --}}
                            </a>
                        @endif

                        <!-- Teams Dropdown -->
                        @if(Laravel\Jetstream\Jetstream::hasTeamFeatures())
                            <div class="relative" x-data="{ teamOpen: false }">
                                <button @click="teamOpen = !teamOpen" 
                                        class="flex items-center px-4 py-2 text-sm font-medium text-gray-600 hover:text-pink-600 hover:bg-pink-50 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2 transition-all duration-200">
                                    {{ $currentUser->currentTeam->name }}
                                    <svg class="ml-2 h-4 w-4 transition-transform duration-200" 
                                         :class="{ 'rotate-180': teamOpen }"
                                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>

                                <div x-show="teamOpen" 
                                     x-transition:enter="transition ease-out duration-200"
                                     x-transition:enter-start="transform opacity-0 scale-95"
                                     x-transition:enter-end="transform opacity-100 scale-100"
                                     x-transition:leave="transition ease-in duration-150"
                                     x-transition:leave-start="transform opacity-100 scale-100"
                                     x-transition:leave-end="transform opacity-0 scale-95"
                                     @click.away="teamOpen = false"
                                     class="absolute right-0 mt-2 w-60 bg-white rounded-xl shadow-lg border border-gray-200 py-2 z-50 backdrop-blur-sm">
                                    
                                    <div class="px-4 py-2 text-xs font-semibold text-gray-400 uppercase tracking-wide">
                                        {{ __('Manage Team') }}
                                    </div>

                                    <a href="{{ route('teams.show', $currentUser->currentTeam->id) }}" 
                                       class="block px-4 py-2 text-sm text-gray-700 hover:bg-pink-50 hover:text-pink-600 transition-colors duration-150 rounded-lg mx-2">
                                        {{ __('Team Settings') }}
                                    </a>

                                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                        <a href="{{ route('teams.create') }}" 
                                           class="block px-4 py-2 text-sm text-gray-700 hover:bg-pink-50 hover:text-pink-600 transition-colors duration-150 rounded-lg mx-2">
                                            {{ __('Create New Team') }}
                                        </a>
                                    @endcan

                                    @if($currentUser->allTeams()->count() > 1)
                                        <div class="border-t border-gray-100 my-2"></div>
                                        <div class="px-4 py-2 text-xs font-semibold text-gray-400 uppercase tracking-wide">
                                            {{ __('Switch Teams') }}
                                        </div>
                                        @foreach($currentUser->allTeams() as $team)
                                            <x-switchable-team :team="$team" />
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        @endif

                        <!-- User Profile Dropdown -->
                        <div class="relative" x-data="{ profileOpen: false }">
                            <button @click="profileOpen = !profileOpen" 
                                    class="flex items-center space-x-2 px-3 py-2 rounded-xl text-sm font-medium text-gray-600 hover:text-pink-600 hover:bg-pink-50 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2 transition-all duration-200 group">
                                
                                @if(Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                    <img class="h-8 w-8 rounded-full object-cover border-2 border-transparent group-hover:border-pink-300 transition-all duration-200" 
                                         src="{{ $currentUser->profile_photo_url }}" 
                                         alt="{{ $currentUser->name }}" />
                                @endif
                                
                                <span class="hidden md:block">{{ Str::limit($currentUser->name, 20) }}</span>
                                
                                <svg class="h-4 w-4 transition-transform duration-200" 
                                     :class="{ 'rotate-180': profileOpen }"
                                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>

                            <div x-show="profileOpen" 
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="transform opacity-0 scale-95"
                                 x-transition:enter-end="transform opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-150"
                                 x-transition:leave-start="transform opacity-100 scale-100"
                                 x-transition:leave-end="transform opacity-0 scale-95"
                                 @click.away="profileOpen = false"
                                 class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-lg border border-gray-200 py-2 z-50 backdrop-blur-sm">
                                
                                @if($userRole === 'Customer')
                                    <div class="px-4 py-2 text-xs font-semibold text-gray-400 uppercase tracking-wide">
                                        {{ __('Shop') }}
                                    </div>
                                    <a href="{{ route('cart') }}" 
                                       class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-pink-50 hover:text-pink-600 transition-colors duration-150 rounded-lg mx-2">
                                        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.5 6M7 13l1.5-6"></path>
                                        </svg>
                                        {{ __('Cart') }}
                                    </a>
                                    <div class="border-t border-gray-100 my-2 mx-2"></div>
                                @endif

                                <div class="px-4 py-2 text-xs font-semibold text-gray-400 uppercase tracking-wide">
                                    {{ __('Account') }}
                                </div>

                                <a href="{{ route('profile.show') }}" 
                                   class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-pink-50 hover:text-pink-600 transition-colors duration-150 rounded-lg mx-2">
                                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    {{ __('Profile') }}
                                </a>

                                <div class="border-t border-gray-100 my-2 mx-2"></div>

                                <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf
                                    <button type="submit" 
                                            class="flex items-center w-full px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors duration-150 rounded-lg mx-2">
                                        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                        </svg>
                                        {{ __('Log Out') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Mobile menu button -->
                <div class="flex items-center sm:hidden">
                    <button @click="open = !open" 
                            class="inline-flex items-center justify-center p-2 rounded-lg text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-pink-500 transition-all duration-200">
                        <span class="sr-only">Open main menu</span>
                        <svg class="h-6 w-6 transition-transform duration-200" 
                             :class="{ 'rotate-90': open }"
                             stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{ 'hidden': open, 'inline-flex': !open }" 
                                  class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{ 'hidden': !open, 'inline-flex': open }" 
                                  class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation Menu -->
    <div x-show="open" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 transform -translate-y-2"
         x-transition:enter-end="opacity-100 transform translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 transform translate-y-0"
         x-transition:leave-end="opacity-0 transform -translate-y-2"
         class="sm:hidden bg-white border-t border-gray-200">
        
        <div class="px-2 pt-2 pb-3 space-y-1">
            <x-responsive-nav-link href="{{ route('home') }}" :active="request()->routeIs('home')"
                                   class="block px-4 py-3 rounded-lg text-base font-medium transition-colors duration-200">
                {{ __('Home') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link  href="{{ route('services') }}" :active="request()->routeIs('services')" class="block px-4 py-3 rounded-lg text-base font-medium text-gray-500 transition-colors duration-200">
                {{ __('Services') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link  href="{{ route('services') }}" :active="request()->routeIs('services')" class="block px-4 py-3 rounded-lg text-base font-medium text-gray-500 transition-colors duration-200">
                {{ __('Deals') }}
            </x-responsive-nav-link>

            @if($isAuthenticated)
                @if($userRole === 'Admin')
                    <x-responsive-nav-link href="{{ route('manageusers') }}" :active="request()->routeIs('manageusers')"
                                           class="block px-4 py-3 rounded-lg text-base font-medium transition-colors duration-200">
                        {{ __('Manage Users') }}
                    </x-responsive-nav-link>
                @endif

                <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')"
                                       class="block px-4 py-3 rounded-lg text-base font-medium transition-colors duration-200">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
            @else
                <x-responsive-nav-link href="{{ route('login') }}" :active="request()->routeIs('login')"
                                       class="block px-4 py-3 rounded-lg text-base font-medium transition-colors duration-200">
                    {{ __('Login') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link href="{{ route('register') }}" :active="request()->routeIs('register')"
                                       class="block px-4 py-3 bg-gradient-to-r from-pink-600 to-pink-700 text-white rounded-lg text-base font-medium transition-colors duration-200">
                    {{ __('Register') }}
                </x-responsive-nav-link>
            @endif
        </div>

        @if($isAuthenticated)
            <!-- Mobile User Section -->
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="flex items-center px-4 py-3">
                    @if(Laravel\Jetstream\Jetstream::managesProfilePhotos())
                        <div class="flex-shrink-0 mr-3">
                            <img class="h-10 w-10 rounded-full object-cover border-2 border-pink-200" 
                                 src="{{ $currentUser->profile_photo_url }}" 
                                 alt="{{ $currentUser->name }}" />
                        </div>
                    @endif
                    <div>
                        <div class="text-base font-medium text-gray-800">{{ $currentUser->name }}</div>
                        <div class="text-sm font-medium text-gray-500">{{ $currentUser->email }}</div>
                        @if($userRole)
                            <div class="text-xs text-pink-500 font-medium">{{ $userRole }}</div>
                        @endif
                    </div>
                </div>

                <div class="mt-3 space-y-1 px-2">
                    @if($userRole === 'Customer')
                        <x-responsive-nav-link href="{{ route('cart') }}"
                                               class="block px-4 py-3 rounded-lg text-base font-medium transition-colors duration-200">
                            {{ __('Cart') }}
                        </x-responsive-nav-link>
                    @endif

                    <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')"
                                           class="block px-4 py-3 rounded-lg text-base font-medium transition-colors duration-200">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf
                        <x-responsive-nav-link href="{{ route('logout') }}" @click.prevent="$root.submit();" 
                                               class="block px-4 py-3 rounded-lg text-base font-medium text-red-600 transition-colors duration-200">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>

                    <!-- Mobile Teams Section -->
                    @if(Laravel\Jetstream\Jetstream::hasTeamFeatures())
                        <div class="border-t border-gray-200 mt-3 pt-3">
                            <div class="block px-4 py-2 text-xs text-gray-400 font-semibold uppercase tracking-wide">
                                {{ __('Teams') }}
                            </div>

                            <x-responsive-nav-link href="{{ route('teams.show', $currentUser->currentTeam->id) }}" 
                                                   :active="request()->routeIs('teams.show')"
                                                   class="block px-4 py-3 rounded-lg text-base font-medium transition-colors duration-200">
                                {{ __('Team Settings') }}
                            </x-responsive-nav-link>

                            @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                <x-responsive-nav-link href="{{ route('teams.create') }}" 
                                                       :active="request()->routeIs('teams.create')"
                                                       class="block px-4 py-3 rounded-lg text-base font-medium transition-colors duration-200">
                                    {{ __('Create New Team') }}
                                </x-responsive-nav-link>
                            @endcan

                            @if($currentUser->allTeams()->count() > 1)
                                <div class="border-t border-gray-200 mt-2 pt-2">
                                    <div class="block px-4 py-2 text-xs text-gray-400 font-semibold uppercase tracking-wide">
                                        {{ __('Switch Teams') }}
                                    </div>
                                    @foreach($currentUser->allTeams() as $team)
                                        <x-switchable-team :team="$team" component="responsive-nav-link" />
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        @endif
    </div>
</nav>