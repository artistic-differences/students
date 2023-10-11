<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Student::factory()->count(150)->create();

        $subjects = \App\Models\Subject::all();
        \App\Models\Student::all()->each(function ($user) use ($subjects) {
            $user->subjects()->attach(
                $subjects->random(rand(1, 3))->pluck('id')->toArray()
            );
        });
    }
}
