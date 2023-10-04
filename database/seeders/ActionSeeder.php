<?php

namespace Database\Seeders;

use App\Models\Action;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $actions = [
            [
                'action_taken' => 'Conference with the student',
            ],
            [
                'action_taken' => 'Written explanation from the studnent',
            ],
            [
                'action_taken' => 'Administer approriate classroom based consequence',
            ],
            [
                'action_taken' => 'Reteach/ Reinforce expectations',
            ],
            [
                'action_taken' => 'Notify Parents',
            ],
            [
                'action_taken' => 'Document Action Taken',
            ],

        ];

        // Insert the data into the offenses table
        foreach ($actions as $action) {
            Action::create($action);
        }
    }
}
