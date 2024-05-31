<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;

class TalesThemesController extends Controller
{
    public function index()
    {
        $jsonPath = storage_path('app/contentData/tales.json');
        $json = file_get_contents($jsonPath);
        $data = json_decode($json, true);
        $tales = $data['tales'];

        $categories = Category::all()->keyBy('id')->toArray();

        foreach ($tales as &$tale) {
            $tale['category_name'] = $categories[$tale['category_id']]['title'] ?? 'Unknown Category';
            $tale['themes'] = array_map(function ($theme) {
                return "<li>$theme</li>";
            }, $tale['themes']);
            $tale['themes'] = "<ul>" . implode('', $tale['themes']) . "</ul>";
        }

        return view('admin.pages.tale.themes.index', ['tales' => $tales]);
    }

    public function completedTales()
    {
        $jsonPath = storage_path('app/contentData/completed_tales.json');
        if (!file_exists($jsonPath)) {
            return redirect()->back()->withErrors('Completed tales file not found.');
        }

        $jsonContent = file_get_contents($jsonPath);
        $data = json_decode($jsonContent, true);
        $tales = $data['completed_tales'];

        $categories = Category::all()->keyBy('id')->toArray();
        foreach ($tales as &$tale) {
            $tale['category_name'] = $categories[$tale['category_id']]['title'] . " (" . $tale['category_id'] . ")";
        }

        return view('admin.pages.tale.themes.completed.index', ['tales' => $tales]);
    }
}
