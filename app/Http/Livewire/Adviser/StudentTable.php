<?php

namespace App\Http\Livewire\Adviser;

use App\Models\Students;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\{ActionButton, WithExport};
use PowerComponents\LivewirePowerGrid\Filters\Filter;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridColumns};

final class StudentTable extends PowerGridComponent
{
    use ActionButton;
    use WithExport;

    public function setUp(): array
    {

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_CSV),
            Header::make(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }


    public function datasource(): Builder
    {
        $classroomId = auth()->user()->classroom_id;

        return Students::where('classroom_id', $classroomId);
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
            ->addColumn('first_name_lower', fn (Students $model) => strtolower(e($model->first_name)))

            ->addColumn('last_name')
            ->addColumn('lrn')
            ->addColumn('status', fn(Students $model) => $model?->getStatusTextAttribute());
    }

    public function columns(): array
    {
        return [
            Column::make('First name', 'first_name')
                ->sortable()
                ->editOnClick()
                ->searchable(),


            Column::make('Last name', 'last_name')
                ->sortable()
                ->editOnClick()
                ->searchable(),

            Column::make('Lrn', 'lrn')
                ->sortable()
                ->searchable()
                ->editOnClick(),


            Column::make('Status', 'status')

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
        ];
    }


    public $first_name;
    public $last_name;
    public $lrn;
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


    public function actions(): array
    {
       return [
           Button::make('edit', 'Edit')
             ->class('bg-gray-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm inline-flex')
               ->route('adviser.students.edit', function(\App\Models\Students $model) {
                    return ['student' => $model->id];
               }),
            Button::make('view', 'View')
             ->class('bg-gray-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm inline-flex')
               ->route('adviser.students.view', function(\App\Models\Students $model) {
                    return ['student' => $model->id];
               }),
        ];
    }


}
