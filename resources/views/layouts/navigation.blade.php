<nav x-data="{ open: false }" class="border-b border-gray-100 bg-white">
    <!-- Primary Navigation Menu -->
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 justify-between">
            <div class="flex">
                <!-- Logo -->
                <div class="flex shrink-0 items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links for all Users -->
                <x-navigation-link webRoute="dashboard">
                    {{ __('Dashboard') }}
                </x-navigation-link>

                <!-- Navigation Links only for Users -->
                @if (Auth::user()?->isUser())
                    <x-navigation-link webRoute="disciplines">
                        {{ __('Posten') }}
                    </x-navigation-link>
                @endif

                <x-navigation-link webRoute="gamechanger.index">
                    {{ __('Gamechanger') }}
                </x-navigation-link>

                <!-- Navigation for Operators and Admin -->
                @if (Auth::user()?->isOperator() || Auth::user()?->isAdmin())
                    <x-navigation-link webRoute="gamechanger_actions.create">
                        {{ __('Gamechanger Aktion') }}
                    </x-navigation-link>
                @endif

                <x-navigation-link webRoute="audit.gamechanger">
                    {{ __('Historie') }}
                </x-navigation-link>

                <!-- Navigation for Operators and Admin -->
                @if (Auth::user()?->isOperator() || Auth::user()?->isAdmin())
                    <x-navigation-link webRoute="audit.index">
                        {{ __('Audit') }}
                    </x-navigation-link>
                @endif

                @if (Auth::user()?->isUser())
                    <x-navigation-link webRoute="anleitung">
                        {{ __('Anleitung') }}
                    </x-navigation-link>
                @endif

                <!-- Navigation only for Admins -->
                @if (Auth::user()?->isAdmin())
                    <x-navigation-link webRoute="admin.index">
                        {{ __('Admin') }}
                    </x-navigation-link>
                @endif
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:ms-6 sm:flex sm:items-center">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none"
                        >
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg
                                    class="h-4 w-4 fill-current"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('anleitung')">
                            {{ __('Anleitung') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link
                                :href="route('logout')"
                                onclick="event.preventDefault();
                                                this.closest('form').submit();"
                            >
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button
                    @click="open = ! open"
                    class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 transition duration-150 ease-in-out hover:bg-gray-100 hover:text-gray-500 focus:bg-gray-100 focus:text-gray-500 focus:outline-none"
                >
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path
                            :class="{'hidden': open, 'inline-flex': ! open }"
                            class="inline-flex"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"
                        />
                        <path
                            :class="{'hidden': ! open, 'inline-flex': open }"
                            class="hidden"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"
                        />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="space-y-1 pb-3 pt-2">
            <x-responsive-nav-link :href="route('anleitung')">
                {{ __('Anleitung') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="border-t border-gray-200 pb-1 pt-4">
            <div class="px-4">
                <div class="text-base font-medium text-gray-800">{{ Auth::user()->name }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link
                        :href="route('logout')"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();"
                    >
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>

    <!-- copied from ChatGPT -->
    <x-navigation-bottom-link />
</nav>
