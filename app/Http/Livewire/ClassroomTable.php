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



    public function datasource(): Builder
    {
        return Classroom::query()
            ->join('employees', 'classrooms.employee_id', '=', 'employees.id')
            ->with('employees')
            ->select(
                'classrooms.id',
                'classrooms.created_at',
            );
    }




    public function relationSearch(): array
    {
        return [];
    }

    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('employee_name')
            ->addColumn('section')
            ->addColumn('grade_level')
            ->addColumn('section_lower', fn(Classroom $model) => strtolower(e($model->section)))
            ->addColumn('status', fn(Classroom $model) => $model?->getStatusTextAttribute() ?? 'No Data');
    }

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

    public function filters(): array
    {
        return [];
    }

    public function actions(): array
    {
        return [
            Button::make('edit', 'Edit')
                ->class('bg-gray-500 cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm')
                ->route('classroom.edit', function (Classroom $model) {
                    return ['classroom' => $model->id];
                }),
            Button::make('view', 'View')
                ->class('bg-gray-500 cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm')
                ->route('classroom.view', function (Classroom $model) {
                    return ['classroom' => $model->id];
                }),
        ];
    }

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
