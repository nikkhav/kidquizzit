<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DifferenceStore;
use App\Http\Requests\DifferenceUpdate;
use App\Models\Category;
use App\Models\Difference;
use App\Services\DifferenceService;
use Illuminate\Http\Request;

class DifferenceController extends Controller
{
    private $differenceService;

    public function __construct(DifferenceService $differenceService)
    {
        $this->differenceService = $differenceService;
        $differenceCategory = Category::where('parent_id', 4)->get();
        view()->share('categories', $differenceCategory);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.difference.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $view = view('admin.pages.difference.modal')->render();
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
    public function store(DifferenceStore $request)
    {
        $data = $request->toArray();
        $difference = $this->differenceService->createDifference($data);
        return response()->json([
            'code' =>  200,
            'item' =>  $difference
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
        $item = $this->differenceService->getDifferenceById($id);
        $view = view('admin.pages.difference.form', compact('item'))->render();
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
    public function update(DifferenceUpdate $request, $id)
    {
        $data = $request->validated();
        $this->differenceService->updateDifference($id, $data);
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
        $this->differenceService->deleteDifference($id);

        // Return JSON response with success message and JavaScript snippet for page reload
        return response()->json([
            'code' => 200,
        ]);
    }

    public function getAll()
    {


        $difference = Difference::with('category')->get();

        $difference = $difference->map(function ($item) {
            $item->image = config('app.url') . '/storage/' . $item->image;
            return $item;
        });
        $difference = $difference->makeHidden(['created_at', 'updated_at']);
        $difference->each(function ($item) {
            $item->category->makeHidden(['created_at', 'updated_at']);
        });
        return response()->json($difference);
    }

    public function storeToJson(Request $request)
    {
        try {
            // Validate the request for game category and theme
            $validatedData = $request->validate([
                'category_id' => 'required|integer',
                'theme' => 'required|string',
            ]);

            // Define the path to the games JSON file
            $jsonFilePath = storage_path('app/contentData/puzzles.json');

            // Check if the JSON file exists and is readable
            if (!file_exists($jsonFilePath) || !is_readable($jsonFilePath)) {
                throw new \Exception('Unable to read the puzzles data file.');
            }

            // Read the existing data from the file
            $jsonString = file_get_contents($jsonFilePath);
            if ($jsonString === false) {
                throw new \Exception('Failed to read from the puzzles data file.');
            }

            $existingData = json_decode($jsonString, true);
            if ($existingData === null) {
                throw new \Exception('Failed to decode JSON data from the puzzles file.');
            }

            // Check if the category already exists and add the new theme
            $foundCategoryIndex = null;
            foreach ($existingData['puzzles'] as $index => $category) {
                if ($category['category_id'] == $validatedData['category_id']) {
                    $foundCategoryIndex = $index;
                    break;
                }
            }

            if (!is_null($foundCategoryIndex)) {
                // Check if the theme already exists to avoid duplication
                if (!in_array($validatedData['theme'], $existingData['puzzles'][$foundCategoryIndex]['themes'])) {
                    $existingData['puzzles'][$foundCategoryIndex]['themes'][] = $validatedData['theme'];
                }
            } else {
                // Add a new category with the theme
                $existingData['puzzles'][] = [
                    'category_id' => $validatedData['category_id'],
                    'themes' => [$validatedData['theme']],
                ];
            }

            // Save the updated data back to the JSON file
            if (file_put_contents($jsonFilePath, json_encode($existingData, JSON_PRETTY_PRINT)) === false) {
                throw new \Exception('Failed to write to the puzzles data file.');
            }

            // Redirect back with a success message
            return redirect()->back()->with('success', 'Theme added successfully.');
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }



    public function importCsv(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt', // Ensure the file is a CSV
        ]);

        $file = $request->file('csv_file');
        $filePath = $file->getRealPath(); // Get the real path to the temporary uploaded file

        try {
            $this->importFromCSV($filePath, storage_path('app/contentData/puzzles.json'));
            return redirect()->back()->with('success', 'Puzzles imported successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to import logic puzzles: ' . $e->getMessage());
        }
    }

    protected function importFromCSV($csvFilePath, $jsonFilePath)
    {
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

                // Extract only the first number sequence from the category_id (assuming it's the actual ID)
                $newEntry['category_id'] = preg_replace('/[^0-9].*$/', '', $newEntry['category_id']);

                // Find the correct category and add the theme if it's not already present
                $categoryFound = false;
                foreach ($data['puzzles'] as &$category) {
                    if ($category['category_id'] == $newEntry['category_id']) {
                        if (!in_array($newEntry['theme'], $category['themes'])) {
                            $category['themes'][] = $newEntry['theme'];
                        }
                        $categoryFound = true;
                        break;
                    }
                }

                // If the category_id does not exist, create a new entry
                if (!$categoryFound) {
                    $data['puzzles'][] = [
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
