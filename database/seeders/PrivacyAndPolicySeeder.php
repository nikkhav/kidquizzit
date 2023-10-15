<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PrivacyAndPolicy;

class PrivacyAndPolicySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PrivacyAndPolicy::create([
            'description' => 'Default Description',
        ]);
    }
}
