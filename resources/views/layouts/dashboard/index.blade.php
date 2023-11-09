@include('layouts.header')

<body>

    <div x-data="{ isSideMenuOpen: false }">
        <div x-show="isSideMenuOpen" x-transition:enter="transition ease-in-out duration-150"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in-out duration-150" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0" class="fixed inset-0 z-10 flex items-end sm:items-center sm:justify-center"
            @click="isSideMenuOpen = false" x-cloak></div>

        <div class="flex h-screen bg-gray-50 " :class="{ 'overflow-hidden': isSideMenuOpen }">
            <!-- Desktop sidebar -->

            @include('layouts.dashboard.sidebar')
            {{-- End of sidebar --}}
            <div class="flex flex-col flex-1 w-full">
                <header class="z-10 py-4 bg-white shadow-md ">
                    <div class="container flex items-center justify-between h-full px-6 mx-auto text-green-600 ">
                        <!-- Mobile hamburger -->


                        <button @click="isSideMenuOpen = !isSideMenuOpen"
                            class="p-1 mr-5 -ml-1 rounded-md md:hidden focus:outline-none focus:shadow-outline-purple"
                            x-cloak>
                            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>


                        <div>


                        </div>
                        <ul class="flex items-center flex-shrink-0 space-x-2">
                            @guest
                            @else
                                <livewire:components.notification :userId="auth()->user()->id" />
                            @endguest
                            {{-- @include('includes.notification') --}}
                            <li>

                                @guest
                                    <div
                                        class="text-sm font-semibold text-gray-700
                                hover:text-gray-700">
                                        Guest
                                    </div>
                                @else
                                <li class="relative">
                                    <!-- Button with dropdown trigger -->
                                    <x-dropdown>
                                        <x-slot name="trigger">
                                            <div class="flex justify-end my-2">
                                                <button type="button" class="flex items-center space-x-3">
                                                    {{ auth()->user()->name }}
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                                      </svg>

                                                </button>
                                            </div>

                                        </x-slot>
                                        <x-slot name="content">
                                            <div class="px-4 py-3 text-sm font-semibold text-gray-700
                                            hover:text-gray-700">
                                              <div> {{ auth()->user()->getRoleTextAttribute() }}</div>
                                              <div class="text-sm font-semibold text-gray-700
                                              hover:text-gray-700">
                                                  {{ auth()->user()->email }}
                                              </div>
                                            </div>
<hr>

                                            <ul class="text-sm font-semibold text-gray-700
                                                hover:text-gray-700">
                                                <li>
                                                    <a href="{{ url('admin/dashboard') }}" class="block px-4 py-2 text-sm font-semibold
                                                     text-gray-700 hover:text-green-500">
                                                        Dashboard
                                                    </a>
                                                </li>

                                                <li>
                                                    <a href="{{ url('admin/update-acc') }}"
                                                        class="block px-4 py-2  text-sm font-semibold text-gray-700
                                                    hover:text-green-500">Account</a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('admin/settings/report/history') }}"
                                                        class="block px-4 py-2
                                                text-sm font-semibold text-gray-700
                                            hover:text-green-500">Report
                                                        History</a>
                                                </li>
                                            </ul>
                                            <hr>
                                            <div class="py-2">

                                                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                                    @csrf
                                                    <button type="submit"
                                                    class="block  py-2  text-sm font-semibold text-gray-700
                                                    hover:text-green-500" >

                                                    <span class="ml-4">Log Out</span>
                                                </button>
                                                </form>



                                            </div>
                                        </x-slot>
                                    </x-dropdown>
                                </li>

                            @endguest


                            </li>

                        </ul>



                    </div>

                </header>
                <main class="h-full overflow-y-auto px-8 ">
                    <div class="mx-auto my-6">
                        @yield('content')
                        @include('components.footer')
                    </div>
                </main>
            </div>
        </div>



        @yield('script')
        @stack('modals')
        @stack('scripts')

        <script src="{{ asset('assets/js/charts-lines.js') }}" defer></script>
        <script src="{{ asset('assets/js/charts-pie.js') }}" defer></script>
        <script src="{{ asset('assets/js/actionspiechart.js ') }}" defer></script>
        <script src="{{ asset('assets/js/charts-bars.js') }}" defer></script>
        <script src="{{ asset('assets/js/chartPie.js') }}" defer></script>
        <script src="{{ asset('assets/js/focus-trap.js') }}" defer></script>
        <script src="{{ asset('assets/js/cards.js') }}" defer></script>
        <script src="{{ asset('assets/js/notification.js') }}" defer></script>
        <script src="{{ asset('assets/js/jquery-3.6.3.min.js') }}"></script>
        {{-- <script src="{{ asset('assets/js/chart.min.js') }}"></script> --}}
        <script src="{{ asset('assets/js/qrcode.js') }}"></script>
        <script src="{{ asset('assets/js/dropdown.js') }}"></script>
        <script src="{{ asset('assets/js/validation.js') }}"></script>
        {{-- Delayed Notification --}}
        <script src="{{ asset('assets/js/delayedNotif.js') }}"></script>

        {{-- Js --}}
        {{-- <script src="{{ asset('assets/js/barchart.min.js') }}"></script> --}}
        {{-- Temporary Script --}}
        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>--}}


        <script src="{{ asset('assets/js/multibar.js') }}"></script>



        @livewireScripts
        <script>
            const dropdownButton = document.getElementById('dropdown');
            const dropdownMenu = document.getElementById('dropdownArea');

            dropdownButton.addEventListener('click', function(event) {
                event.stopPropagation(); // Prevent the click event from propagating to the document
                if (dropdownMenu.classList.contains('hidden')) {
                    dropdownMenu.classList.remove('hidden');
                } else {
                    dropdownMenu.classList.add('hidden');
                }
            });

            document.addEventListener('click', function(event) {
                if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                    dropdownMenu.classList.add('hidden');
                }
            });
        </script>

</body>

</html>
