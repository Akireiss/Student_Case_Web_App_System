<?php

namespace App\Http\Livewire;

use App\Models\Profile;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\{ActionButton, WithExport};
use PowerComponents\LivewirePowerGrid\Filters\Filter;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridColumns};

final class StudentProfileTable extends PowerGridComponent
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
     * @return Builder<\App\Models\Profile>
     */



public function datasource(): Builder
{
    return Profile::query()
        ->join('students', 'profile.student_id', '=', 'students.id')
        ->join('barangay', 'profile.barangay_id', '=', 'barangay.id')
        ->join('municipal', 'profile.municipal_id', '=', 'municipal.id')
        ->select(
            'profile.*',
            'students.first_name',
            'students.last_name',
            'barangay.barangay as barangay',
            'municipal.municipality as municipal'
        )->orderByDesc('profile.created_at');
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
        return [
            'barangay' => ['barangay'],
            'municipal' => ['municipality'],
            'student' => ['first_name', 'last_name'],
        ];
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
            ->addColumn('last_name')
            ->addColumn('sex')

           /** Example of custom column using a closure **/
            ->addColumn('sex_lower', fn (Profile $model) => strtolower(e($model->sex)))

            ->addColumn('contact')
            ->addColumn('barangay')
            ->addColumn('municipal')
            ->addColumn('status')
            ->addColumn('status', fn (Profile $model) =>$model?->getStatusTextAttribute()
        );
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
            Column::make('First Name', 'first_name')
            ->searchable()
            ->withCount('Total Students Profile', true, false)
            ->sortable(),
            Column::make('Last Name', 'last_name')
            ->sortable()
            ->searchable(),
            Column::make('Sex', 'sex')
                ->sortable()
                ->searchable(),

            Column::make('Contact', 'contact')
                ->sortable()
                ->searchable(),

            Column::make('Barangay', 'barangay'),
            Column::make('Municipal', 'municipal'),
            Column::make('Status', 'status')
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
            Filter::inputText('first_name')->operators(['contains']),
            Filter::inputText('last_name')->operators(['contains']),
            Filter::select('sex', 'sex')
            ->dataSource(Profile::select('sex')->distinct()->get())
            ->optionValue('sex')
            ->optionLabel('sex'),
            Filter::select('status', 'profile.status')
            ->dataSource(Profile::codes())
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
     * PowerGrid Profile Action Buttons.
     *
     * @return array<int, Button>
     */


    public function actions(): array
    {
       return [
           Button::make('edit', 'Edit')
               ->class('bg-gray-500 cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm')
               ->route('admin.profile.edit', function(\App\Models\Profile $model) {
                    return['profile' =>$model->id];
               }),

               Button::make('view', 'View')
               ->class('bg-gray-500 cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm')
               ->route('admin.profile.show', function(\App\Models\Profile $model) {
                    return['profile' =>$model->id];
               }),


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
     * PowerGrid Profile Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($profile) => $profile->id === 1)
                ->hide(),
        ];
    }
    */
}
