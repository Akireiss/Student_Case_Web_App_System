<div>

    <div class="p-4">
        <div class="mb-4">
            <button class="bg-blue-500 text-white py-2 px-4 rounded" wire:click="addInput">Add Input</button>
        </div>
        @foreach ($inputs as $index => $input)
            <div class="mb-4 p-2 border border-gray-300 rounded-lg">
                <input type="text" wire:model="inputs.{{ $index }}.name" placeholder="Name" class="w-1/3 p-2 border rounded">
                <input type="text" wire:model="inputs.{{ $index }}.age" placeholder="Age" class="w-1/3 p-2 border rounded">
                <input type="text" wire:model="inputs.{{ $index }}.grade_section" placeholder="Grade/Section" class="w-1/3 p-2 border rounded">
                <button class="bg-red-500 text-white py-2 px-4 rounded" wire:click="removeInput({{ $index }})">Remove</button>
            </div>
        @endforeach
    </div>




    <div class="p-4">
        <div class="mb-4">
            <button class="bg-blue-500 text-white py-2 px-4 rounded" wire:click="addAward">Add Award</button>
        </div>
        @foreach ($awards as $index => $award)
            <div class="mb-4 p-2 border border-gray-300 rounded-lg">
                <input type="text" wire:model="awards.{{ $index }}.award_name" placeholder="Award Name" class="w-1/2 p-2 border rounded">
                <input type="text" wire:model="awards.{{ $index }}.award_year" placeholder="Award Year" class="w-1/2 p-2 border rounded">
                <button class="bg-red-500 text-white py-2 px-4 rounded" wire:click="removeAward({{ $index }})">Remove</button>
            </div>
        @endforeach
    </div>

</div>
