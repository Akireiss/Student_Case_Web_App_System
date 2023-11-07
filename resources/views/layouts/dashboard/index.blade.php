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
                    <div
                        class="container flex items-center justify-between h-full px-6 mx-auto text-green-600 ">
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


                        <div >


                        </div>
                        <ul class="flex items-center flex-shrink-0 space-x-2">
                            @guest
                            @else
                            <livewire:components.notification :userId="auth()->user()->id" />
                                @endguest
                                {{-- @include('includes.notification') --}}
                            <li>

                                @guest
                                <div class="text-sm font-semibold text-gray-700
                                hover:text-gray-700">
                                Guest
                                </div>
                                @else

                                <li class="relative">
                                    <!-- Button with dropdown trigger -->
                                    <button id="dropdown" data-dropdown-toggle="dropdownInformation"
                                     class="inline-flex items-center focus:ring-0" type="button">

                                        {{ auth()->user()->name }}
                                        <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                                        </svg>
                                      </button>


                                    <div id="dropdownArea" class="hidden absolute top-11 left-0 z-10 bg-white divide-y divide-gray-100
                                     rounded-lg shadow w-44  dark:divide-gray-600">
                                      <div class="px-4 py-3 text-sm font-semibold text-gray-700
                                      hover:text-gray-700">
                                        <div> {{ auth()->user()->getRoleTextAttribute() }}</div>
                                        <div class="text-sm font-semibold text-gray-700
                                        hover:text-gray-700">
                                            {{ auth()->user()->email }}
                                        </div>
                                      </div>
                                      <ul class="text-sm font-semibold text-gray-700
                                      hover:text-gray-700" aria-labelledby="dropdownInformationButton">
                                        <li>
                                          <a href="{{ url('admin/dashboard') }}" class="block px-4 py-2  text-sm font-semibold text-gray-700
                                      hover:text-gray-700">Dashboard</a>
                                        </li>
                                        <li>
                                          <a href="{{ url('admin/update-acc') }}" class="block px-4 py-2  text-sm font-semibold text-gray-700
                                      hover:text-gray-700">Account</a>
                                        </li>
                                        <li>
                                          <a href="{{ url('admin/settings/report/history') }}" class="block px-4 py-2
                                           text-sm font-semibold text-gray-700
                                      hover:text-gray-700">Report History</a>
                                        </li>
                                      </ul>
                                      <div class="py-2">
                                        <a href="#" class="block px-4 py-2  text-sm font-semibold text-gray-700
                                      hover:text-gray-700">Sign out</a>
                                      </div>
                                    </div>
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
        {{-- <script src="{{ asset('assets/js/charts-bars.js') }}" defer></script> --}}
        <script src="{{ asset('assets/js/chartPie.js') }}" defer></script>
        <script src="{{ asset('assets/js/focus-trap.js') }}" defer></script>
        <script src="{{ asset('assets/js/cards.js') }}" defer></script>
        <script src="{{ asset('assets/js/notification.js') }}" defer></script>
        <script src="{{ asset('assets/js/jquery-3.6.3.min.js') }}"></script>
        <script src="{{ asset('assets/js/chart.min.js') }}"></script>
        <script src="{{ asset('assets/js/qrcode.js') }}"></script>
        <script src="{{ asset('assets/js/dropdown.js') }}"></script>
        <script src="{{ asset('assets/js/validation.js') }}"></script>
        {{-- <script src="{{ asset('assets/js/gradeBar.js') }}"></script> --}}
        {{-- <script src="{{ asset('assets/js/gradeChart.js') }}"></script> --}}
        <script src="{{ asset('assets/js/multibar.js') }}"></script>



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
