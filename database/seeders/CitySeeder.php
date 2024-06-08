<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    public function run()
    {
        // Fetch the country ID for 'United States'
        $countryId = DB::table('countries')->where('name', 'United States')->value('id');

        DB::table('cities')->insert([
            ['name' => 'Los Angeles', 'country_id' => $countryId],
            ['name' => 'Boston', 'country_id' => $countryId],
            ['name' => 'New York', 'country_id' => $countryId],
            ['name' => 'Seattle', 'country_id' => $countryId],
            ['name' => 'Miami', 'country_id' => $countryId],
        ]);
    }
}
