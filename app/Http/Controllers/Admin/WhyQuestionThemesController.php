<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;

class WhyQuestionThemesController extends Controller
{
    public function index()
    {
        $jsonPath = storage_path('app/contentData/whyquestions.json');
        $json = file_get_contents($jsonPath);
        $data = json_decode($json, true);
        $questions = $data['questions'];

        $categories = Category::all()->keyBy('id')->toArray();

        foreach ($questions as &$question) {
            $question['category'] = $categories[$question['category_id']]['title'] ?? 'Unknown Category';
            $question['questions'] = array_map(function ($q) {
                return "<li>$q</li>";
            }, $question['questions']);
            $question['questions'] = "<ul>" . implode('', $question['questions']) . "</ul>";
        }

        return view('admin.pages.whyquestion.themes.index', ['questions' => $questions]);
    }
}
