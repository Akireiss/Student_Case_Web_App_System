@extends('layouts.dashboard.index')
@section('content')

<x-alert/>
<div class="flex items-center justify-between my-6">
    <h4 class="text-lg font-semibold text-gray-600 dark:text-gray-300 flex-shrink-0">
Classrooms
    </h4>
    <div class="flex-grow flex justify-end">
        <x-link href="{{ url('admin/settings/classroom/create') }}">
        Add
        </x-link>
    </div>
  </div>

<div class="w-full overflow-hidden rounded-lg shadow-md">
<div class="w-full overflow-x-auto">
    <table class="w-full whitespace-no-wrap">
        <thead>
          <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
            <th class="px-4 py-3">Employee</th>
            <th class="px-4 py-3">Section</th>
            <th class="px-4 py-3">Grade Level</th>
            <th class="px-4 py-3">Status</th>
            <th class="px-4 py-3">Manage</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
          @foreach ($classrooms as $classroom)
            <tr class="text-gray-700 dark:text-gray-400">
              <td class="px-4 py-3">
                {{ $classroom->employee->employees }}
              </td>
              <td class="px-4 py-3 text-sm">
                {{ $classroom->section }}
              </td>
              <td class="px-4 py-3 text-sm">
                Grade: {{ $classroom->grade_level }}
              </td>
              <td class="px-4 py-3 text-xs">
                <span class="px-2 py-1 font-semibold leading-tight
                {{ $classroom->status == 0 ? 'text-green-700 bg-green-100' : 'text-red-700 bg-red-100' }}
                rounded-full dark:bg-green-700 dark:text-green-100">
                {{ $classroom->status == 0 ? 'Active' : 'Inactive' }}
            </span>

            </td>

              <td class="px-4 py-3">
                <div class="flex items-center space-x-4 text-sm">
                <button
                class="flex items-center justify-between px-1 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                aria-label="Edit"
              >
              <a href="{{ url('admin/settings/classrooms/' . $classroom->id . '/edit') }}">
                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                </svg>
            </a>

              </button>
              <button
                class="flex items-center justify-between px-1 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                aria-label="Delete"
              >
                <svg
                  class="w-5 h-5"
                  aria-hidden="true"
                  fill="currentColor"
                  viewBox="0 0 20 20"
                >
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 2c-4.97 0-9 4.03-9 9s4.03 9 9 9 9-4.03 9-9-4.03-9-9-9zm0 16c-3.87 0-7-3.13-7-7s3.13-7 7-7 7 3.13 7 7-3.13 7-7 7zm0-4a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                  </svg>



                </svg>
              </button>
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>

</div>

</div>



</div>
@endsection
