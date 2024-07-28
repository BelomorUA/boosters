<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('countries')->insert([
            ['name' => 'Canada', 'planned_gold_mining' => 10000], // 10 T = 10000 kg
            ['name' => 'USA', 'planned_gold_mining' => 1000],    // 1 T = 1000 kg
            ['name' => 'Germany', 'planned_gold_mining' => 8000], // 8 T = 8000 kg
            ['name' => 'Australia', 'planned_gold_mining' => 900], // 900 kg
        ]);
    }
}
