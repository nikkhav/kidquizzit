<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        // Create the main category (parent)
        $mainCategory = Category::create([
            'title' => 'Main Category',
            'parent_id' => null, // or keep it as null if your parent_id column allows NULL values
        ]);

        // Create child categories using the main category's id as the parent_id
        Category::create([
            'title' => 'Child Category 1',
            'parent_id' => $mainCategory->id,
        ]);

        Category::create([
            'title' => 'Child Category 2',
            'parent_id' => $mainCategory->id,
        ]);
    }
}
