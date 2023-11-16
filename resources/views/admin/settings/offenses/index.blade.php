@extends('layouts.dashboard.index')
@section('content')


<x-alert/>



<div x-data="{ showTable: true, showForm: false }">
    <div x-show="showTable">



<div class="flex items-center justify-between my-2">
    <h4 class="text-lg font-semibold text-gray-600 dark:text-gray-300 flex-shrink-0">
      {{-- Offenses --}}
    </h4>
    <div class="flex-grow flex justify-end">

    <x-button x-on:click="showTable = false; showForm = true">
                    Add
                </x-button>

    </div>
  </div>

    <div>
        <livewire:o-ffenses-table/>
    </div>


    </div>



    <div x-cloak x-show="showForm">
        <div class="flex justify-end">

            <x-button x-on:click="showForm = false; showTable = true">
                Back
            </x-button>
        </div>
    <div>
        <livewire:admin.offenses.add-offenses/>
    </div>



</div>
@endsection

