<div x-data="{ modal: false }">
    <button @click="modal = true"
        class="transition duration-300 ease-in-out bg-green-500 hover:bg-green-600 text-white text-sm tracking-wider px-4 py-2 rounded-sm">
        Modal
    </button>

    <div x-cloak
    class="fixed inset-0 z-10 flex flex-col items-center justify-end overflow-y-auto bg-gray-600 bg-opacity-50 sm:justify-start"
    x-data="{ modal: false }" x-show="modal" x-on:modal-overlay.window="if ($event.detail.id == 'modal-example') modal=true"
    x-transition:enter="transition ease-out duration-1000" x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-500"
    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
    <div class="w-full px-2 py-20 transition-all transform sm:max-w-2xl" role="dialog" aria-modal="true"


        aria-labelledby="modal-headline" x-show="modal" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 -translate-y-4 sm:translate-y-4"
        x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave=" ease-in duration-300"
        x-transition:leave-start="opacity-100 t"

        x-transition:leave-end="opacity-0" x-on:click.away="modal=false">
            <!-- MODAL CONTAINER -->
            <div
                class="relative flex flex-col w-full pointer-events-auto bg-white border border-gray-300 rounded-lg shadow-xl">
                <div class="flex items-start justify-between p-4 border-b border-gray-300 rounded-t">
                    <h5 class="mb-0 text-lg leading-normal">Awesome Modal</h5>
                    <button type="button" class="close" x-on:click="modal = false">&times;</button>
                </div>
                <div class="relative flex p-4">
                    {{ $slot }}
                </div>
                <div class="flex items-center justify-end p-4 border-t border-gray-300">
                    <button x-on:click="modal = false" type="button"
                        class="inline-block font-normal text-center px-3 py-2 leading-normal text-base rounded cursor-pointer text-white bg-gray-600 mr-2">Close</button>
                    <button type="button"
                        class="inline-block font-normal text-center px-3 py-2 leading-normal text-base rounded cursor-pointer text-white bg-blue-600">Save
                        changes</button>
                </div>
            </div>
        </div>
    </div>
</div>
