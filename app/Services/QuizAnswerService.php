<?php

namespace App\Services;

use App\Models\QuizAnswer;

class QuizAnswerService
{
    public function createQuizAnswer($data)
    {
        $quizanswer = QuizAnswer::create($data);
        return $quizanswer;
    }

    public function getQuizAnswerById($id)
    {
        return QuizAnswer::find($id);
    }

    public function updateQuizAnswer($id, $data)
    {
        QuizAnswer::where('id', $id)->update($data);
    }

    public function deleteQuizAnswer($id)
    {
        $quizanswer = QuizAnswer::find($id);
        $quizanswer->delete();
    }
}
