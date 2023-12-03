<?php

namespace App\Http\Livewire;

use App\Models\Activity;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Responsive;
use PowerComponents\LivewirePowerGrid\Filters\Filter;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\{ActionButton, WithExport};
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridColumns};

final class ActivityTable extends PowerGridComponent
{
    use ActionButton;
    use WithExport;

    public function setUp(): array
    {
        return [
            // Responsive::make(),
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
        return Activity::query()
            ->join('users', 'activity_log.causer_id', '=', 'users.id')
            ->select('activity_log.*', 'users.name as causer_name',
            'activity_log.created_at',
            );
    }

    public function relationSearch(): array
    {
        return [
            'users' => ['name'],
        ];
    }

    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('causer_name', fn (Activity $model) => ucfirst($model->causer_name))
           // ->addColumn('log_name', fn (Activity $model) => ucfirst($model->log_name))
            //->addColumn('log_name_lower', fn (Activity $model) => ucfirst(e($model->log_name)))
            ->addColumn('description', fn (Activity $model) => ucfirst($model->description))
            ->addColumn('event', fn (Activity $model) => ucfirst($model->event))
            ->addColumn('activity_log.created_at')
            ->addColumn('created_at_formatted', fn (Activity $model) => Carbon::parse($model->created_at)->format('F j, Y'));
    }


    public function columns(): array
    {
        return [
            Column::make('Name', 'causer_name'),
            // Column::make('Activity', 'log_name')
            //     ->sortable()
            //     ->searchable(),
            Column::make('Description', 'description')
                ->sortable()
                ->searchable(),
            Column::make('Event', 'event')
                ->sortable()
                ->searchable(),
            Column::make('Created at', 'created_at_formatted', 'created_at')
                ->sortable(),
        ];
    }

    public function filters(): array
    {
        return [
            Filter::datetimepicker('created_at', 'activity_log.created_at'),
        ];
    }


    public function actions(): array
    {
        return [
            Button::make('view', 'View')
            ->class('bg-gray-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm inline-flex')
                ->route('activity.view', function (\App\Models\Activity $model) {
                    return ['activity' => $model->id];
                }),
        ];
    }
}
