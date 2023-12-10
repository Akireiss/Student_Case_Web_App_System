<?php

namespace App\Http\Livewire;

use DB;
use App\Models\Profile;
use App\Models\Classroom;
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
         //   Responsive::make(),
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_CSV),
            Header::make()->showSearchInput()->showToggleColumns(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return Profile::query()
            ->join('students', 'profile.student_id', '=', 'students.id')
            ->join('classrooms', 'students.classroom_id', '=', 'classrooms.id')
            ->join('barangay', 'profile.barangay_id', '=', 'barangay.id')
            ->join('municipal', 'profile.municipal_id', '=', 'municipal.id')
            ->select(
                'profile.*',
                'barangay.barangay as barangay',
                'municipal.municipality as municipal',
               // 'classrooms.section as classroom',
                 \DB::raw("CONCAT(classrooms.grade_level, ' ', classrooms.section) as classroom")
            );
    }

    public function relationSearch(): array
    {
        return [
            'barangay' => ['barangay'],
            'municipal' => ['municipality'],
            'student' => ['first_name', 'last_name', ],
            'students.classroom' => ['grade_level', 'section'],
        ];
    }

    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
        ->addColumn('students.first_name')
        ->addColumn('students.last_name')
        ->addColumn('full_name', function (Profile $model) {
            return $model->students->first_name . ' ' . $model->students->last_name;
        })
        ->addColumn('classroom', function (Profile $model) {
            return $model->students->classroom->grade_level . ' ' . $model->students->classroom->section;
        })

        //->addColumn('classroom')
            ->addColumn('sex')
            ->addColumn('sex_lower', fn (Profile $model) => strtolower(e($model->sex)))
            ->addColumn('contact')
            ->addColumn('barangay')
            ->addColumn('municipal');
          //  ->addColumn('status')
            //->addColumn('status', fn (Profile $model) => $model?->getStatusTextAttribute());
    }

    public function columns(): array
    {
        return [
            Column::make('Name', 'full_name')->searchable(),
             Column::make('Classroom', 'classroom'),
            Column::make('Sex', 'sex')
                ->sortable()
                ->searchable(),
            Column::make('Contact', 'contact')
                ->sortable()
                ->searchable(),
            Column::make('Barangay', 'barangay'),
            Column::make('Municipal', 'municipal'),
        ];
    }

    public function filters(): array
    {
        return [
            Filter::inputText('full_name')
            ->operators(['contains'])
            ->builder(function (Builder $query, $value) {
                $searchValue = is_array($value) ? $value['value'] : $value;
                return $query->where(DB::raw('CONCAT(first_name, " ", last_name)'), 'like', "%{$searchValue}%");
            }),

            Filter::inputText('classroom')
            ->operators(['contains'])
            ->builder(function (Builder $query, $value) {
                $searchValue = is_array($value) ? $value['value'] : $value;
                return $query->where(DB::raw('CONCAT(grade_level, " ", section)'), 'like', "%{$searchValue}%");
            }),

            // Filter::inputText('classroom')
            // ->operators(['contains'])
            // ->builder(function (Builder $query, $value) {
            //     $searchValue = is_array($value) ? $value['value'] : $value;
            //     return $query->where(function ($query) use ($searchValue) {
            //         $query->where(DB::raw('CONCAT("Grade: ", grade_level, " ", section)'), 'like', "%{$searchValue}%")
            //             ->orWhere('grade_level', 'like', "%{$searchValue}%");
            //     });

            // }),
            // Filter::select('classroom', 'classroom')
            // ->dataSource(Classroom::select('section')->distinct()->get())
            // ->optionValue('section')
            // ->optionLabel('section'),



            Filter::select('sex', 'sex')
                ->dataSource(Profile::select('sex')->distinct()->get())
                ->optionValue('sex')
                ->optionLabel('sex'),
                Filter::select('municipal', 'municipality')
                ->dataSource(Municipal::select('municipality')->distinct()->get())
                ->optionValue('municipality')
                ->optionLabel('municipality'),
            // Filter::select('status', 'profile.status')
            //     ->dataSource(Profile::codes())
            //     ->optionValue('status')
            //     ->optionLabel('label'),
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
