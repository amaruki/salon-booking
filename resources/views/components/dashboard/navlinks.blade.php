@if(Auth::User())

    {{-- Only owner can manage the users at the moment --}}
    {{-- @if(Auth::User()->role()->first()->name == 'Owner')
        <x-nav-link href="{{ route('manageusers') }}" :active="request()->routeIs('manageusers')">
            {{ __('Manage Users') }}
        </x-nav-link>
    @endif --}}
@endif
