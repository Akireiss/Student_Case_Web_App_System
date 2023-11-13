{{ $anecdotals->count() }}
<table>
    <tr>
        <th width="30%">Grade Levels:</th>
        <th width="28.5%">Total Male Cases:</th>
        <th width="25%">Total Female Cases:</th>
    </tr>
    @foreach ($classroomsHS as $classroom)
        <tr>
            <td>{{ $classroom->first_letter }}</td>
            <td>{{ $totalMaleCasesHS[$classroom->first_letter] }}</td>
            <td>{{ $totalFemaleCasesHS[$classroom->first_letter] }}</td>
        </tr>
    @endforeach
</table>
