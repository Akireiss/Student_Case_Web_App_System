@include('layouts.header')


        <main class="">
            @yield('content')
        </main>
<x-footer/>/

    </div>


    @livewireScripts
    @stack('modals')
    @stack('scripts')
</body>
</html>
