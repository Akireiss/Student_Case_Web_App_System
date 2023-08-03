<div>

    <h6 class="text-xl font-bold px-4 text-left ">
        Student Profile
    </h6>
    <x-table>
        <x-slot name="header">
            <th class="px-4 py-3">First Name</th>
            <th class="px-4 py-3">Last Name</th>
            <th class="px-4 py-3">Gender</th>
            <th class="px-4 py-3">Address</th>
            <th class="px-4 py-3">Manage</th>
            </tr>
        </x-slot>
        @forelse ($studentProfile as $profile)
            <tr class="text-gray-700 dark:text-gray-400">

                <td class="px-4 py-2">{{ $profile->student->first_name }}</td>
                <td class="px-4 py-2">{{ $profile->student->last_name }}</td>
                <td class="px-4 py-2">{{ $profile->sex }}</td>
                <td class="px-4 py-2">
                    {{ $profile->municipal?->municipality ?? 'No Address'}},
                    {{ $profile->barangay?->barangay ?? 'No Address' }}
                </td>

                <td class="px-4 py-2">
                    <x-link href="{{ url('adviser/student-profile/' . $profile->id . '/view') }}">View</x-link>
                </td>
            </tr>
        @empty
            <tr class="text-gray-700 dark:text-gray-400">
                <td class="px-4 py-2">No Stundet Found</td>

            </tr>
        @endforelse
    </x-table>
    </table>
</div>
