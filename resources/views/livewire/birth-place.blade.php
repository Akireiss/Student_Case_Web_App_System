<div>

    <h6 class="text-sm my-1 px-4 font-bold uppercase mt-3 text-gray-500">
        Place of Birth
    </h6>


    <x-grid columns="3" gap="4" px="0" mt="0">

        <div class="relative mb-3 px-4">
            <x-label>
                Province
            </x-label>
            <x-select class="form-control" id="city-select-birth" wire:model="selectedProvinceBirth">
                @foreach($provinces as $province)
                    <option value="{{ $province->id }}">{{ $province->province }}</option>
                @endforeach
            </x-select>
        </div>



        <div class="relative mb-3 px-4">
            <x-label>
                Municipality
            </x-label>
            <x-select class="form-control" id="municipality-select-birth" wire:model="selectedMunicipalityBirth">
                @foreach($municipalities as $municipality)
                    <option value="{{ $municipality->id }}">{{ $municipality->municipality }}</option>
                @endforeach
            </x-select>
        </div>


        <div class="relative mb-3 px-4">
            <x-label>
                Barangay
            </x-label>
            <x-select class="form-control" id="barangay-select-birth" wire:model="selectedBarangayBirth">
                @foreach($barangays as $barangay)
                    <option value="{{ $barangay->id }}">{{ $barangay->barangay }}</option>
                @endforeach
            </x-select>
        </div>


    </x-grid>
</div>
