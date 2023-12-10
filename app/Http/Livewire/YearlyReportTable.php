<?php

namespace App\Http\Livewire;

use App\Models\YearlyReport;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Responsive;
use PowerComponents\LivewirePowerGrid\Filters\Filter;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\{ActionButton, WithExport};
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridColumns};

final class YearlyReportTable extends PowerGridComponent
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
        return [
          //  Responsive::make(),
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make(),
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
     * @return Builder<\App\Models\YearlyReport>
     */
    public function datasource(): Builder
    {
        return YearlyReport::query()->latest();
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
            ->addColumn('data')
            ->addColumn('category')

           /** Example of custom column using a closure **/
            ->addColumn('category_lower', fn (YearlyReport $model) => strtolower(e($model->category)))

            ->addColumn('school_year')
            ->addColumn('type', fn(YearlyReport $model) => $model->getTypeTextAttribute() ?? 'No Data')
            ->addColumn('created_at_formatted', function (YearlyReport $model) {
                return Carbon::parse($model->created_at)->format('F j, Y');
            });
    }

    public function columns(): array
    {
        return [

            Column::make('Category', 'category')
                ->sortable()
                ->searchable(),

            Column::make('School year', 'school_year')
                ->sortable()
                ->searchable(),

            Column::make('Type', 'type'),
            Column::make('Created at', 'created_at_formatted', 'created_at')
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

            Filter::select('category', 'category')
            ->dataSource(YearlyReport::select('category')->distinct()->get())
            ->optionValue('category')
            ->optionLabel('category'),
            Filter::select('school_year', 'school_year')
            ->dataSource(YearlyReport::select('school_year')->distinct()->get())
            ->optionValue('school_year')
            ->optionLabel('school_year'),


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
     * PowerGrid YearlyReport Action Buttons.
     *
     * @return array<int, Button>
     */


    public function actions(): array
    {
       return [
           Button::make('view', 'View')
           ->class('bg-gray-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm inline-flex')
               ->route('yearly-report.view', function(\App\Models\YearlyReport $model) {
                    return ['yearlyReport' => $model->id];
               }),

        //    Button::make('destroy', 'Delete')
        //        ->class('bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
        //        ->route('yearly-report.destroy', function(\App\Models\YearlyReport $model) {
        //             return $model->id;
        //        })
        //        ->method('delete')
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
     * PowerGrid YearlyReport Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($yearly-report) => $yearly-report->id === 1)
                ->hide(),
        ];
    }
    */
}
