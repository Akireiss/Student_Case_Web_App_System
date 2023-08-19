<?php

namespace App\Http\Livewire;

use App\Models\Students;
use App\Models\Classroom;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Filters\Filter;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\{ActionButton, WithExport};
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridColumns};

final class StudentTable extends PowerGridComponent
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
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput(),
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
     * PowerGrid datasource.
     *
     * @return Builder<\App\Models\Students>
     */
    public function datasource(): Builder
    {
        return Students::query()
            ->join('classrooms', 'students.classroom_id', '=', 'classrooms.id')
            ->select(
                'students.*',
                'students.created_at',
                'students.status',
                'classrooms.grade_level as grade_level',
                'classrooms.section as section'
            )
            ->orderByDesc('students.created_at'); // Sort by the created_at column in descending order
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

            ->addColumn('first_name')

            /** Example of custom column using a closure **/
            ->addColumn('first_name_lower', fn(Students $model) => strtolower(e($model->first_name)))

            ->addColumn('last_name')

            ->addColumn('classroom', fn(Students $model) => "{$model->grade_level} - {$model->section}")

            ->addColumn('lrn', fn (Students $model) => $model->lrn ?: 'No Data')

            ->addColumn('students.status')
            ->addColumn('status', fn(Students $model) => $model?->getStatusTextAttribute())

            ->addColumn('students.created_at')
            ->addColumn('created_at_formatted', fn(Students $model) => Carbon::parse($model->created_at)->format('F j, Y'));
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
            Column::make('First name', 'first_name')
                ->sortable()
                ->searchable()
                ->editOnClick()
                ->withCount('Total Students', true, false),


            Column::make('Last name', 'last_name')
                ->sortable()
                ->editOnClick()
                ->searchable(),

            Column::make('Grade Level', 'grade_level')
                ->sortable(),

            Column::make('Section', 'section')
                ->sortable(),

            Column::make('Lrn', 'lrn')
                ->editOnClick()
                ->sortable(),


            Column::make('Status', 'status', 'students.status')
                ->sortable(),

            Column::make('Date Added', 'created_at_formatted', 'students.created_at')
                ->sortable(),

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
            Filter::datetimepicker('created_at_formatted', 'students.created_at'),
            Filter::select('grade_level', 'grade_level')
            ->dataSource(Classroom::select('grade_level')->distinct()->get())
            ->optionValue('grade_level')
            ->optionLabel('grade_level'),
            Filter::select('section', 'section')
            ->dataSource(Classroom::select('section')->distinct()->get())
            ->optionValue('section')
            ->optionLabel('section'),
            Filter::select('status', 'students.status')
            ->dataSource(Students::codes())
            ->optionValue('status')
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
     * PowerGrid Student Action Buttons.
     *
     * @return array<int, Button>
     */

    /*
    public function actions(): array
    {
       return [
           Button::make('edit', 'Edit')
               ->class('bg-indigo-500 cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm')
               ->route('student.edit', function(\App\Models\Admin\Student $model) {
                    return $model->id;
               }),

           Button::make('destroy', 'Delete')
               ->class('bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
               ->route('student.destroy', function(\App\Models\Admin\Student $model) {
                    return $model->id;
               })
               ->method('delete')
        ];
    }
    */

    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
    */

    /**
     * PowerGrid Student Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($student) => $student->id === 1)
                ->hide(),
        ];
    }
    */

    public array $first_name = [];
    public array $last_name = [];
    public array $lrn = [];


    protected array $rules = [
        'first_name.*' => ['required'],
        'last_name.*' => ['required'],
        'lrn.*' => ['integer'],
    ];

    public function onUpdatedEditable($id, $field, $value): void
    {
        $this->validate();
        Students::query()->find($id)->update([
            $field => $value,
        ]);
    }
}
