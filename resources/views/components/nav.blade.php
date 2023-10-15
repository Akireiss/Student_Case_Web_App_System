<nav x-data="accordion(6)"
    class="fixed top-0
flex flex-wrap items-center justify-between w-full
px-4 py-5 tracking-wide bg-white  md:px-8  ">
    <!-- Left nav -->
    <div class="flex items-center lg:px-44 text-gray-600 hover:text-gray-900   ">
        <a href="#" class="text-2xl font-bold text-green-500 ">
            CZCMNHS
        </a>
    </div>

    <div @click="handleClick()" x-data="{ open: false }" class="block text-gray-600 cursor-pointer md:hidden">
        <button @click="open = ! open" class="w-6 h-6 text-lg">
            <svg x-show="! open" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"
                :clas="{ 'transition-full each-in-out transform duration-500': !open }">
                <rect width="48" height="48" fill="white" fill-opacity="0.01"></rect>
                <path d="M7.94977 11.9498H39.9498" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round"></path>
                <path d="M7.94977 23.9498H39.9498" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round"></path>
                <path d="M7.94977 35.9498H39.9498" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round"></path>
            </svg>

            <svg x-show="open" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="feather feather-x">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
        </button>
    </div>

    <div x-ref="tab" :style="handleToggle()"
        class="relative w-full overflow-hidden transition-all duration-700 lg:hidden max-h-0">
        <div class="flex flex-col my-3 space-y-2 text-lg hover:font-b text-gray-600">

            @guest
            <a href="login" class="hover:text-gray-900"><span>Login</span></a>
            <hr>
            <a href="register" class="hover:text-gray-900"><span>Register</span></a>
            @endguest

            @auth
            @if (auth()->user()->role === 1)
                <a href="admin/dashboard" class="hover:text-gray-900"><span>Dashboard</span></a>
            @else
                <a href="adviser/dashboard" class="hover:text-gray-900"><span>Dashboard</span></a>
            @endif
        @endauth



        </div>
    </div>

    <div class="hidden w-full lg:flex lg:w-auto lg:px-44  ">
        <div class="items-center flex-1 justify-center text-md text-gray-500 lg:pt-0 list-reset lg:flex">
            @guest
            <div class="mr-3">

<a href="login"
class="inline-block px-4 no-underline font-semibold text-gray-700
hover:text-gray-700
hover:border-b hover:border-green-500">
Login
</a>

</div>

<div class="mr-3">
    <a href="register"
    class="inline-block px-4 no-underline font-semibold text-gray-700
    hover:text-gray-700
    hover:border-b hover:border-green-500">
    Register
</a>

            </div>
            @endguest


            @auth
            @if (auth()->user()->role === 1)


            <div class="mr-3">
                <a href="admin/dashboard"
                class="inline-block px-4 no-underline font-semibold text-gray-700
                hover:text-gray-700
                hover:border-b hover:border-green-500">
                Dashboard
            </a>
            </div>
            @else

            <div class="mr-3">
                <a href="adviser/dashboard"
                class="inline-block px-4 no-underline font-semibold text-gray-700
                hover:text-gray-700
                hover:border-b hover:border-green-500">
                Dashboard
            </a>
            </div>
            @endif
        @endauth


    </div>

</nav>


<script>
    document.addEventListener('alpine:init', () => {
        Alpine.store('accordion', {
            tab: 0
        });
        Alpine.data('accordion', (idx) => ({
            init() {
                this.idx = idx;
            },
            idx: -1,
            handleClick() {
                this.$store.accordion.tab = this.$store.accordion.tab === this.idx ? 0 : this.idx;
            },
            handleRotate() {
                return this.$store.accordion.tab === this.idx ? '-rotate-180' : '';
            },
            handleToggle() {
                return this.$store.accordion.tab === this.idx ?
                    `max-height: ${this.$refs.tab.scrollHeight}px` : '';
            }
        }));
    })
</script>
