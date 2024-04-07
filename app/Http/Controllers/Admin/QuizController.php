<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuizUpdate;
use App\Http\Requests\QuizStore;
use App\Services\QuizService;
use App\Models\Quiz;
use App\Models\Category;
use Illuminate\Http\Request;


class QuizController extends Controller
{
    private $quizService;

    public function __construct(QuizService $quizService)
    {
        $this->quizService = $quizService;
        $quizCategory = Category::where('parent_id', 1)->get();
        view()->share('categories', $quizCategory);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.quiz.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $view = view('admin.pages.quiz.modal')->render();
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
    public function store(QuizStore $request)
    {
        $data = $request->toArray();
        $quiz = $this->quizService->createQuiz($data);
        return response()->json([
            'code' =>  200,
            'item' =>  $quiz
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
        $item = $this->quizService->getQuizById($id);
        $view = view('admin.pages.quiz.form', compact('item'))->render();
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
    public function update(QuizUpdate $request, $id)
    {
        $data = $request->validated();
        $this->quizService->updateQuiz($id, $data);
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
        // Delete the category
        $this->quizService->deleteQuiz($id);

        // Return JSON response with success message and JavaScript snippet for page reload
        return response()->json([
            'code' => 200,
        ]);
    }

    public function getAll()
    {
        $quizzes = Quiz::with('questions.answers', 'category')->get();

        // Hide created_at and updated_at fields
        $quizzes = $quizzes->map(function ($quiz) {
            $quiz->makeHidden(['created_at', 'updated_at']);
            $quiz->category->makeHidden(['created_at', 'updated_at']);

            // Hide created_at and updated_at fields for each question
            $quiz->questions->each(function ($question) {
                $question->makeHidden(['created_at', 'updated_at']);

                // Hide created_at and updated_at fields for each answer
                $question->answers->each(function ($answer) {
                    $answer->makeHidden(['created_at', 'updated_at']);
                });
            });

            return $quiz;
        });

        return response()->json($quizzes);
    }

    public function storeToJson(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'category_id' => 'required|integer',
            'theme' => 'required|string',
        ]);

        // Define the path to the JSON file
        $jsonFilePath = storage_path('app/contentData/quizzes.json');

        // Read the existing data from the file
        $existingData = json_decode(file_get_contents($jsonFilePath), true);

        // Find the category by category_id
        $foundCategoryIndex = null;
        foreach ($existingData['quizzes'] as $index => $category) {
            if ($category['category_id'] == $validatedData['category_id']) {
                $foundCategoryIndex = $index;
                break;
            }
        }

        // If category exists, push the new theme
        if (!is_null($foundCategoryIndex)) {
            $existingData['quizzes'][$foundCategoryIndex]['themes'][] = $validatedData['theme'];
        } else {
            // If category doesn't exist, create a new one with the theme
            $existingData['quizzes'][] = [
                'category_id' => $validatedData['category_id'],
                'themes' => [$validatedData['theme']]
            ];
        }

        // Save the updated data back to the JSON file
        file_put_contents($jsonFilePath, json_encode($existingData, JSON_PRETTY_PRINT));

        // Redirect back or to another page with a success message
        return redirect()->back()->with('success', 'Theme added successfully.');
    }

}
