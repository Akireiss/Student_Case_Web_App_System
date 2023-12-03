@props(['breadcrumbs' => []])

<ol class="flex items-center whitespace-nowrap px-2" aria-label="Breadcrumb">
    @foreach($breadcrumbs as $index => $breadcrumb)
        <li class="inline-flex items-center">
            <a class="flex items-center text-sm text-gray-500
             hover:text-gray-600 hover:underline focus:outline-none
                focus:text-blue-600 dark:focus:text-blue-500"
                href="{{ $breadcrumb['url'] }}">
                {{ $breadcrumb['slot'] ?? $breadcrumb['label'] }}
            </a>

            @if ($index < count($breadcrumbs) - 1)
                <svg class="flex-shrink-0 mx-2 overflow-visible h-4 w-4 text-gray-400 dark:text-neutral-600
                    dark:text-neutral-600"
                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m9 18 6-6-6-6"/>
                </svg>
            @endif
        </li>
    @endforeach
</ol>
