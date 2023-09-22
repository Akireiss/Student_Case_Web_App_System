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
                'action_taken' => 'Anecdotal Collect',
            ],
            [
                'action_taken' => 'Parent Teacher Meeting',
            ],
            [
                'action_taken' => 'Office Guidance',
            ],
            [
                'action_taken' => 'Anecdotal Collect',
            ],

        ];

        // Insert the data into the offenses table
        foreach ($actions as $action) {
            Action::create($action);
        }
    }
}
