<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;


class QuizThemesController extends Controller
{
    public function index()
    {
        $jsonPath = storage_path('app/contentData/quizzes.json');
        $json = file_get_contents($jsonPath);
        $data = json_decode($json, true);
        $quizzes = $data['quizzes'];

        $categories = Category::all()->keyBy('id')->toArray();

        foreach ($quizzes as &$quiz) {
            if (isset($categories[$quiz['category_id']])) {
                $quiz['category'] = $categories[$quiz['category_id']]['title'];
            } else {
                $quiz['category'] = 'Unknown Category';
            }

            // Convert themes to a list of HTML strings for line breaks
            if (isset($quiz['themes'])) {
                if (is_array($quiz['themes'])) {
                    $quiz['themes'] = array_map(function ($theme) {
                        return "<li>$theme</li>";
                    }, $quiz['themes']);
                } elseif (is_object($quiz['themes'])) {
                    $quiz['themes'] = array_map(function ($theme) {
                        return "<li>$theme</li>";
                    }, (array)$quiz['themes']);
                }
                $quiz['themes'] = "<ul>" . implode("", $quiz['themes']) . "</ul>";
            } else {
                $quiz['themes'] = '';
            }
        }

        return view('admin.pages.quiz.themes.index', ['quizzes' => $quizzes]);
    }

    public function completedQuizzes()
    {
        $jsonPath = storage_path('app/contentData/completed_quizzes.json');
        if (!file_exists($jsonPath)) {
            return redirect()->back()->withErrors('Completed quizzes file not found.');
        }

        $jsonContent = file_get_contents($jsonPath);
        $data = json_decode($jsonContent, true);
        $quizzes = $data['completed_quizzes'];

        $categories = Category::all()->keyBy('id')->toArray();
        foreach ($quizzes as &$quiz) {
            $quiz['category_name'] = $categories[$quiz['category_id']]['title'] . " (" . $quiz['category_id'] . ")";
        }

        return view('admin.pages.quiz.themes.completed.index', ['quizzes' => $quizzes]);
    }
}
