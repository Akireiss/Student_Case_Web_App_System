<?php

namespace App\Http\Livewire;

use App\Models\Offenses;
use App\Models\Anecdotal;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Filters\Filter;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\{ActionButton, WithExport};
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridColumns};

final class AnecdotaTable extends PowerGridComponent
{
    use ActionButton;
    use WithExport;

///! REMIDER:THE FUCKING BUGGGGG IS THE NULLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLL FIX THAT
    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
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
                ->showRecordCount(mode: 'full')
        ];
    }

    /*
    |--------------------------------------------------------------------------
    |  Datasource
    |--------------------------------------------------------------------------
    | Provides data to your Table using a Model or Collection
    |
    */

    /**
     * PowerGrid datasource
     *
     * @return Builder<\App\Models\Anecdotal>
     */
    public function datasource(): Builder
    {
        return Anecdotal::query()
            ->join('students', 'anecdotal.student_id', '=', 'students.id')
            ->join('offenses', 'anecdotal.grave_offense_id', '=', 'offenses.id')
            ->select('anecdotal.*',
            'anecdotal.created_at',
            'students.created_at as created',
            'offenses.created_at as created_offense',
        );
    }

    /*
    |--------------------------------------------------------------------------
    |  Relationship Search
    |--------------------------------------------------------------------------
    | Configure here relationships to be used by the Search and Table Filters.
    |
    */

    /**
     * Relationship search.
     *
     * @return array<string, array<int, string>>
     */
    public function relationSearch(): array
    {
        // !important part for the relation
        return [
            'students' => ['first_name', 'last_name'],
            // 'Minoroffenses' => ['offenses'],
            // 'Graveoffenses' => ['offenses'],
        ];
    }

    /*
    |--------------------------------------------------------------------------
    |  Add Column
    |--------------------------------------------------------------------------
    | Make Datasource fields available to be used as columns.
    | You can pass a closure to transform/modify the data.
    |
    | ❗ IMPORTANT: When using closures, you must escape any value coming from
    |    the database using the `e()` Laravel Helper function.
    |
    */
    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('first_name', function (Anecdotal $model) {
                return $model->students->first_name;
            })
            ->addColumn('last_name', function (Anecdotal $model) {
                return $model->students->last_name;
            })

            // ->addColumn('grave_offense', fn(Anecdotal $model) => $model->Graveoffenses ? $model->Graveoffenses->offenses : 'No Data')
            // ->addColumn('minor_offense', fn(Anecdotal $model) => $model->Minoroffenses ? $model->Minoroffenses->offenses : 'No Data')

            ->addColumn('gravity', fn(Anecdotal $model) => ($model->gravityText))


            ->addColumn('anecdotal.created_at')
            ->addColumn('created_at_formatted', function (Anecdotal $model) {
                return Carbon::parse($model->created_at)->format('F j, Y');
            })

            ->addColumn('case_status', fn (Anecdotal $model) => $model->getStatusTextAttribute() ?? 'No Data');



    }



    /*
    |--------------------------------------------------------------------------
    |  Include Columns
    |--------------------------------------------------------------------------
    | Include the columns added columns, making them visible on the Table.
    | Each column can be configured with properties, filters, actions...
    |
    */

    /**
     * PowerGrid Columns.
     *
     * @return array<int, Column>
     */
    public function columns(): array
    {
        return [
            Column::make('First Name', 'first_name')->sortable()
            ->withCount('Total Reports', true, false),
            Column::make('Last Name', 'last_name')->sortable(), // New column for last name
           // Column::make('Grave Offense', 'grave_offense'),
            //Column::make('Minor Offense', 'minor_offense'),
            Column::make('Seriousness', 'gravity')->sortable()->searchable(),
            Column::make('Submitted at', 'created_at_formatted', 'anecdotal.created_at')->sortable(),
            Column::make('Status', 'case_status')->sortable()
        ];
    }

    /**
     * PowerGrid Filters.
     *
     * @return array<int, Filter>
     */


    public function filters(): array
    {

        return [
            Filter::inputText('first_name')->operators(['contains']),
            Filter::inputText('last_name')->operators(['contains']),
            Filter::datetimepicker('created_at_formatted', 'anecdotal.created_at')
            ->params(['only_future' => false,
            'no_weekends' => true,]),
            Filter::select('case_status', 'case_status')
                ->dataSource(Anecdotal::codes())
                ->optionValue('case_status')
                ->optionLabel('label'),

        Filter::select('gravity', 'gravity')
        ->dataSource(Anecdotal::gravityCodes())
        ->optionValue('gravity')
        ->optionLabel('label'),
];
    }


    /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    | Enable the method below only if the Routes below are defined in your app.
    |
    */

    /**
     * PowerGrid Anecdotal Action Buttons.
     *
     * @return array<int, Button>
     */


    public function actions(): array
    {
        return [
            Button::make('view', 'View')
                ->class('bg-indigo-500 cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm')
                ->route('anecdotal.edit', function (\App\Models\Anecdotal $model) {
                    return ['anecdotal' => $model->id];
                }),

            //    Button::make('destroy', 'Delete')
            //        ->class('bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
            //        ->route('anecdotal.destroy', function(\App\Models\Anecdotal $model) {
            //             return $model->id;
            //        })
            //        ->method('delete')
        ];
    }


    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
    */

    /**
     * PowerGrid Anecdotal Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($anecdotal) => $anecdotal->id === 1)
                ->hide(),
        ];
    }
    */
}
