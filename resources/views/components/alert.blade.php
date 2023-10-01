@if (session()->has('success'))
<span class="text-green-500 mx-4">
    {{ session('success') }}
</span>
@endif
