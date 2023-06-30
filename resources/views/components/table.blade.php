<div {{ $attributes->merge(['class' => 'w-full overflow-hidden rounded-lg shadow-md']) }}>
    <div class="w-full overflow-x-auto">
        <table class="w-full whitespace-no-wrap">
            <thead>
                <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    {{ $header }}
                </tr>
            </thead>
            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                {{ $slot }}
            </tbody>
        </table>
    </div>
</div>





