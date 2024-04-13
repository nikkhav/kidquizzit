<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuizUpdate;
use App\Http\Requests\QuizStore;
use App\Services\QuizService;
use App\Models\Quiz;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;


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

    public function importCsv(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt', // Ensure the file is a CSV
        ]);

        $file = $request->file('csv_file');
        $filePath = $file->getRealPath(); // Get the real path to the temporary uploaded file

        // Process the file directly
        try {
            $this->importFromCSV($filePath, storage_path('app/contentData/quizzes.json'));
            return redirect()->back()->with('success', 'Quizzes imported successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to import quizzes: ' . $e->getMessage());
        }
    }

    protected function importFromCSV($csvFilePath, $jsonFilePath) {
        if (!file_exists($csvFilePath)) {
            throw new \Exception("File not found: " . $csvFilePath);
        }

        $jsonString = file_get_contents($jsonFilePath);
        if ($jsonString === false) {
            throw new \Exception("Failed to read JSON file: " . $jsonFilePath);
        }

        $data = json_decode($jsonString, true);
        if ($data === null) {
            throw new \Exception("Failed to decode JSON from file: " . $jsonFilePath);
        }

        if (($handle = fopen($csvFilePath, "r")) !== FALSE) {
            $header = fgetcsv($handle); // Assumes the first line is the header
            if ($header === false) {
                throw new \Exception("Failed to read header from CSV file: " . $csvFilePath);
            }

            while (($row = fgetcsv($handle)) !== FALSE) {
                $newEntry = array_combine($header, $row);

                // Find the correct category and add the theme if it's not already present
                $categoryFound = false;
                foreach ($data['quizzes'] as &$quiz) {
                    if ($quiz['category_id'] == $newEntry['category_id']) {
                        if (!isset($quiz['themes'])) {
                            $quiz['themes'] = []; // Ensure there is an array to add to
                        }
                        // Check if the theme is already in the array to avoid duplication
                        if (!in_array($newEntry['theme'], $quiz['themes'])) {
                            array_push($quiz['themes'], $newEntry['theme']);
                        }
                        $categoryFound = true;
                        break;
                    }
                }

                // If the category_id does not exist, create a new entry
                if (!$categoryFound) {
                    $data['quizzes'][] = [
                        'category_id' => $newEntry['category_id'],
                        'themes' => [$newEntry['theme']]
                    ];
                }
            }
            fclose($handle);
        }

        $result = file_put_contents($jsonFilePath, json_encode($data, JSON_PRETTY_PRINT));
        if ($result === false) {
            throw new \Exception("Failed to write to JSON file: " . $jsonFilePath);
        }
    }



}
