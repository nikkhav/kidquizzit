<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\WhyQuestionStore;
use App\Http\Requests\WhyQuestionUpdate;
use App\Models\Category;
use App\Models\WhyQuestion;
use App\Services\WhyQuestionService;
use Illuminate\Http\Request;

class WhyQuestionController extends Controller
{

    private $whyQuestionService;

    public function __construct(WhyQuestionService $whyQuestionService)
    {
        $this->whyQuestionService = $whyQuestionService;
        $whyQuestionCategory = Category::where('parent_id', 3)->get();
        view()->share('categories', $whyQuestionCategory);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.whyquestion.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $view = view('admin.pages.whyquestion.modal')->render();
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
    public function store(WhyQuestionStore $request)
    {
        $data = $request->toArray();
        $whyquestion = $this->whyQuestionService->createWhyQuestion($data);
        return response()->json([
            'code' =>  200,
            'item' =>  $whyquestion
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
        $item = $this->whyQuestionService->getWhyQuestionById($id);
        $view = view('admin.pages.whyquestion.form', compact('item'))->render();
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
    public function update(WhyQuestionUpdate $request, $id)
    {
        $data = $request->validated();
        $this->whyQuestionService->updateWhyQuestion($id, $data);
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
        $this->whyQuestionService->deleteWhyQuestion($id);

        // Return JSON response with success message and JavaScript snippet for page reload
        return response()->json([
            'code' => 200,
        ]);
    }

    public function getAll()
    {
        $whyQuestions = WhyQuestion::with('category')->get();

        $whyQuestions = $whyQuestions->map(function ($item) {
            $item->image = config('app.url') . '/storage/' . $item->image;
            return $item;
        });
        $whyQuestions = $whyQuestions->makeHidden(['created_at', 'updated_at']);
        $whyQuestions->each(function ($item) {
            $item->category->makeHidden(['created_at', 'updated_at']);
        });
        return response()->json($whyQuestions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeToJson(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'category_id' => 'required|integer',
            'question' => 'required|string',
        ]);

        // Define the path to the JSON file
        $jsonFilePath = storage_path('app/contentData/whyquestions.json');

        // Read the existing data from the file
        $existingData = json_decode(file_get_contents($jsonFilePath), true);

        // Check if the category already exists
        $foundCategoryIndex = null;
        foreach ($existingData['questions'] as $index => $category) {
            if ($category['category_id'] == $validatedData['category_id']) {
                $foundCategoryIndex = $index;
                break;
            }
        }

        // Add the new question to the category
        if (!is_null($foundCategoryIndex)) {
            $existingData['questions'][$foundCategoryIndex]['questions'][] = $validatedData['question'];
        } else {
            $existingData['questions'][] = [
                'category_id' => $validatedData['category_id'],
                'questions' => [$validatedData['question']],
            ];
        }

        // Save the updated data back to the JSON file
        file_put_contents($jsonFilePath, json_encode($existingData, JSON_PRETTY_PRINT));

        // Redirect back or to another page with a success message
        return redirect()->back()->with('success', 'Question added successfully.');
    }


}
