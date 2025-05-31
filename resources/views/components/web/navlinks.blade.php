{{-- Nav Links for the customer facing web --}}

<x-nav-link href="{{ route('services') }}" :active="request()->routeIs('services')"
    class="px-4 rounded-lg text-sm font-medium transition-all duration-200 hover:bg-gray-50 hover:text-pink-600">
    {{ __('Services') }}
</x-nav-link>

<x-nav-link href="{{ route('deals') }}" :active="request()->routeIs('deals')"
    class="px-4 rounded-lg text-sm font-medium transition-all duration-200 hover:bg-gray-50 hover:text-pink-600">
    {{ __('Deals') }}
</x-nav-link>
{{-- 
<x-nav-link href="{{ route('manageusers') }}" :active="request()->routeIs('manageusers')"
class="px-4 rounded-lg text-sm font-medium transition-all duration-200 hover:bg-gray-50 hover:text-pink-600">
    {{ __('Manage Users') }}
</x-nav-link> --}}
