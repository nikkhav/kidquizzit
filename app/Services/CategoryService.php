<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{
    public function createCategory($data)
    {
        $category = Category::create($data);
        return $category;
    }

    public function getCategoryById($id)
    {
        return Category::find($id);
    }

    public function updateCategory($id, $data)
    {
        Category::where('id', $id)->update($data);
    }

    public function deleteCategory($id)
    {
        Category::where('id', $id)->delete();
    }
    public function hasChildren($id)
    {
        $childCategoriesCount = Category::where('parent_id', $id)->count();
        if ($childCategoriesCount > 0) {
            return  true;
        } else {
            return  false;
        }
    }
}
