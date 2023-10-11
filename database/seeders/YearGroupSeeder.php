<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class YearGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('year_groups')
            ->insert([
                'name' => 'Year 12',
                'code' => 'Y12',
            ]);
        DB::table('year_groups')
            ->insert([
                'name' => 'Year 13',
                'code' => 'Y13',
            ]);
    }
}
