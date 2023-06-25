<div {{ $attributes->merge(['class' => 'mx-auto ']) }}>
    <div class="flex justify-between items-center ">
        <h6 class="text-xl font-bold px-4 text-left ">
            {{ $title }}
        </h6>
        <div class="ml-aut o">
            {{ $actions }}
        </div>
    </div>
    <div class="w-full mx-auto mt-6">
        <div class="relative flex flex-col min-w-0 py-4 break-words w-full mb-6 shadow-lg rounded-lg border-0 ">

            <div class="flex-auto px-6 lg:px-10 py-10 pt-0 ">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
