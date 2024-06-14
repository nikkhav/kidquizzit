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
            }, $question['themes']);
            $question['questions'] = "<ul>" . implode('', $question['questions']) . "</ul>";
        }

        return view('admin.pages.whyquestion.themes.index', ['questions' => $questions]);
    }

    public function completedWhyQuestions()
    {
        $jsonPath = storage_path('app/contentData/completed_whyquestions.json');
        if (!file_exists($jsonPath)) {
            return redirect()->back()->withErrors('Completed why questions file not found.');
        }

        $jsonContent = file_get_contents($jsonPath);
        $data = json_decode($jsonContent, true);
        $questions = $data['completed_questions'];

        $categories = Category::all()->keyBy('id')->toArray();
        foreach ($questions as &$question) {
            $question['category_name'] = $categories[$question['category_id']]['title'] . " (" . $question['category_id'] . ")";
        }

        return view('admin.pages.whyquestion.themes.completed.index', ['questions' => $questions]);
    }
}
