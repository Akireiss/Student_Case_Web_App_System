<div>

    @can('adviser-access')
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
            <div x-ref="panel" x-show="open" x-transition.origin.top.left
            x-on:click.outside="close($refs.button)" :id="$id('dropdown-button')"
            style="display: none;" class="absolute right-0 w-64 rounded-md bg-white shadow-md">
           <ul class="p-3 space-y-1 text-sm text-gray-700 dark:text-gray-200"
               aria-labelledby="dropdownHelperButton"
               style="max-height: 300px; overflow-y: auto;">
               <li>
                   <div>
                    @foreach($reports as $report)
                    <div class="flex p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                        <div class="ml-2 text-sm">
                            @if ($report->anecdotal->case_status === 1)
                                <div class="text-gray-800">Your Report to
                                    {{ $report->anecdotal->student->first_name }}
                                    {{ $report->anecdotal->student->last_name }} has been accepted
                                </div>
                            @elseif ($report->anecdotal->case_status === 2)
                                <div class="text-gray-800">Your Report to
                                    {{ $report->anecdotal->student->first_name }}
                                    {{ $report->anecdotal->student->last_name }} has been resolved
                                </div>
                            @else
                                <div class="text-gray-800">No Notification</div>
                            @endif
                            <div class="text-red-500 text-sm">
                                {{ $report->anecdotal->created_at->diffForHumans() }}
                            </div>
                        </div>
                    </div>
                @endforeach


                   </div>
               </li>
           </ul>
       </div>

        </div>

    </li>
@endcan

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
</div>


