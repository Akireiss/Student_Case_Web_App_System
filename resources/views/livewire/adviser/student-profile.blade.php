<div>

    <h6 class="text-xl font-bold px-4 text-left ">
        Recent Cases
    </h6>
    <x-table>
        <x-slot name="header">
                <th>Student Full Name</th>
                <th>Short Description</th>
            </tr>
        </x-slot>
            @forelse ($studentProfile as $profile)
            <tr class="text-gray-700 dark:text-gray-400">
                <td class="px-4 py-2">{{ $profile->student->first_name }}
                    {{ $profile->student->last_name }}</td>
                <td class="px-4 py-2">{{ $profile->sex }}</td>
                </tr>

                @empty
                <tr class="text-gray-700 dark:text-gray-400">
                <td class="px-4 py-2">No Stundet Found</td>

                </tr>
                @endforelse
        </x-table>
    </table>
</div>
