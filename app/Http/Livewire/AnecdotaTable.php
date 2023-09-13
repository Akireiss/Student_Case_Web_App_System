<?php

namespace App\Http\Livewire;

use App\Models\Offenses;
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

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_CSV),
            Header::make()->showSearchInput()->showToggleColumns(),
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
                'anecdotal.id as studentID',
                'anecdotal.created_at',
                'students.created_at as created',
                'offenses.created_at as created_offense',
                'offenses.offenses'
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
        ->addColumn('first_name', function (Anecdotal $model) {
            return $model->students->first_name . ' ' . $model->students->last_name;
        })
            // ->addColumn('last_name', function (Anecdotal $model) {
            //     return $model->students->last_name;
            // })

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
            Column::make('Full Name', 'first_name')->sortable()
                ->withCount('Total Reports', true, false),
            // Column::make('Last Name', 'last_name')->sortable(),
            Column::make('Offenses', 'offenses'),
            Column::make('Seriousness', 'gravity')->sortable()->searchable(),
            Column::make('Submitted at', 'created_at_formatted', 'anecdotal.created_at')->sortable(),
            Column::make('Status', 'case_status')->sortable()
        ];
    }


    public function filters(): array
    {

        return [
            // Filter::inputText('first_name')->operators(['contains']),
            // Filter::inputText('last_name')->operators(['contains']),
            Filter::datetimepicker('created_at_formatted', 'anecdotal.created_at')
                ->params([
                    'only_future' => false,
                    'no_weekends' => true,
                ]),
            Filter::select('case_status', 'case_status')
                ->dataSource(Anecdotal::codes())
                ->optionValue('case_status')
                ->optionLabel('label'),

            Filter::select('gravity', 'gravity')
                ->dataSource(Anecdotal::gravityCodes())
                ->optionValue('gravity')
                ->optionLabel('label'),


        Filter::select('offenses', 'category')
        ->dataSource(Offenses::categories())
        ->optionValue('category')
        ->optionLabel('label'),
];
    }


    public function actions(): array
    {
        return [
            Button::make('view', 'View')
                ->class('bg-gray-500 cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm')
                ->route('anecdotal.view', function (\App\Models\Anecdotal $model) {
                    return ['anecdotal' => $model->id];
                }),
            Button::make('edit', 'Edit')
                ->class('bg-gray-500 cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm')
                ->route('anecdotal.edit', function (\App\Models\Anecdotal $model) {
                    return ['anecdotal' => $model->id];
                }),
        ];
    }

}
