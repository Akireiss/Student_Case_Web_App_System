<?php

namespace App\Http\Livewire\Adviser;

use App\Models\Report;
use App\Models\Anecdotal;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Filters\Filter;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\{ActionButton, WithExport};
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridColumns};

final class ReportHistoryTable extends PowerGridComponent
{
    use ActionButton;
    use WithExport;

    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    */
    public function setUp(): array
    {
        return [
            Exportable::make('export')
            ->striped()
            ->type(Exportable::TYPE_CSV),
            Header::make()->includeViewOnTop('components.datatable')->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    /**
     * PowerGrid datasource.
     *
     * @return Builder<\App\Models\Report>
     */public function datasource(): Builder
    {
        $userId = auth()->user()->id;
        return Report::query()
            ->join('anecdotal', 'reports.anecdotal_id', '=', 'anecdotal.id')
            ->join('students', 'anecdotal.student_id', '=', 'students.id')
            ->where('reports.user_id', $userId)
            ->with('users')
            ->with('anecdotal')
            ->select(
            'reports.*',
            'reports.created_at',
            'students.first_name', 'students.last_name');
    }



    public function relationSearch(): array
    {
        return [
            'users' => ['name'],
            'anecdotal' => ['students.first_name', 'students.last_name']
        ];
    }

    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('users.name')
            ->addColumn('students.first_name', function (Report $model) {
                return $model->anecdotal->student->first_name . ' ' . $model->anecdotal->student->last_name;
            })
            ->addColumn('anecdotal.case_status', function (Report $model) {
                return $model->anecdotal->getStatusTextAttribute();
            })

            ->addColumn('reports.created_at')
            ->addColumn('created_at_formatted', fn(Report $model) => Carbon::parse($model->created_at)->format('F j, Y'));
    }

    public function columns(): array
    {
        return [
            Column::make('Reporter Name', 'users.name'),
            Column::make('Student Name', 'students.first_name')->sortable(),
            Column::make('Status', 'anecdotal.case_status'),
            Column::make('Created at', 'created_at_formatted', 'reports.created_at')->sortable(),
        ];
    }

    public function filters(): array
    {
        return [
            Filter::datetimepicker('created_at_formatted', 'reports.created_at'),
            Filter::select('anecdotal.case_status', 'anecdotal.case_status')
            ->dataSource(Anecdotal::codes())
            ->optionValue('case_status')
            ->optionLabel('label'),

        ];
    }



    public function actions(): array
    {
    $buttons = [];

    if (auth()->user()->role === 0) {
        $buttons[] = Button::make('view', 'View')
            ->class('bg-gray-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm inline-flex')
            ->route('user.report.view', function (\App\Models\Report $model) {
                return ['report' => $model->id];
            });

        $buttons[] = Button::make('edit', 'Edit')
            ->class('bg-gray-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm inline-flex')
            ->route('user.report.edit', function (\App\Models\Report $model) {
                return ['report' => $model->id];
            });

    }elseif (auth()->user()->role === 1) {
        $buttons[] = Button::make('view', 'View')
            ->class('bg-gray-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm inline-flex')
            ->route('admin.report.view', function (\App\Models\Report $model) {
                return ['report' => $model->id];
            });

        $buttons[] = Button::make('edit', 'Edit')
            ->class('bg-gray-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm inline-flex')
            ->route('admin.report.edit', function (\App\Models\Report $model) {
                return ['report' => $model->id];
            });
    } elseif (auth()->user()->role === 2) {
        $buttons[] = Button::make('view', 'View')
            ->class('bg-gray-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm inline-flex')
            ->route('report.view', function (\App\Models\Report $model) {
                return ['report' => $model->id];
            });

        $buttons[] = Button::make('edit', 'Edit')
            ->class('bg-gray-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm inline-flex')
            ->route('report.edit', function (\App\Models\Report $model) {
                return ['report' => $model->id];
            });
    }

    return $buttons;
    }

    public function actionRules(): array
    {
        return [
            Rule::button('edit')
                ->when(fn($report) => $report->anecdotal->case_status === 1 || $report->anecdotal->case_status === 2 || $report->anecdotal->case_status === 3 || $report->anecdotal->case_status === 4)
                ->hide(),
        ];
    }

}
