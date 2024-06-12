<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class ToursThemesController extends Controller
{
    public function index()
    {
        $jsonPath = storage_path('app/contentData/tours.json');
        $json = file_get_contents($jsonPath);
        $data = json_decode($json, true);
        $tours = $data['tours'];

        $categories = Category::all()->keyBy('id')->toArray();

        foreach ($tours as &$tour) {
            $tour['category_name'] = $categories[$tour['category_id']]['title'] ?? 'Unknown Category';

            $questionsList = array_map(function ($question) {
                return "<li>$question</li>";
            }, $tour['questions']);

            $tour['themes'] = "<ul>" . implode('', $questionsList) . "</ul>";
        }

        return view('admin.pages.tour.themes.index', ['tours' => $tours]);
    }

    public function completedTours()
    {
        $jsonPath = storage_path('app/contentData/completed_tours.json');

        if (!file_exists($jsonPath)) {
            return redirect()->back()->withErrors('Completed tours file not found.');
        }

        $jsonContent = file_get_contents($jsonPath);
        $data = json_decode($jsonContent, true);
        $tours = $data['completed_tours'];

        $categories = Category::all()->keyBy('id')->toArray();

        foreach ($tours as &$tour) {
            $tour['category_name'] = $categories[$tour['category_id']]['title'] ?? 'Unknown Category';
            $tour['category_name'] .= " (" . $tour['category_id'] . ")";
        }

        return view('admin.pages.tour.themes.completed.index', ['tours' => $tours]);
    }
}
