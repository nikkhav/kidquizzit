<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        // Create the main category (parent)
        $mainCategory1 = Category::create([
            'title' => 'Quizes',
            'parent_id' => null, // or keep it as null if your parent_id column allows NULL values
        ]);
        $mainCategory2 = Category::create([
            'title' => 'Colourings',
            'parent_id' => null, // or keep it as null if your parent_id column allows NULL values
        ]);
        $mainCategory3 = Category::create([
            'title' => 'Why Questions',
            'parent_id' => null, // or keep it as null if your parent_id column allows NULL values
        ]);
        $mainCategory4 = Category::create([
            'title' => 'Find the difference',
            'parent_id' => null, // or keep it as null if your parent_id column allows NULL values
        ]);

        // Create child categories using the main category's id as the parent_id
        Category::create([
            'title' => 'Animals',
            'parent_id' => $mainCategory1->id,
        ]);


        Category::create([
            'title' => 'Bellowed Characters',
            'parent_id' => $mainCategory1->id,
        ]);
        Category::create([
            'title' => 'History',
            'parent_id' => $mainCategory1->id,
        ]);
        Category::create([
            'title' => 'Interactive Geography',
            'parent_id' => $mainCategory1->id,
        ]);
        Category::create([
            'title' => 'Why the earth is round',
            'parent_id' => $mainCategory1->id,
        ]);



        Category::create([
            'title' => 'Animals',
            'parent_id' => $mainCategory2->id,
        ]);

        Category::create([
            'title' => 'Cartoons',
            'parent_id' => $mainCategory2->id,
        ]);
        Category::create([
            'title' => 'Games',
            'parent_id' => $mainCategory2->id,
        ]);
        Category::create([
            'title' => 'Interactive Geography',
            'parent_id' => $mainCategory2->id,
        ]);
        Category::create([
            'title' => 'Vehicles',
            'parent_id' => $mainCategory2->id,
        ]);


        Category::create([
            'title' => 'Animals',
            'parent_id' => $mainCategory3->id,
        ]);
        Category::create([
            'title' => 'Human Body',
            'parent_id' => $mainCategory3->id,
        ]);
        Category::create([
            'title' => 'Nature',
            'parent_id' => $mainCategory3->id,
        ]);
        Category::create([
            'title' => 'Space',
            'parent_id' => $mainCategory3->id,
        ]);
        Category::create([
            'title' => 'Mechanics',
            'parent_id' => $mainCategory3->id,
        ]);
        Category::create([
            'title' => 'Science',
            'parent_id' => $mainCategory3->id,
        ]);

        Category::create([
            'title' => 'Gifts',
            'parent_id' => $mainCategory4->id,
        ]);
    }
}
