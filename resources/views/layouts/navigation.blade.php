<nav x-data="{ open: false }" class="bg-white shadow-md border-b border-gray-200">
    <!-- Primary Navigation Menu -->
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('dashboard') }}">
                    <img src="{{ asset('logo.svg') }}" alt="Logo" class="block h-10 w-auto">
                </a>
            </div>

            <!-- Main Navigation Links -->
            <div class="hidden space-x-4 lg:flex">
                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    {{ __('messages.dashboard') }}
                </x-nav-link>
                <x-nav-link :href="route('users.index')" :active="request()->routeIs('users.index')">
                    {{ __('messages.users') }}
                </x-nav-link>
                <x-nav-link :href="route('clients.index')" :active="request()->routeIs('clients.index')">
                    {{ __('messages.clients') }}
                </x-nav-link>
                <x-nav-link :href="route('services.index')" :active="request()->routeIs('services.index')">
                    {{ __('messages.services') }}
                </x-nav-link>
                <x-nav-link :href="route('service_availability.index')" :active="request()->routeIs('service_availability.index')">
                    {{ __('messages.service_availability') }}
                </x-nav-link>
                <x-nav-link :href="route('reservations.index')" :active="request()->routeIs('reservations.index')">
                    {{ __('messages.reservations') }}
                </x-nav-link>
                <x-nav-link :href="route('transfers.index')" :active="request()->routeIs('transfers.index')">
                    {{ __('messages.transfers') }}
                </x-nav-link>
                
                <x-nav-link :href="route('reservation_transfers.index')" :active="request()->routeIs('reservation_transfers.index')">
                    {{ __('messages.reservation_transfers') }}
                </x-nav-link>
            </div>

            <!-- Action Items -->
            <div class="flex items-center space-x-4">
                <!-- Language Dropdown -->
                <x-dropdown align="right" width="36">
                    <x-slot name="trigger">
                        <button class="flex items-center px-3 py-2 text-gray-500 hover:text-gray-700">
                            <span class="uppercase">{{ app()->getLocale() }}</span>
                            <svg class="w-4 h-4 ml-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link href="{{ route('language.switch', 'en') }}">
                            {{ __('English') }}
                        </x-dropdown-link>
                        <x-dropdown-link href="{{ route('language.switch', 'fr') }}">
                            {{ __('Français') }}
                        </x-dropdown-link>
                    </x-slot>
                </x-dropdown>

                <!-- User Dropdown -->
                <x-dropdown align="right" width="36">
                    <x-slot name="trigger">
                        <button class="flex items-center px-3 py-2 text-gray-500 hover:text-gray-700">
                            <span>{{ Auth::user()->name }}</span>
                            <svg class="w-4 h-4 ml-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="flex items-center lg:hidden">
                <button @click="open = !open"
                    class="inline-flex items-center p-2 text-gray-500 rounded hover:text-gray-700 hover:bg-gray-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden lg:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('messages.dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('users.index')" :active="request()->routeIs('users.index')">
                {{ __('messages.users') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('services.index')" :active="request()->routeIs('services.index')">
                {{ __('messages.services') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="text-base font-medium text-gray-800">{{ Auth::user()->name }}</div>
                <div class="text-sm font-medium text-gray-500">{{ Auth::user()->email }}</div>
            </div>
            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
