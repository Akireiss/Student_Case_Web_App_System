<?php

namespace App\Http\Livewire;

use App\Models\Offenses;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Filters\Filter;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\{ActionButton, WithExport};
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridColumns};

final class OffenseTable extends PowerGridComponent
{
    use ActionButton;
    use WithExport;

    public array $description = [];
    public array $offenses = [];
    public array $status = [];

    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
    public function setUp(): array
    {

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make(),
            Footer::make()
                ->showRecordCount(mode: 'full')
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return Offenses::query();
    }

    public function relationSearch(): array
    {
        return [];
    }


    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('offenses')

            /** Example of custom column using a closure **/
            ->addColumn('offenses_lower', fn(Offenses $model) => strtolower(e($model->offenses)))

            ->addColumn('description', function (Offenses $model) {
                return Str::words(e($model->description), 8); //Gets the first 8 words
            })
            ->addColumn('status', function (Offenses $model) {
                return ($model->status ? 'Inactive' : 'Active');
            });
    }


    public function columns(): array
    {
        $isToggleable = true;
        return [
            Column::make('Offenses', 'offenses')
                ->sortable()
                ->searchable()
                ->editOnClick(),


            Column::make('Description', 'description')
                ->sortable()
                ->searchable()
                ->editOnClick(),


            Column::make('Status', 'status'),

        ];
    }

    public function onUpdatedToggleable(string $id, string $field, string $value): void
    {
        Offenses::query()->find($id)->update([
            $field => $value,
        ]);
    }


    public function filters(): array
    {
        return [
            Filter::inputText('description')->operators(['contains']),
            Filter::boolean('status')->label('Inactive', 'Active'),
        ];
    }


    public function actions(): array
    {
       return [
        Button::make('edit', 'Edit')
        ->class('bg-gray-500 cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm')
        ->route('admin.offense.edit', function (Offenses $model) {
            return ['offense' => $model->id];
        }),

        Button::make('view', 'View')
        ->class('bg-gray-500 cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm')
        ->route('admin.offense.view', function (Offenses $model) {
            return ['offense' => $model->id];
        }),

        ];
    }

    protected array $rules = [
        'description.*' => ['required'],
        'offenses.*' => ['required'],
        'status.*' => ['required'],
    ];
    public function onUpdatedEditable($id, $field, $value): void
    {
        $this->validate();
        Offenses::query()->find($id)->update([
            $field => $value,
        ]);
    }
}
