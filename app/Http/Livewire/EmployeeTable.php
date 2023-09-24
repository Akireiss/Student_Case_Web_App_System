<?php

namespace App\Http\Livewire;

use App\Models\Employee;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\{ActionButton, WithExport};
use PowerComponents\LivewirePowerGrid\Filters\Filter;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridColumns};

final class EmployeeTable extends PowerGridComponent
{
    use ActionButton;
    use WithExport;

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->includeViewOnTop('components.datatable'),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(mode: 'full')
        ];
    }

    public function datasource(): Builder
    {
        return Employee::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('employees')

            /** Example of custom column using a closure **/
            ->addColumn('employees_lower', fn(Employee $model) => strtolower(e($model->employees)))

            ->addColumn('refference_number')
            ->addColumn('status', fn(Employee $model) => $model?->getStatusTextAttribute() ?? 'No Data');

    }

    public function columns(): array
    {
        return [
            Column::make('Employees', 'employees')
                ->sortable()
                ->editOnClick()
                ->searchable(),

            Column::make('Refference number', 'refference_number')
                ->sortable()
                ->editOnClick(),

            Column::make('Status', 'status')
                ->sortable(),
        ];
    }

    public function filters(): array
    {
        return [
            Filter::inputText('employees')->operators(['contains']),
            Filter::inputText('refference_number')->operators(['contains']),
            Filter::boolean('status')->label('Inactive', 'Active'),
        ];
    }


    public array $employees = [];
    public array $refference_number = [];


    protected array $rules = [
        'employees.*' => ['required'],
        'refference_number.*' => ['required', 'integer', 'max:9999999999'],
    ];

    public function onUpdatedEditable($id, $field, $value): void
    {
        $this->validate();
        Employee::query()->find($id)->update([
            $field => $value,
        ]);
    }
    public function actions(): array
    {
       return [
        Button::make('edit', 'Edit')
        ->class('bg-gray-500 cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm')
        ->route('teacher.edit', function (Employee $model) {
            return ['employee' => $model->id];
        }),
        Button::make('view', 'View')
        ->class('bg-gray-500 cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm')
        ->route('teacher.view', function (Employee $model) {
            return ['employee' => $model->id];
        }),
        ];
    }


}
