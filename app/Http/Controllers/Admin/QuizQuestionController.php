<?php

namespace App\Http\Controllers\Admin;

use App\Datatable\QuizQuestionDatatable;
use App\Http\Controllers\Controller;
use App\Http\Requests\QuizQuestionUpdate;
use App\Http\Requests\QuizQuestionStore;
use App\Services\QuizQuestionService;
use App\Models\Quiz;
use App\Models\QuizQuestion;
use Illuminate\Http\Request;


class QuizQuestionController extends Controller
{
    private $quizQuestionService;

    public function __construct(QuizQuestionService $quizQuestionService, Request $request)
    {
        $this->quizQuestionService = $quizQuestionService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $quiz = Quiz::find($id);
        return view('admin.pages.quizquestion.index', compact('id', 'quiz'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $view = view('admin.pages.quizquestion.modal')->render();
        return response()->json([
            'code' => 200,
            'view' => $view
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuizQuestionStore $request)
    {
        $data = $request->toArray();
        $quizquestion = $this->quizQuestionService->createQuizQuestion($data);
        return response()->json([
            'code' =>  200,
            'item' =>  $quizquestion
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = $this->quizQuestionService->getQuizQuestionById($id);
        $view = view('admin.pages.quizquestion.form', compact('item'))->render();
        return response()->json([
            'code' => 200,
            'view' => $view
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuizQuestionUpdate $request, $id)
    {
        $data = $request->validated();
        $this->quizQuestionService->updateQuizQuestion($id, $data);
        return response()->json([
            'code' => 200,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->quizQuestionService->deleteQuizQuestion($id);
        return response()->json([
            'code' => 200,
        ]);
    }
}
