<?php

namespace App\Http\Livewire;

use App\Models\Offenses;
use App\Models\Students;
use App\Models\Anecdotal;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Responsive;
use PowerComponents\LivewirePowerGrid\Filters\Filter;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\{ActionButton, WithExport};
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridColumns};

final class AnecdotaTable extends PowerGridComponent
{
    use ActionButton;
    use WithExport;
    public bool $multiSort = true;
    // public bool $withSortStringNumber = true;
    // public string $sortField = 'anecdotal.id';
    public function setUp(): array
    {

        return [
            Responsive::make(),
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_CSV),
            Header::make()->showToggleColumns()->includeViewOnTop('components.datatable'),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(mode: 'full'),
        ];
    }
    public function datasource(): Builder
    {
        return Anecdotal::query()
            ->join('students', 'anecdotal.student_id', '=', 'students.id')
            ->join('offenses', 'anecdotal.offense_id', '=', 'offenses.id')
            ->select(
                'anecdotal.*',
                'anecdotal.id as AnecdotalID',
                'anecdotal.created_at',
                'students.created_at as created',
                'offenses.created_at as created_offense',
                'offenses.offenses',
                'offenses.id as OffenseID',
                'students.id as StudentID'
            );
    }



    public function relationSearch(): array
    {
        return [
            'students' => ['first_name', 'last_name'],
            'offenses' => ['offenses'],
        ];
    }

    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('students.first_name')
            ->addColumn('students.last_name')
            ->addColumn('full_name', function (Anecdotal $model) {
                return $model->students->first_name . ' ' . $model->students->last_name;
            })
            ->addColumn('students.grade_level')

            ->addColumn('offenses')

            ->addColumn('gravity', fn(Anecdotal $model) => ($model->gravityText))


            ->addColumn('anecdotal.created_at')
            ->addColumn('created_at_formatted', function (Anecdotal $model) {
                return Carbon::parse($model->created_at)->format('F j, Y');
            })

            ->addColumn('case_status', fn(Anecdotal $model) => $model->getStatusTextAttribute() ?? 'No Data');

    }

    public function columns(): array
    {
        return [
            // Column::make('First Name', 'students.first_name'),
            // Column::make('Last Name', 'students.last_name'),
            Column::make('Name', 'full_name')->searchable(),
            Column::make('Grade Level', 'grade_level', 'grade_level')->sortable(),
            Column::make('Offenses', 'offenses'),
            Column::make('Seriousness', 'gravity')->sortable()->searchable(),
            Column::make('Submitted at', 'created_at_formatted', 'anecdotal.created_at')->sortable(),
            Column::make('Status', 'case_status')->sortable()
        ];
    }


    public function filters(): array
    {

        return [
            Filter::inputText('full_name')
                ->operators(['contains'])
                ->builder(function (Builder $query, $value) {
                    $searchValue = is_array($value) ? $value['value'] : $value;
                    return $query->where(\DB::raw('CONCAT(first_name, " ", last_name)'), 'like', "%{$searchValue}%");
                }),
            Filter::inputText('students.first_name')->operators(['contains']),
            Filter::inputText('students.last_name')->operators(['contains']),
            Filter::datetimepicker('created_at_formatted', 'anecdotal.created_at')
                ->params([
                    'only_future' => false,
                ]),
            Filter::select('case_status', 'case_status')
                ->dataSource(Anecdotal::codes())
                ->optionValue('case_status')
                ->optionLabel('label'),

            Filter::select('gravity', 'gravity')
                ->dataSource(Anecdotal::gravityCodes())
                ->optionValue('gravity')
                ->optionLabel('label'),

            Filter::select('grade_level', 'grade_level')
                ->dataSource(Anecdotal::select('grade_level')->distinct()->get())
                ->optionValue('grade_level')
                ->optionLabel('grade_level'),


            Filter::select('offenses', 'category')
                ->dataSource(Offenses::categories())
                ->optionValue('category')
                ->optionLabel('label'),
        ];
    }


    public function actions(): array
    {
        return [

            Button::make('edit', 'Edit')
                ->class('bg-gray-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm inline-flex')
                ->route('anecdotal.edit', function (\App\Models\Anecdotal $model) {
                    return ['anecdotal' => $model->id];
                }),

            Button::make('view', 'View')
                ->class('bg-gray-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm inline-flex')
                ->route('anecdotal.view', function (\App\Models\Anecdotal $model) {
                    return ['anecdotal' => $model->id];
                }),
        ];
    }


}
