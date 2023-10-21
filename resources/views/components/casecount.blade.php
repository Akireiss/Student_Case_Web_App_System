@if ($studentName && $studentId)

@if (count($cases) > 0)
    @php
        $totalOffenses = 0;
        $totalPending = 0;
        $totalProcess = 0;
        $totalResolved = 0;
    @endphp
    @foreach ($cases as $case)
        @if ($case->offenses)
            @php
                $totalOffenses += 1;
                if ($case->case_status == '0') {
                    $totalPending += 1;
                } elseif ($case->case_status == '1') {
                    $totalProcess += 1;
                } elseif ($case->case_status == '2') {
                    $totalResolved += 1;
                }
            @endphp
        @endif
    @endforeach
    <span class="text-red-500 text-md  text-center mt-2">{{ $studentName }} has a total of {{ $totalOffenses }}
        offenses.
        {{ $totalPending }} Pending Cases, {{ $totalProcess }} Inprocess Cases, {{ $totalResolved }}
        Resolved Cases
    </span>
@else
    <span class="text-green-500 text-md text-center">
        No cases found for {{ $studentName }}
    </span>
@endif

@endif
