<?php

namespace Database\Seeders;

use App\Models\Offenses;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OffensesTableSeeder extends Seeder
{
    public function run()
    {
        // Define an array of offenses data to be inserted
        $offensesData = [
            [
                'offenses' => 'Cutting',
                'description' => 'Cutting classes',
                'category' => 1, // Random category (0 or 1)
                'status' => 1,
            ],
            [
                'offenses' => 'Smoking',
                'description' => 'Smoking on school premises',
                'category' => 0,
                'status' => 1,
            ],
            [
                'offenses' => 'Cheating',
                'description' => 'Cheating on exams',
                'category' => 1,
                'status' => 1,
            ],
            [
                'offenses' => 'Bullying',
                'description' => 'Engaging in bullying behavior',
                'category' => 0,
                'status' => 1,
            ],
            [
                'offenses' => 'Vandalism',
                'description' => 'Vandalizing school property',
                'category' => 1,
                'status' => 1,
            ],
            [
                'offenses' => 'Tardiness',
                'description' => 'Frequent tardiness to classes',
                'category' => 0,
                'status' => 1,
            ],
            [
                'offenses' => 'Forgery',
                'description' => 'Forgery of documents',
                'category' => 1,
                'status' => 1,
            ],
            [
                'offenses' => 'Fighting',
                'description' => 'Engaging in physical fights',
                'category' => 1,
                'status' => 1,
            ],
            [
                'offenses' => 'Littering',
                'description' => 'Littering on school grounds',
                'category' => 1,
                'status' => 1,
            ],
            [
                'offenses' => 'Disruptive Behavior',
                'description' => 'Disruptive behavior in class',
                'category' => 1,
                'status' => 1,
            ],
            // Add more offenses as needed to reach a minimum of 10
        ];

        // Insert the data into the offenses table
        foreach ($offensesData as $offense) {
            Offenses::create($offense);
        }
    }
}
