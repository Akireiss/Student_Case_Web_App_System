<?php

namespace App\Http\Livewire\Admin\Student\FilteredStudentTable;

use App\Models\Students;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Route;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Responsive;
use PowerComponents\LivewirePowerGrid\Filters\Filter;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\{ActionButton, WithExport};
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridColumns};

final class ActiveStudentsTable extends PowerGridComponent
{
    use ActionButton;
    use WithExport;

    public function setUp(): array
    {

        return [
        //    Responsive::make(),
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_CSV),
            Header::make()->includeViewOnTop('components.datatable'),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(mode: 'full')
        ];
    }

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
            )->where('students.status', 0);
    }

    public function relationSearch(): array
    {
        return [

        ];
    }

    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()

            ->addColumn('first_name')

            /** Example of custom column using a closure **/
            ->addColumn('first_name_lower', fn(Students $model) => strtolower(e($model->first_name)))

            ->addColumn('last_name')
            ->addColumn('gender', fn(Students $model) => $model?->getGenderTextAttribute())

            ->addColumn('classroom', fn(Students $model) => "{$model->grade_level} - {$model->section}")


            ->addColumn('department', fn(Students $model) => $model?->getDepartmentTextAttribute())

            // ->addColumn('lrn', fn(Students $model) => $model->lrn ?: 'No Data')

            ->addColumn('students.status')
            ->addColumn('status', fn(Students $model) => $model?->getStatusTextAttribute())

            ->addColumn('students.created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('First name', 'first_name')
                ->sortable()
                ->withCount('Total Students', true, false)

                ->editOnClick(),


            Column::make('Last name', 'last_name')
                ->sortable()
                ->editOnClick()
                ->searchable(),

            Column::make('Gender', 'gender', 'students.gender'),

            Column::make('Grade Level', 'grade_level', 'students.grade_level'),


            Column::make('Section', 'section')
                ->sortable(),

                Column::make('Department', 'department', 'students.department')
                ->sortable(),


            // Column::make('Lrn', 'lrn')
            //     ->editOnClick()
            //     ->sortable(),


            Column::make('Status', 'status', 'students.status')
                ->sortable(),


        ];
    }


    public function filters(): array
    {
        return [
            Filter::inputText('first_name')->operators(['contains']),
            Filter::inputText('last_name')->operators(['contains']),

            Filter::select('status', 'students.status')
                ->dataSource(Students::codes())
                ->optionValue('status')
                ->optionLabel('label'),
            // Filter::select('gender', 'students.gender')
            //     ->dataSource(Students::codesGender())
            //     ->optionValue('gender')
            //     ->optionLabel('label'),
            Filter::select('department', 'students.department')
                ->dataSource(Students::codesDepartment())
                ->optionValue('department')
                ->optionLabel('label'),

                Filter::select('grade_level', 'grade_level')
                ->dataSource(Classroom::select('grade_level')->distinct()->get())
                ->optionValue('grade_level')
                ->optionLabel('grade_level'),
            Filter::select('section', 'section')
                ->dataSource(Classroom::select('section')->distinct()->get())
                ->optionValue('section')
                ->optionLabel('section'),


        ];
    }


    public function actions(): array
    {
        return [
            Button::make('edit', 'Edit')
                 ->class('bg-gray-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm inline-flex')
                ->route('student.edit', function (\App\Models\Students $model) {
                    return ['student' => $model->id];
                }),


            Button::make('view', 'View')
                 ->class('bg-gray-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm inline-flex')
                ->route('student.view', function (\App\Models\Students $model) {
                    return ['student' => $model->id];
                }),

            Button::make('pdf', 'Pdf')
                 ->class('bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm inline-flex')
                ->route('student.pdf', function (\App\Models\Students $model) {
                    return ['student' => $model->id];
                }),
        ];
    }
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
