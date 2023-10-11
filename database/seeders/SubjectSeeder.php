<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('subjects')
            ->insert([
                'name' => 'Chemistry',
                'code' => 'CHEM',
            ]);
        DB::table('subjects')
            ->insert([
                'name' => 'Physics',
                'code' => 'PHY',
            ]);
        DB::table('subjects')
            ->insert([
                'name' => 'Biology',
                'code' => 'BIO',
            ]);
        DB::table('subjects')
            ->insert([
                'name' => 'Mathematics',
                'code' => 'MATH',
            ]);
        DB::table('subjects')
            ->insert([
                'name' => 'Further Mathematics',
                'code' => 'F-MATH',
            ]);
        DB::table('subjects')
            ->insert([
                'name' => 'Computer Science',
                'code' => 'COMP',
            ]);
    }
}
