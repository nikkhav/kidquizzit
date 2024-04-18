<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GameStore;
use App\Http\Requests\GameUpdate;
use App\Models\Category;
use App\Models\Game;
use App\Services\GameService;
use Illuminate\Http\Request;

class GamesController extends Controller
{

    private $gameService;

    public function __construct(GameService $gameService)
    {
        $this->gameService = $gameService;
        $gameCategory = Category::where('parent_id', 41)->get();
        view()->share('categories', $gameCategory);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.game.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $view = view('admin.pages.game.modal')->render();
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
    public function store(GameStore $request)
    {
        $data = $request->toArray();
        $game = $this->gameService->createGame($data);
        return response()->json([
            'code' =>  200,
            'item' =>  $game
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
        $item = $this->gameService->getGameById($id);
        $view = view('admin.pages.game.form', compact('item'))->render();
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
    public function update(GameUpdate $request, $id)
    {
        $data = $request->validated();
        $this->gameService->updateGame($id, $data);
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
        $this->gameService->deleteGame($id);

        // Return JSON response with success message and JavaScript snippet for page reload
        return response()->json([
            'code' => 200,
        ]);
    }

    public function getAll()
    {
        $games = Game::with('category')->get();

        $games = $games->map(function ($item) {
            $item->image = config('app.url') . '/storage/' . $item->image;
            return $item;
        });
        $games = $games->makeHidden(['created_at', 'updated_at']);
        $games->each(function ($item) {
            $item->category->makeHidden(['created_at', 'updated_at']);
        });
        return response()->json($games);
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
            $jsonFilePath = storage_path('app/contentData/games.json');

            // Check if the JSON file exists and is readable
            if (!file_exists($jsonFilePath) || !is_readable($jsonFilePath)) {
                throw new \Exception('Unable to read the games data file.');
            }

            // Read the existing data from the file
            $jsonString = file_get_contents($jsonFilePath);
            if ($jsonString === false) {
                throw new \Exception('Failed to read from the games data file.');
            }

            $existingData = json_decode($jsonString, true);
            if ($existingData === null) {
                throw new \Exception('Failed to decode JSON data from the games file.');
            }

            // Check if the category already exists and add the new theme
            $foundCategoryIndex = null;
            foreach ($existingData['games'] as $index => $category) {
                if ($category['category_id'] == $validatedData['category_id']) {
                    $foundCategoryIndex = $index;
                    break;
                }
            }

            if (!is_null($foundCategoryIndex)) {
                // Check if the theme already exists to avoid duplication
                if (!in_array($validatedData['theme'], $existingData['games'][$foundCategoryIndex]['themes'])) {
                    $existingData['games'][$foundCategoryIndex]['themes'][] = $validatedData['theme'];
                }
            } else {
                // Add a new category with the theme
                $existingData['games'][] = [
                    'category_id' => $validatedData['category_id'],
                    'themes' => [$validatedData['theme']],
                ];
            }

            // Save the updated data back to the JSON file
            if (file_put_contents($jsonFilePath, json_encode($existingData, JSON_PRETTY_PRINT)) === false) {
                throw new \Exception('Failed to write to the games data file.');
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
            $this->importFromCSV($filePath, storage_path('app/contentData/games.json'));
            return redirect()->back()->with('success', 'Games imported successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to import games: ' . $e->getMessage());
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
                // Extract only numbers from the category_id
                $newEntry['category_id'] = preg_replace('/[^0-9]/', '', $newEntry['category_id']);

                // Find the correct category and add the theme if it's not already present
                $categoryFound = false;
                foreach ($data['games'] as &$category) {
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
                    $data['games'][] = [
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
