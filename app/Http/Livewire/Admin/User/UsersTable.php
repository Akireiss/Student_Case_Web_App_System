<?php

namespace App\Http\Livewire\Admin\User;

use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\{ActionButton, WithExport};
use PowerComponents\LivewirePowerGrid\Filters\Filter;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridColumns};

final class UsersTable extends PowerGridComponent
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
                ->type(Exportable::TYPE_CSV),
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }


    public function datasource(): Builder
    {
        return User::query();
    }

    public function relationSearch(): array
    {
        return [

        ];
    }


    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('name')

            ->addColumn('name_lower', fn (User $model) => strtolower(e($model->name)))

            ->addColumn('email')
            ->addColumn('role', fn (User $model) => $model->roleText)
            ->addColumn('classroom', function (User $model) {
                $gradeLevel = optional($model->classroom)->grade_level;
                $section = optional($model->classroom)->section;

                $classroomText = "";

                if ($gradeLevel !== null) {
                    $classroomText .= "Grade: " . $gradeLevel;
                }

                if ($section !== null) {
                    $classroomText .= ' ' . $section;
                }

                return $classroomText;
            })


            ->addColumn('status', fn(User $model) => $model->getStatusTextAttribute() ?? 'No Data');
    }


    public function columns(): array
    {
        return [
            Column::make('Name', 'name')
                ->sortable()->searchable(),

            Column::make('Email', 'email')
                ->sortable()->searchable(),
            Column::make('Role', 'role')->searchable(),
            Column::make('Clasroom', 'classroom')->searchable(),
            Column::make('Status', 'status')->sortable()->searchable()

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
            Filter::boolean('status')->label('Inactive', 'Active'),
               Filter::select('role', 'role')
                ->dataSource(User::codes())
                ->optionValue('role')
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
     * PowerGrid User Action Buttons.
     *
     * @return array<int, Button>
     */


    public function actions(): array
    {
       return [
           Button::make('edit', 'Edit')
               ->class('bg-gray-500 cursor-pointer text-white px-3 py-2  inline-flex
               m-1 rounded text-sm')
               ->route('user.edit', function(\App\Models\User $model) {
                    return ['userId' => $model->id];
               }),

        //    Button::make('destroy', 'Delete')
        //        ->class('bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
        //        ->route('user.destroy', function(\App\Models\User $model) {
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
     * PowerGrid User Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($user) => $user->id === 1)
                ->hide(),
        ];
    }
    */
}
