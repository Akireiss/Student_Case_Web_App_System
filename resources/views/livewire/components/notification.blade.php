<div>


    <li class="flex">



        <div x-data="{
            open: false,
            toggle() {
                if (this.open) {
                    return this.close()
                }

                this.$refs.button.focus()

                this.open = true
            },
            close(focusAfter) {
                if (!this.open) return

                this.open = false

                focusAfter && focusAfter.focus()
            }
        }" x-on:keydown.escape.prevent.stop="close($refs.button)"
            x-on:focusin.window="! $refs.panel.contains($event.target) && close()"
            x-id="['dropdown-button']" class="relative">
            <button x-ref="button" x-on:click="toggle()" :aria-expanded="open"
                :aria-controls="$id('dropdown-button')" type="button"
                class="relative align-middle">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0M3.124 7.5A8.969 8.969 0 015.292 3m13.416 0a8.969 8.969 0 012.168 4.5" />
                </svg>

                <span class="absolute top-0 right-0 h-2 w-2 bg-red-500 rounded-full"></span>
            </button>
            <div
    x-ref="panel"
    x-show="open"
    x-transition.origin.top.left
    x-on:click.outside="close($refs.button)"
    :id="$id('dropdown-button')"
    style="display: none;"
    class="absolute right-0 w-64 max-h-60 rounded-md bg-white shadow-md overflow-y-auto" id="overflow"
>
    @forelse($notifications->take(5) as $notification)
    <div class="p-2 text-sm hover:bg-gray-100">
        <p class="text-gray-800">{{ $notification->data['message'] }}</p>
        <a href="#" class="block mt-2 text-xs text-blue-500 hover:text-blue-700">
            Mark as read
        </a>
    </div>
    @if($loop->last)
    <a href="#" class="block p-2 text-xs text-blue-500 hover:text-blue-700">
        Mark all as read
    </a>
    @endif
    @empty
    <div class="p-2 text-sm">
        There are no new notifications
    </div>
    @endforelse
</div>



        </div>

    </li>


@push('scripts')

<script>
    document.addEventListener('livewire:load', function () {
        let pollInterval = @this.pollInterval;
        setInterval(function () {
            Livewire.emit('fetchReports');
        }, pollInterval);
    });
</script>

@endpush
<script>
    document.addEventListener("DOMContentLoaded", function () {
    const panel = document.querySelector("#overflow");

    panel.addEventListener("scroll", function () {
        panel.style.setProperty("--scroll-progress", panel.scrollTop / (panel.scrollHeight - panel.clientHeight));
    });
});

</script>
</div>

<style>
    #overflow {
        max-height: 240px; /* Set the maximum height for the scrollbar */
        overflow-y: auto; /* Enable the vertical scrollbar */

        scrollbar-width: thin;
        scrollbar-color: transparent transparent;

        /* Track styles */
        scrollbar-track-color: #F3F4F6;

        /* Thumb styles */
        scrollbar-face-color: #00bf4c;
        scrollbar-height: calc(100% - var(--scroll-progress) * 100%);
    }
</style>

