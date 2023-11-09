@extends('layouts.dashboard.index')

@section('content')
    <div>

        <h6 class="text-left text-2xl text-black ">
            Guide Area
        </h6>



    <x-grid columns="2" gap="4" px="0" mt="0">
        <div class="min-w-0 p-4 shadow-md bg-white  ring-1 ring-black ring-opacity-5 ">
            <h4 class="mb-4 font-semibold text-gray-800 ">
                Total Number Of Offenses Use
            </h4>

      <canvas id="OffenseChart"></canvas>

            <div class="flex justify-center mt-4 space-x-3 text-lg text-gray-600 ">
                <div class="flex items-center">
                    <span class="inline-block w-3 h-3 mr-1 rounded-full"></span>

                </div>

            </div>
        </div>



    </x-grid>
    </div>


<script src="{{ asset('assets/js/chart.min.js') }}"></script>





@endsection
