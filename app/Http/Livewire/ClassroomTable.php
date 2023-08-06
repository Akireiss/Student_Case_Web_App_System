<?php

namespace App\Http\Livewire;

use App\Models\Classroom;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\{ActionButton, WithExport};
use PowerComponents\LivewirePowerGrid\Filters\Filter;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridColumns};

final class ClassroomTable extends PowerGridComponent
{
    use ActionButton;
    use WithExport;

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
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
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
     * PowerGrid datasource.
     *
     * @return Builder<\App\Models\Classroom>
     */
    public function datasource(): Builder
    {
        return Classroom::query()
            ->join('employees', 'classrooms.employee_id', '=', 'employees.id')
            ->select(
                'classrooms.*',
                'employees.employees as employee_name',
                'employees.status as employee_status'
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
        return [];
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
            ->addColumn('employee_name')
            ->addColumn('section')

           /** Example of custom column using a closure **/
           ->addColumn('grade_level')
            ->addColumn('section_lower', fn (Classroom $model) => strtolower(e($model->section)))

            ->addColumn('status', fn (Classroom $model) => $model?->getStatusTextAttribute() ?? 'No Data');
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
            Column::make('Adviser', 'employee_name')
            ->sortable(),


            Column::make('Grade level', 'grade_level')
                ->sortable()
                ->searchable()
                ->editOnClick(),


                Column::make('Section', 'section')
                ->sortable()
                ->searchable()
                ->editOnClick(),


            Column::make('Status', 'status')
                ->sortable()
                ->searchable(),


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
     * PowerGrid Classroom Action Buttons.
     *
     * @return array<int, Button>
     */


    public function actions(): array
    {
       return [
           Button::make('edit', 'Edit')
               ->class('bg-indigo-500 cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm')
               ->route('classroom.edit', function(\App\Models\Classroom $model) {
                    return ['classroom' =>$model->id];
               }),

                 /*
           Button::make('destroy', 'Delete')
               ->class('bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
               ->route('classroom.destroy', function(\App\Models\Classroom $model) {
                    return $model->id;
               })
               ->method('delete')
            */
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
     * PowerGrid Classroom Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($classroom) => $classroom->id === 1)
                ->hide(),
        ];
    }
    */

    public array $grade_level = [];
    public array $section = [];


    protected array $rules = [
        'grade_level.*' => ['required'],
        'section.*' => ['required'],
    ];

    public function onUpdatedEditable($id, $field, $value): void
    {
        $this->validate();
        Classroom::query()->find($id)->update([
            $field => $value,
        ]);
    }
}
