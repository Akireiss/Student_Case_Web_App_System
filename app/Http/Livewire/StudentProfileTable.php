<?php

namespace App\Http\Livewire;

use App\Models\Profile;
use App\Models\Municipal;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Responsive;
use PowerComponents\LivewirePowerGrid\Filters\Filter;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\{ActionButton, WithExport};
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridColumns};

final class StudentProfileTable extends PowerGridComponent
{
    use ActionButton;
    use WithExport;

    public function setUp(): array
    {

        return [
            Responsive::make(),
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_CSV),
            Header::make()->showSearchInput()->showToggleColumns()->includeViewOnTop('components.datatable'),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

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
            );
    }

    public function relationSearch(): array
    {
        return [
            'barangay' => ['barangay'],
            'municipal' => ['municipality'],
            'student' => ['first_name', 'last_name'],
        ];
    }

    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('first_name')
            ->addColumn('last_name')
            ->addColumn('sex')
            ->addColumn('sex_lower', fn (Profile $model) => strtolower(e($model->sex)))
            ->addColumn('contact')
            ->addColumn('barangay')
            ->addColumn('municipal')
            ->addColumn('status')
            ->addColumn('status', fn (Profile $model) => $model?->getStatusTextAttribute());
    }

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

    public function filters(): array
    {
        return [
            Filter::inputText('first_name')->operators(['contains']),
            Filter::inputText('last_name')->operators(['contains']),
            Filter::select('sex', 'sex')
                ->dataSource(Profile::select('sex')->distinct()->get())
                ->optionValue('sex')
                ->optionLabel('sex'),
                Filter::select('municipal', 'municipality')
                ->dataSource(Municipal::select('municipality')->distinct()->get())
                ->optionValue('municipality')
                ->optionLabel('municipality'),
            Filter::select('status', 'profile.status')
                ->dataSource(Profile::codes())
                ->optionValue('status')
                ->optionLabel('label'),
        ];
    }

    public function actions(): array
    {
        return [
            Button::make('edit', 'Edit')
                 ->class('bg-gray-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm inline-flex')
                ->route('admin.profile.edit', function(\App\Models\Profile $model) {
                    return ['profile' => $model->id];
                }),
            Button::make('view', 'View')
                 ->class('bg-gray-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm inline-flex')
                ->route('admin.profile.show', function(\App\Models\Profile $model) {
                    return ['profile' => $model->id];
                }),

            Button::make('pdf', 'Pdf')
            ->class('bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm inline-flex')
               ->route('admin.generate-pdf', function(\App\Models\Profile $model) {
                   return ['profile' => $model->id];
               }),
        ];
    }
}
