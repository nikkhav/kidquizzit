<?php

namespace App\Datatable;

use App\Models\QuizAnswer;
use Illuminate\Database\Eloquent\Builder;

class QuizAnswerDatatable extends BaseDatatable
{

    public function __construct()
    {
        parent::__construct(QuizAnswer::class, [
            'id' => '№',
            'question_title' => 'Question',
            'answer_text' => 'Answer',
            'is_correct' => 'Is correct?',
            'created_at' => 'Created at',
            'updated_at' => 'Updated at'
        ], [
            'actions' => [
                'title' => 'Actions',
                'view' => 'admin.pages.quizanswer.table_actions'
            ]
        ]);
    }

    protected function query(): Builder
    {
        $query = $this->baseQueryScope()
            ->leftJoin('quiz_questions', 'quiz_answers.quiz_question_id', '=', 'quiz_questions.id')
            ->select('quiz_answers.*', 'quiz_questions.question_text as question_title')
            ->orderBy('created_at', 'asc')
            ->selectRaw("IF(quiz_answers.is_correct = 1, 'True', 'False') as is_correct");

        if (isset($_GET['filters'])) {
            $filters = $_GET['filters'];
            foreach ($filters as $filter) {
                $filter = explode('--', $filter);
                $query->where($filter[0], $filter[1]);
            }
        }

        if ($this->getSearchInput()) {
            $query->where('quiz_answers.answer_text', 'LIKE', '%' . $this->getSearchInput() . '%');
        }

        return $query;
    }
}
