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
            Header::make()->showSearchInput(),
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
            ->addColumn('status', fn(Employee $model) => $model?->getStatusTextAttribute() ?? 'No Data')

            ->addColumn('created_at_formatted', fn(Employee $model) => Carbon::parse($model->created_at)->format('F j, Y'));
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

            Column::make('Date Added', 'created_at_formatted', 'created_at')
                ->sortable(),

        ];
    }

    public function filters(): array
    {
        return [
            Filter::inputText('employees')->operators(['contains']),
            Filter::boolean('status')->label('Inactive', 'Active'),
            Filter::datetimepicker('created_at'),
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
}
