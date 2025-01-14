<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TourStore;
use App\Http\Requests\TourUpdate;
use App\Models\Category;
use App\Models\City;

// Include the City model
use App\Models\Tour;
use App\Services\TourService;
use Illuminate\Http\Request;

class ToursController extends Controller
{
    private $tourService;

    public function __construct(TourService $tourService)
    {
        $this->tourService = $tourService;
        $tourCategory = Category::where('parent_id', 52)->get();
        $cities = City::all();
        view()->share('categories', $tourCategory);
        view()->share('cities', $cities);
    }

    public function index()
    {
        return view('admin.pages.tour.index');
    }

    public function create()
    {
        $categories = Category::all();
        $cities = City::all(); // Fetch all cities
        $view = view('admin.pages.tour.modal', compact('categories', 'cities'))->render();
        return response()->json([
            'code' => 200,
            'view' => $view
        ]);
    }

    public function store(TourStore $request)
    {
        $data = $request->validated();
        $tour = $this->tourService->createTour($data);
        return response()->json([
            'code' => 200,
            'item' => $tour
        ]);
    }

    public function edit($id)
    {
        $item = $this->tourService->getTourById($id);
        $categories = Category::where('parent_id', 58)->get();
        $cities = City::all(); // Fetch all cities
        $view = view('admin.pages.tour.form', compact('item', 'categories', 'cities'))->render();
        return response()->json([
            'code' => 200,
            'view' => $view
        ]);
    }

    public function update(TourUpdate $request, $id)
    {
        $data = $request->validated();
        $this->tourService->updateTour($id, $data);
        return response()->json([
            'code' => 200,
        ]);
    }

    public function destroy($id)
    {
        $this->tourService->deleteTour($id);
        return response()->json([
            'code' => 200,
        ]);
    }

    public function getAll()
    {
        $tours = Tour::with(['category', 'city.country'])->get();
        $tours = $tours->map(function ($item) {
            $item->image = config('app.url') . '/storage/' . $item->image;
            return $item;
        });
        $tours = $tours->makeHidden(['created_at', 'updated_at']);
        $tours->each(function ($item) {
            $item->category->makeHidden(['created_at', 'updated_at']);
            $item->city->makeHidden(['created_at', 'updated_at']);
            if ($item->city->country) {
                $item->city->country->makeHidden(['created_at', 'updated_at']);
            }
        });
        return response()->json($tours);
    }

    public function storeToJson(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'category_id' => 'required|integer',
            'theme' => 'required|string',
        ]);

        $jsonFilePath = storage_path('app/contentData/tours.json');

        $existingData = json_decode(file_get_contents($jsonFilePath), true);
        $defaultCityId = 1;

        $foundTourIndex = null;
        foreach ($existingData['tours'] as $index => $tour) {
            if ($tour['category_id'] == $validatedData['category_id'] && $tour['city_id'] == $defaultCityId) {
                $foundTourIndex = $index;
                break;
            }
        }

        $newTheme = ['0' => $validatedData['theme']];

        if (!is_null($foundTourIndex)) {
            // Adjust the key from 'questions' to 'themes'
            $existingData['tours'][$foundTourIndex]['themes'] = array_merge($existingData['tours'][$foundTourIndex]['themes'], $newTheme);
        } else {
            $existingData['tours'][] = [
                'category_id' => $validatedData['category_id'],
                'city_id' => $defaultCityId,
                'themes' => $newTheme,
            ];
        }

        file_put_contents($jsonFilePath, json_encode($existingData, JSON_PRETTY_PRINT));

        return redirect()->back()->with('success', 'Theme added successfully to the tour.');

    }


    public function importCsv(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt',
        ]);

        $file = $request->file('csv_file');
        $filePath = $file->getRealPath();


        try {
            $this->importFromCSV($filePath, storage_path('app/contentData/tours.json'));
            return redirect()->back()->with('success', 'Tours imported successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to import tours: ' . $e->getMessage());
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
                $newEntry['category_id'] = preg_replace('/\D/', '', $newEntry['category_id']);
                $newEntry['city_id'] = preg_replace('/\D/', '', $newEntry['city_id']);

                $tourFound = false;
                foreach ($data['tours'] as &$tour) {
                    if ($tour['category_id'] == $newEntry['category_id'] && $tour['city_id'] == $newEntry['city_id']) {
                        if (!isset($tour['themes'])) {
                            $tour['themes'] = [];
                        }
                        if (!in_array($newEntry['theme'], $tour['themes'])) {
                            $tour['themes'][] = $newEntry['theme'];
                        }
                        $tourFound = true;
                        break;
                    }
                }

                if (!$tourFound) {
                    $data['tours'][] = [
                        'category_id' => $newEntry['category_id'],
                        'city_id' => $newEntry['city_id'],
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
