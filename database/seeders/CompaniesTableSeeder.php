<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('companies')->insert([
            ['name' => 'Goldcorp', 'email' => 'goldcorp@mail.com', 'country_id' => 1],
            ['name' => 'Barrick Gold', 'email' => 'barrick@gold.com', 'country_id' => 1],
            ['name' => 'Newmont Mining', 'email' => 'newmont@mining.com', 'country_id' => 2],
            ['name' => 'Polyus Gold', 'email' => 'polyus@gold.com', 'country_id' => 3],
            ['name' => 'Newcrest Mining', 'email' => 'newcrest@mining.com', 'country_id' => 4],
        ]);
    }
}
