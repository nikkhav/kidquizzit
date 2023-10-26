<?php

namespace App\Services;

use App\Models\QuizQuestion;

class QuizQuestionService
{
    public function createQuizQuestion($data)
    {
        $quizquestion = QuizQuestion::create($data);
        return $quizquestion;
    }

    public function getQuizQuestionById($id)
    {
        return QuizQuestion::find($id);
    }

    public function updateQuizQuestion($id, $data)
    {
        QuizQuestion::where('id', $id)->update($data);
    }

    public function deleteQuizQuestion($id)
    {
        $quizquetion = QuizQuestion::find($id);
        $quizquetion->delete();
    }
}
