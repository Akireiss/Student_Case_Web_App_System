<?php

namespace App\Http\Livewire\Adviser;

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

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showToggleColumns(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(mode: 'full')
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
        $classroomId = auth()->user()->classroom_id;
        return Profile::whereHas('student', function ($query) use ($classroomId) {
            $query->where('classroom_id', $classroomId);
        })
        ->join('students', 'profile.student_id', '=', 'students.id')
        ->select('profile.*', 'students.first_name',
        'students.last_name',
    );
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
            ->addColumn('status', fn(Profile $model) => $model?->getStatusTextAttribute());

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
            ->sortable(),

                Column::make('Last Name', 'last_name')
                ->sortable(),
            Column::make('Sex', 'sex')
                ->sortable()
                ->searchable(),

            Column::make('Contact', 'contact')
                ->sortable()
                ->searchable(),

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
           Button::make('view', 'View')
                 ->class('bg-gray-500 cursor-pointer text-white px-3 py-1 m-1 rounded text-sm')
               ->route('adviser.profile.view', function(\App\Models\Profile $model) {
                    return  ['profile' => $model->id];
               }),

               Button::make('edit', 'Edit')
                 ->class('bg-gray-500 cursor-pointer text-white px-3 py-1 m-1 rounded text-sm')
               ->route('adviser.profile.edit', function(\App\Models\Profile $model) {
                    return  ['profile' => $model->id];
               }),

               Button::make('pdf', 'Pdf')
               ->class('bg-red-500 cursor-pointer text-white px-3 py-1 m-1 rounded text-sm')
             ->route('admin.generate-pdf', function(\App\Models\Profile $model) {
                  return  ['profile' => $model->id];
             }),

        ];
    }



    public function actionRules(): array
    {
       return [
            Rule::button('edit')
                ->when(fn($profile) => $profile->id === 1)
                ->hide(),
        ];
    }

}
