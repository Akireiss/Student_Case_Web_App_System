@if ($errors->has('studentId'))
<!-- Inside your Livewire component's view -->
<div x-data="{ showError: @entangle('showError') }"
     x-cloak
     x-show.transition.duration.300ms="showError"
     x-on:livewire:load.window="setTimeout(() => { showError = false }, 3000)"
     x-on:livewire:response.window="showError = false"
     x-on:click.away="showError = false"
     class="fixed top-4 right-4 z-50 px-6 py-3 bg-red-500 text-white rounded-lg shadow-md"
     role="alert"
>
    <p>{{ $errors->first('studentId') }}</p>
</div>

@endif
