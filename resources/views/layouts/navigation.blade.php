<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex justify-between w-full">
                <!-- Logo -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <div class="flex items-center flex-shrink-0">
                        <a href="{{ route('homes.top') }}">
                            <x-application-logo class="block w-auto h-10 text-gray-600 fill-current" />
                        </a>
                    </div>
                    <x-nav-link :href="route('discord-servers.index')" :active="request()->routeIs('discord-servers.index')">
                        Discordサーバ
                    </x-nav-link>
                    <x-nav-link :href="route('boards.board')" :active="request()->routeIs('boards.board')">
                        掲示板
                    </x-nav-link>
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        授業評価
                    </x-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    @if (Auth::check())
                    <form action="{{ route('logout') }}" method="POST" class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        @csrf
                        <x-nav-link :href="route('logout')" onclick="event.preventDefault();
                        this.closest('form').submit();">
                            Logout
                        </x-nav-link>
                    </form>
                    @else
                    <x-nav-link :href="route('login')" :active="request()->routeIs('login')">
                        Login
                    </x-nav-link>
                    @endif
                </div>
                <!-- Hamburger -->
                <div class="flex items-center -mr-2 sm:hidden">
                    <button @click="open = ! open" class="inline-flex items-center justify-center p-2 text-gray-400 transition duration-150 ease-in-out rounded-md hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500">
                        <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link :href="route('discord-servers.index')" :active="route('discord-servers.index')">
                    Discordサーバ
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    掲示板
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    授業評価
                </x-responsive-nav-link>
                @if (Auth::check())
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        Logout
                    </x-responsive-nav-link>
                </form>
                @else
                <x-responsive-nav-link :href="route('login')" :active="request()->routeIs('login')">
                    Login
                </x-responsive-nav-link>
                @endif
            </div>
        </div>
</nav>