<div>
    <div x-data="{ showTable: true, showForm: false }">
        <div x-show="showTable">
            <div class="flex items-center justify-between my-6">
                <h6 class="text-lg font-semibold
                  text-gray-600 dark:text-gray-300 flex-shrink-0">
                    List Of Reports
                </h6>
                <div class="flex justify-end mt-4">
                    <x-button x-on:click="showTable = false; showForm = true">
                        Add
                    </x-button>
                </div>
            </div>
            <div>
                <livewire:anecdota-table />
            </div>
        </div>

        <div x-cloak x-show="showForm">

            <livewire:student.report />

        </div>
    </div>

</div>
