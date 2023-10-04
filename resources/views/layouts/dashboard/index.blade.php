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
                <header class="z-10 py-4 bg-white shadow-md dark:bg-gray-700">
                    <div
                        class="container flex items-center justify-between h-full px-6 mx-auto text-green-600 dark:text-green-300">
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


                        <div class="flex justify-center flex-1 lg:mr-32">
                            <div class="relative w-full max-w-xl mr-6 focus-within:text-purple-500">
                                {{-- Data Here --}}
                            </div>
                        </div>
                        <ul class="flex items-center flex-shrink-0 space-x-2">
                            <livewire:components.notification :userId="auth()->user()->id" />

                            @can('admin-access')
                            <div class="relative" x-data="{ open: false }">
                                <button  id="dropdownInformationButton"
                                 @click="open = !open" type="button"
                                 class="text-gray-500 group p-2 inline-flex items-center rounded-md text-base
                                  font-medium hover:text-gray-900" aria-expanded="false">

                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                                      </svg>

                                </button>

                                <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="absolute z-full mt-3 w-64 max-w-md -translate-x-1/2 transform px-2 sm:px-0">

                                    <div x-show="open"
                                     @click.away="open = false"
                                     x-transition:enter="transition ease-out duration-200"
                                     x-transition:enter-start="opacity-0 scale-95"
                                     x-transition:enter-end="opacity-100 scale-100"
                                     x-transition:leave="transition ease-in duration-200"
                                     x-transition:leave-start="opacity-100 scale-100"
                                     x-transition:leave-end="opacity-0 scale-95"
                                     class="absolute z-full mt-3 w-80  max-w-md
                                     -translate-x-1/2 transform px-2 sm:px-0">
                                        <div class="overflow-hidden  rounded-lg
                                        shadow-lg ring-1 ring-black ring-opacity-5">
                                            <div id="dropdownInformation" class="relative overflow-y-auto h-60
                                            grid gap-1 bg-white px-2 py-4 sm:p-6

                                            ">
                                                {{-- <div  >

                                                </div> --}}

                                        </div>

                                    </div>
                                </div>
                            </div>
                            </div>


                            @endcan
                            <li>

                                <li class="relative">
                                    <!-- Button with dropdown trigger -->
                                    <button id="dropdown" data-dropdown-toggle="dropdownInformation"
                                     class="inline-flex items-center focus:ring-0" type="button">
                                        {{ auth()->user()->name }}
                                        <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                                        </svg>
                                      </button>


                                    <div id="dropdownArea" class="hidden absolute top-11 left-0 z-10 bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                                      <div class="px-4 py-3 text-sm text-black">
                                        <div> {{ auth()->user()->getRoleTextAttribute() }}</div>
                                        <div class="font-medium truncate">
                                            {{ auth()->user()->email }}
                                        </div>
                                      </div>
                                      <ul class="text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownInformationButton">
                                        <li>
                                          <a href="{{ url('admin/dashboard') }}" class="block px-4 py-2  text-black">Dashboard</a>
                                        </li>
                                        <li>
                                          <a href="{{ url('admin/update-acc') }}" class="block px-4 py-2  text-black">Account</a>
                                        </li>
                                        <li>
                                          <a href="{{ url('admin/settings/report/history') }}" class="block px-4 py-2
                                           text-black">Report History</a>
                                        </li>
                                      </ul>
                                      <div class="py-2">
                                        <a href="#" class="block px-4 py-2 text-sm text-black">Sign out</a>
                                      </div>
                                    </div>
                                  </li>



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
        <script src="{{ asset('assets/js/chart.min.js') }}"></script>
        <script src="{{ asset('assets/js/qrcode.js') }}"></script>



        @livewireScripts
<script>
            const dropdownButton = document.getElementById('dropdown');
            const dropdownMenu = document.getElementById('dropdownArea');

            dropdownButton.addEventListener('click', function (event) {
              event.stopPropagation(); // Prevent the click event from propagating to the document
              if (dropdownMenu.classList.contains('hidden')) {
                dropdownMenu.classList.remove('hidden');
              } else {
                dropdownMenu.classList.add('hidden');
              }
            });

            document.addEventListener('click', function (event) {
              if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                dropdownMenu.classList.add('hidden');
              }
            });
          </script>

</body>

</html>
