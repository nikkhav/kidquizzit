<?php

namespace App\Services;

use App\Models\Quiz;

class QuizService
{
    public function createQuiz($data)
    {
        $colouring = Quiz::create($data);
        return $colouring;
    }

    public function getQuizById($id)
    {
        return Quiz::find($id);
    }

    public function updateQuiz($id, $data)
    {
        Quiz::where('id', $id)->update($data);
    }

    public function deleteQuiz($id)
    {
        $quiz = Quiz::find($id);
        $quiz->delete();
    }
}
