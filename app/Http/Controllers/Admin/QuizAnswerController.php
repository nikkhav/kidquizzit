<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuizAnswerUpdate;
use App\Http\Requests\QuizAnswerStore;
use App\Services\QuizAnswerService;
use App\Models\QuizQuestion;
use Illuminate\Http\Request;

class QuizAnswerController extends Controller
{
    private $quizAnswerService;
    private $questionId;

    public function __construct(QuizAnswerService $quizAnswerService, Request $request)
    {
        $this->quizAnswerService = $quizAnswerService;
        $this->questionId = $request->route('quizanswer');
        $quizQuestion = QuizQuestion::find($this->questionId);
        view()->share('quizquestion', $quizQuestion);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $quizquestion = QuizQuestion::find($id);
        return view('admin.pages.quizanswer.index', compact('id', 'quizquestion'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $view = view('admin.pages.quizanswer.modal')->render();
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
    public function store(QuizAnswerStore $request)
    {
        $data = $request->toArray();
        $quizanswer = $this->quizAnswerService->createQuizAnswer($data);
        return response()->json([
            'code' =>  200,
            'item' =>  $quizanswer
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
        $item = $this->quizAnswerService->getQuizAnswerById($id);
        $view = view('admin.pages.quizanswer.form', compact('item'))->render();
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
    public function update(QuizAnswerUpdate $request, $id)
    {
        $data = $request->validated();
        $this->quizAnswerService->updateQuizAnswer($id, $data);
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
        $this->quizAnswerService->deleteQuizAnswer($id);
        return response()->json([
            'code' => 200,
        ]);
    }
}
