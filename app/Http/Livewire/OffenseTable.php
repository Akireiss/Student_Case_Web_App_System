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
        $this->showCheckBox();

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput(),
            Footer::make()
                ->showRecordCount(mode: 'full')
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
     * @return Builder<\App\Models\Offenses>
     */
    public function datasource(): Builder
    {
        return Offenses::query();
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
            ->addColumn('offenses')

            /** Example of custom column using a closure **/
            ->addColumn('offenses_lower', fn(Offenses $model) => strtolower(e($model->offenses)))

            ->addColumn('description', function (Offenses $model) {
                return Str::words(e($model->description), 8); //Gets the first 8 words
            })
            ->addColumn('status', function (Offenses $model) {
                return ($model->status ? 'Inactive' : 'Active');
              })
            ->addColumn('created_at_formatted', fn(Offenses $model) => Carbon::parse($model->created_at)->format('F j, Y'));
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


            Column::make('Status', 'status')
            ->toggleable($isToggleable, 'yes', 'no'),



            Column::make('Created at', 'created_at_formatted', 'created_at')
                ->sortable(),

        ];
    }

    public function onUpdatedToggleable(string $id, string $field, string $value): void
{
    Offenses::query()->find($id)->update([
        $field => $value,
    ]);
}

    /**
     * PowerGrid Filters.
     *
     * @return array<int, Filter>
     */
    public function filters(): array
    {
        return [
            Filter::inputText('description')->operators(['contains']),
            Filter::boolean('status')->label('Inactive', 'Active'),
            Filter::datetimepicker('created_at'),
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
     * PowerGrid Offenses Action Buttons.
     *
     * @return array<int, Button>
     */

    /*
    public function actions(): array
    {
       return [
           Button::make('edit', 'Edit')
               ->class('bg-indigo-500 cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm')
               ->route('offenses.edit', function(\App\Models\Offenses $model) {
                    return $model->id;
               }),

           Button::make('destroy', 'Delete')
               ->class('bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
               ->route('offenses.destroy', function(\App\Models\Offenses $model) {
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
     * PowerGrid Offenses Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($offenses) => $offenses->id === 1)
                ->hide(),
        ];
    }
    */
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
