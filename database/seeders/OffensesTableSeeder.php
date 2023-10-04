<?php

namespace Database\Seeders;

use App\Models\Offenses;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OffensesTableSeeder extends Seeder
{
    public function run()
    {
        $offensesData = [
            [
                'offenses' => 'Cutting',
                'description' => 'Cutting classes',
                'category' => 0,
                // Minor
                'status' => 0,
            ],
            [
                'offenses' => 'Smoking',
                'description' => 'Smoking on school premises',
                'category' => 1,
                // Grave
                'status' => 0,
            ],
            [
                'offenses' => 'Cheating',
                'description' => 'Cheating on exams',
                'category' => 0,
                // Minor
                'status' => 0,
            ],
            [
                'offenses' => 'Bullying',
                'description' => 'Engaging in bullying behavior',
                'category' => 0,
                // Minor
                'status' => 0,
            ],
            [
                'offenses' => 'Vandalism',
                'description' => 'Vandalizing school property',
                'category' => 1,
                // Grave
                'status' => 0,
            ],
            [
                'offenses' => 'Tardiness',
                'description' => 'Frequent tardiness to classes',
                'category' => 0,
                // Minor
                'status' => 0,
            ],
            [
                'offenses' => 'Forgery',
                'description' => 'Forgery of documents',
                'category' => 1,
                // Grave
                'status' => 0,
            ],
            [
                'offenses' => 'Fighting',
                'description' => 'Engaging in physical fights',
                'category' => 1,
                // Grave
                'status' => 0,
            ],
            [
                'offenses' => 'Littering',
                'description' => 'Littering on school grounds',
                'category' => 1,
                // Grave
                'status' => 0,
            ],
            [
                'offenses' => 'Disruptive Behavior',
                'description' => 'Disruptive behavior in class',
                'category' => 1,
                // Grave
                'status' => 0,
            ],
            [
                'offenses' => 'Skipping School',
                'description' => 'Skipping school without permission',
                'category' => 0,
                // Minor
                'status' => 0,
            ],
            [
                'offenses' => 'Disrespecting Teachers',
                'description' => 'Disrespectful behavior towards teachers',
                'category' => 1,
                // Grave
                'status' => 0,
            ],
            [
                'offenses' => 'Graffiti',
                'description' => 'Creating graffiti on school property',
                'category' => 1,
                // Grave
                'status' => 0,
            ],
            [
                'offenses' => 'Using Profanity',
                'description' => 'Using offensive language in school',
                'category' => 0,
                // Minor
                'status' => 0,
            ],
            [
                'offenses' => 'Stealing',
                'description' => 'Stealing belongings of others',
                'category' => 0,
                // Minor
                'status' => 0,
            ],
            [
                'offenses' => 'Harassment',
                'description' => 'Engaging in harassment of students',
                'category' => 0,
                // Minor
                'status' => 0,
            ],
            [
                'offenses' => 'Dress Code Violation',
                'description' => 'Violating the school dress code',
                'category' => 0,
                // Minor
                'status' => 0,
            ],
            [
                'offenses' => 'Skipping Homework',
                'description' => 'Consistently failing to complete homework',
                'category' => 0,
                // Minor
                'status' => 0,
            ],
            [
                'offenses' => 'Insubordination',
                'description' => 'Refusing to follow school rules or directives',
                'category' => 1,
                // Grave
                'status' => 0,
            ],
            [
                'offenses' => 'Trespassing',
                'description' => 'Trespassing on restricted areas of school property',
                'category' => 1,
                // Grave
                'status' => 0,
            ],
            [
                'offenses' => 'Truancy',
                'description' => 'Repeatedly not attending school without a valid reason',
                'category' => 0,
                // Minor
                'status' => 0,
            ],
            [
                'offenses' => 'Disrupting Class',
                'description' => 'Interrupting the learning environment during class',
                'category' => 0,
                // Minor
                'status' => 0,
            ],
            [
                'offenses' => 'Defacing Property',
                'description' => 'Damaging or defacing school property',
                'category' => 1,
                // Grave
                'status' => 0,
            ],
            [
                'offenses' => 'Forgery',
                'description' => 'Forgery of documents',
                'category' => 1,
                // Grave
                'status' => 0,
            ],
            [
                'offenses' => 'Bullying Online',
                'description' => 'Engaging in online bullying or cyberbullying',
                'category' => 1,
                // Grave
                'status' => 0,
            ],
        ];


        // Insert the data into the offenses table
        foreach ($offensesData as $offense) {
            Offenses::create($offense);
        }
    }
}
