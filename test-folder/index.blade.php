@extends('layouts.dashboard.index')
@section('content')

<livewire:adviser.report/>

@endsection




<div x-data="{ rewards: @entangle('rewards') }">
    <div class="flex items-center justify-between mt-4 mx-4">
        <h6 class="text-sm font-bold uppercase">
            Name some of your Academic and Extra-Curricular Awards
        </h6>
        <div class="relative mb-3 px-4">
            <x-buttontype @click="rewards.push({ name: '', age: '' })">
                Add Award
            </x-buttontype>
            <x-buttontype @click="rewards.pop()">
                Remove
            </x-buttontype>
        </div>
    </div>

    <template x-for="(reward, index) in rewards" :key="index">
        <x-grid columns="2" gap="4" px="0" mt="0"
            x-show="index === 0 || rewards.length > 1">
            <div class="relative mb-3 px-4">
                <x-label>
                    Name of Award
                </x-label>
                <x-input x-model="reward.name" />

            </div>

            <div class="relative mb-3 px-4">
                <x-label>
                    Year Achieved
                </x-label>
                <x-input x-model="reward.year" type="number" />

            </div>
        </x-grid>
    </template>
</div>



<div x-data="{ rewards: @entangle('rewards') }">
    <div class="flex items-center justify-between mt-4 mx-4">
        <h6 class="text-sm font-bold uppercase">
            List down the names of Siblings that are studying at CZCMNHS?

        </h6>
        <div class="relative mb-3 px-4">
            <x-buttontype @click="rewards.push({ name: '', age: '', gradeSection: '' })">
                Add
            </x-buttontype>
            <x-buttontype @click="rewards.pop()">
                Remove
            </x-buttontype>
        </div>
    </div>

    <template x-for="(reward, index) in rewards" :key="index">
        <x-grid columns="2" gap="4" px="0" mt="0"
            x-show="index === 0 || rewards.length > 1">
            <div class="relative mb-3 px-4">
                <x-label>
                    Name of Award
                </x-label>
                <x-input x-model="reward.name" />

            </div>

            <div class="relative mb-3 px-4">
                <x-label>
                    Year Achieved
                </x-label>
                <x-input x-model="reward.year" type="number" />

            </div>
        </x-grid>
    </template>
</div>
