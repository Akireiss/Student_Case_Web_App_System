<nav x-data="{ isOpen: false }" class="relative bg-white">
    <div class="container px-6 py-4 mx-auto">
        <div class="lg:flex lg:items-center lg:justify-between">
            <div class="flex items-center justify-between">
                <div class="text-xl font-semibold text-gray-700">
                    <a class="text-2xl font-bold transition-colors duration-300 transform text-green-400 lg:text-3xl dark:hover:text-green-500"
                        href="{{ url('/') }}">CZCMNHS</a>
                </div>
                <!-- Mobile menu button -->
                <div class="flex lg:hidden">
                    <button x-cloak @click="isOpen = !isOpen" type="button"
                        class="text-gray-500 dark:text-gray-200 hover:text-gray-600 dark:hover:text-gray-400 focus:outline-none focus:text-gray-600 dark:focus:text-gray-400"
                        aria-label="toggle menu">
                        <svg x-show="!isOpen" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 8h16M4 16h16" />
                        </svg>

                        <svg x-show="isOpen" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu open: "block", Menu closed: "hidden" -->
            <div x-cloak :class="[isOpen ? 'translate-x-0 opacity-100 ' : 'opacity-0 -translate-x-full']"
                class="absolute inset-x-0 z-20 w-full px-6 py-4 transition-all duration-300 ease-in-out lg:mt-0 lg:p-0 lg:top-0 lg:relative lg:bg-transparent lg:w-auto lg:opacity-100 lg:translate-x-0 lg:flex lg:items-center">
                <div class="flex flex-col -mx-6 lg:flex-row lg:items-center lg:mx-8">



                        <a href="{{ url('dashboard') }}"
                            class=" {{ request()->is('dashboard')
                                ? 'px-2 py-y mt-2 transition-colors duration-300
                                                transform rounded-full lg:mt-0 text-black
                                                hover:bg-green-600 hover:text-white bg-green-500'
                                : '' }}
                    hover:bg-green-500
                    px-3 py-2  mt-2 transition-colors duration-300 transform rounded-full
                    lg:mt-0 text-black  hover:text-white">
                            Dashboard
                        </a>

                    @guest
                        @if (Route::has('login'))
                            <a href="{{ url('login') }}"
                                class=" {{ request()->is('login')
                                    ? 'px-3 py-2 mx-2 mt-2 transition-colors duration-300 transform rounded-full
                                                        lg:mt-0 text-gray-500 hover:bg-green-60 '
                                    : '' }} mx-6 hover:
                        px-3 py-2  mt-2 transition-colors duration-300 transform rounded-full
                        lg:mt-0 text-gray-500
                        ">
                                Login</a>
                        @endif
                        @if (Route::has('register'))
                            <a href="{{ url('register') }}"
                                class=" {{ request()->is('register')
                                    ? 'px-2 py-y mt-2 transition-colors duration-300 transform rounded-full lg:mt-0 text-gray-500
                                                    '
                                    : '' }}
                    px-3 py-2  mt-2 transition-colors duration-300 transform rounded-full
                    lg:mt-0 text-gray-500">
                                Register</a>
                        @endif
                    @else
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open"
                                class="inline-flex items-center justify-center px-3 py-2 mx-3 mt-2 transition-colors duration-300 transform rounded-full lg:mt-0 text-black hover:bg-gray-100 dark:hover:bg-green-500 hover:text-white">
                                <span>{{ Auth::user()->name }}</span>
                                <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                    fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M10.293 14.293a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L10 11.586l3.293-3.293a1 1 0 011.414 1.414l-4 4z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>

                            <div x-show="open" @click.away="open = false"
                                class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                                role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                                <div class="py-1" role="none">

                                    <a href="{{ url('dashboard') }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900"
                                        role="menuitem">Dashboard</a>


                                    <a href=""
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900"
                                        role="menuitem">Manage Account</a>
                                    <a class="block px-4 py-2 text-sm text-red-700 hover:bg-red-100 hover:text-red-900"
                                        role="menuitem" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">Log
                                        Out</a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endguest

                </div>
            </div>
        </div>
    </div>
</nav>
