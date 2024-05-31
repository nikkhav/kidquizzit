<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class DifferenceThemesController extends Controller
{
    public function index()
    {
        $jsonPath = storage_path('app/contentData/puzzles.json');
        $json = file_get_contents($jsonPath);
        $data = json_decode($json, true);
        $puzzles = $data['puzzles'];

        $categories = Category::all()->keyBy('id')->toArray();

        foreach ($puzzles as &$puzzle) {
            $puzzle['category_name'] = $categories[$puzzle['category_id']]['title'] ?? 'Unknown Category';
            $puzzle['themes'] = array_map(function ($theme) {
                return "<li>$theme</li>";
            }, (array)$puzzle['themes']);
            $puzzle['themes'] = "<ul>" . implode('', $puzzle['themes']) . "</ul>";
        }

        return view('admin.pages.difference.themes.index', ['puzzles' => $puzzles]);
    }

    public function completedPuzzles()
    {
        $jsonPath = storage_path('app/contentData/completed_puzzles.json');
        if (!file_exists($jsonPath)) {
            return redirect()->back()->withErrors('Completed puzzles file not found.');
        }

        $jsonContent = file_get_contents($jsonPath);
        $data = json_decode($jsonContent, true);
        $puzzles = $data['completed_puzzles'];

        $categories = Category::all()->keyBy('id')->toArray();
        foreach ($puzzles as &$puzzle) {
            $puzzle['category_name'] = $categories[$puzzle['category_id']]['title'] . " (" . $puzzle['category_id'] . ")";
        }

        return view('admin.pages.difference.themes.completed.index', ['puzzles' => $puzzles]);
    }

}
