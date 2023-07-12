<?php

namespace App\Http\Livewire;

use App\Models\Anecdotal;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\{ActionButton, WithExport};
use PowerComponents\LivewirePowerGrid\Filters\Filter;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridColumns};

final class AnecdotaTable extends PowerGridComponent
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
     * @return Builder<\App\Models\Anecdotal>
     */
    public function datasource(): Builder
    {
        return Anecdotal::query();
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
            ->addColumn('student_name', fn (Anecdotal $model) => $model->student->first_name.' '.$model->student->last_name)
            ->addColumn('grave_offense', fn (Anecdotal $model) => optional($model->Graveoffenses)->offenses)
            ->addColumn('minor_offense', fn (Anecdotal $model) => optional($model->Minoroffenses)->offenses)
            ->addColumn('gravity_lower', fn (Anecdotal $model) => strtolower(e($model->gravity)))
            ->addColumn('created_at_formatted', fn (Anecdotal $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'))

            ->addColumn('status', function (Anecdotal $model) {
                $statusText = $model->status_text;
                $textColorClass = $model->status === 2 ? 'text-red-500' : '';

                return "<span class='$textColorClass'>$statusText</span>";
            });
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
              Column::make('Student Name', 'student_name'),
              Column::make('Grave Offense', 'grave_offense'),
              Column::make('Minor Offense', 'minor_offense'),
              Column::make('Seriousness', 'gravity')
                  ->sortable()
                  ->searchable(),

              Column::make('Created at', 'created_at_formatted', 'created_at')
                  ->sortable(),
                Column::make('Status', 'status')
                ->sortable()

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
            Filter::inputText('gravity')->operators(['contains']),
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
     * PowerGrid Anecdotal Action Buttons.
     *
     * @return array<int, Button>
     */

    /*
    public function actions(): array
    {
       return [
           Button::make('edit', 'Edit')
               ->class('bg-indigo-500 cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm')
               ->route('anecdotal.edit', function(\App\Models\Anecdotal $model) {
                    return $model->id;
               }),

           Button::make('destroy', 'Delete')
               ->class('bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
               ->route('anecdotal.destroy', function(\App\Models\Anecdotal $model) {
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
