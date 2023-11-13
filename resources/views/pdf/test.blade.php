{{ $anecdotals->count() }}
<table>
    <tr>
        <th width="30%">Grade Levels:</th>
        <th width="28.5%">Total Male Cases:</th>
        <th width="25%">Total Female Cases:</th>
    </tr>
    @foreach ($classrooms as $classroom)
    <tr>
        <td>{{ $classroom->grade_level }}</td>
        <td>{{ $totalMaleCasesForClassroom[$classroom->id] }}</td>
        <td>{{ $totalFemaleCasesForClassroom[$classroom->id] }}</td>
    </tr>
    @endforeach
</table>
