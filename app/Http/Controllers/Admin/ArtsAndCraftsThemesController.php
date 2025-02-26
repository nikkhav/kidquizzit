<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class ArtsAndCraftsThemesController extends Controller
{
    public function index()
    {
        $jsonPath = storage_path('app/contentData/arts_and_crafts.json');
        $json = file_get_contents($jsonPath);
        $data = json_decode($json, true);
        $items = $data['arts_and_crafts'];
        $categories = Category::all()->keyBy('id')->toArray();
        foreach ($items as &$item) {
            $item['category_name'] = $categories[$item['category_id']]['title'] ?? 'Unknown Category';
            $item['themes'] = array_map(function ($theme) {
                return "<li>$theme</li>";
            }, $item['themes']);
            $item['themes'] = "<ul>" . implode('', $item['themes']) . "</ul>";
        }
        return view('admin.pages.arts_and_crafts.themes.index', ['items' => $items]);
    }

    public function completedArtsAndCrafts()
    {
        $jsonPath = storage_path('app/contentData/completed_arts_and_crafts.json');
        if (!file_exists($jsonPath)) {
            return redirect()->back()->withErrors('Completed Arts and Crafts file not found.');
        }
        $jsonContent = file_get_contents($jsonPath);
        $data = json_decode($jsonContent, true);
        $items = $data['completed_arts_and_crafts'];
        $categories = Category::all()->keyBy('id')->toArray();
        foreach ($items as &$item) {
            $item['category_name'] = $categories[$item['category_id']]['title'] ?? 'Unknown Category';
            $item['category_name'] .= " (" . $item['category_id'] . ")";
        }
        return view('admin.pages.arts_and_crafts.themes.completed.index', ['items' => $items]);
    }
}
