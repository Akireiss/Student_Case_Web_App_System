@if (session()->has('message'))
<div x-data="{ showMessage: @if(session()->has('message')) true @else false @endif }"
    x-init="if (showMessage) setTimeout(() => { showMessage = false }, 3000)"
    x-show="showMessage"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 transform translate-y-2"
    x-transition:enter-end="opacity-100 transform translate-y-0"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 transform translate-y-0"
    x-transition:leave-end="opacity-0 transform translate-y-2"
    style="position: fixed; top: 1rem; right: 1rem; z-index: 50;"
    class="border-l-4 border-green-800 bg-green-400 text-white px-6 py-2 shadow-md rounded"
    role="alert"
>
   <p>{{ session('message') }}</p>
</div>

@endif



