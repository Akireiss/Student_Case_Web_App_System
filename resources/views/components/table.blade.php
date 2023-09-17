<div {{ $attributes->merge(['class' => 'w-full overflow-hidden rounded-lg ring-1 ring-black ring-opacity-5 shadow-md ']) }}>
    <div class="w-full overflow-x-auto">
        <table class="w-full whitespace-no-wrap">
            <thead>
                <tr class="text-xs font-semibold tracking-wide text-left
                 text-gray-500 uppercase shadow-md
               bg-gray-50 dark:text-gray-400"
                >

                </tr>
            </thead>
            <tbody class="bg-white divide-y">
                <tr class="text-gray-700 dark:text-gray-400">

                {{ $slot }}
                </tr>
            </tbody>
        </table>
    </div>
</div>





