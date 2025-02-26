<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArtsAndCraftStore;
use App\Http\Requests\ArtsAndCraftUpdate;
use App\Models\Category;
use App\Models\ArtsAndCraft;
use App\Services\ArtsAndCraftService;
use Illuminate\Http\Request;

class ArtsAndCraftsController extends Controller
{
    private $artsAndCraftService;

    public function __construct(ArtsAndCraftService $artsAndCraftService)
    {
        $this->artsAndCraftService = $artsAndCraftService;
        $artsAndCraftCategory = Category::where('parent_id', 58)->get();
        view()->share('categories', $artsAndCraftCategory);
    }

    public function index()
    {
        return view('admin.pages.arts_and_crafts.index');
    }

    public function create()
    {
        $view = view('admin.pages.arts_and_crafts.modal')->render();
        return response()->json([
            'code' => 200,
            'view' => $view
        ]);
    }

    public function store(ArtsAndCraftStore $request)
    {
        $data = $request->toArray();
        $item = $this->artsAndCraftService->createArtsAndCraft($data);
        return response()->json([
            'code' => 200,
            'item' => $item
        ]);
    }

    public function edit($id)
    {
        $item = $this->artsAndCraftService->getArtsAndCraftById($id);
        $view = view('admin.arts_and_crafts.form', compact('item'))->render();
        return response()->json([
            'code' => 200,
            'view' => $view
        ]);
    }

    public function update(ArtsAndCraftUpdate $request, $id)
    {
        $data = $request->validated();
        $this->artsAndCraftService->updateArtsAndCraft($id, $data);
        return response()->json([
            'code' => 200
        ]);
    }

    public function destroy($id)
    {
        $this->artsAndCraftService->deleteArtsAndCraft($id);
        return response()->json([
            'code' => 200
        ]);
    }

    public function getAll()
    {
        $items = ArtsAndCraft::with('category')->get();
        $items = $items->map(function ($item) {
            $item->image = config('app.url') . '/storage/' . $item->image;
            return $item;
        });
        $items = $items->makeHidden(['created_at', 'updated_at']);
        $items->each(function ($item) {
            $item->category->makeHidden(['created_at', 'updated_at']);
        });
        return response()->json($items);
    }

    public function storeToJson(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'category_id' => 'required|integer',
                'theme'       => 'required|string'
            ]);
            $jsonFilePath = storage_path('app/contentData/arts_and_crafts.json');
            if (!file_exists($jsonFilePath) || !is_readable($jsonFilePath)) {
                throw new \Exception('Unable to read the Arts and Crafts data file.');
            }
            $jsonString = file_get_contents($jsonFilePath);
            if ($jsonString === false) {
                throw new \Exception('Failed to read from the Arts and Crafts data file.');
            }
            $existingData = json_decode($jsonString, true);
            if ($existingData === null) {
                throw new \Exception('Failed to decode JSON data from the Arts and Crafts file.');
            }
            $foundCategoryIndex = null;
            foreach ($existingData['arts_and_crafts'] as $index => $category) {
                if ($category['category_id'] == $validatedData['category_id']) {
                    $foundCategoryIndex = $index;
                    break;
                }
            }
            if (!is_null($foundCategoryIndex)) {
                if (!in_array($validatedData['theme'], $existingData['arts_and_crafts'][$foundCategoryIndex]['themes'])) {
                    $existingData['arts_and_crafts'][$foundCategoryIndex]['themes'][] = $validatedData['theme'];
                }
            } else {
                $existingData['arts_and_crafts'][] = [
                    'category_id' => $validatedData['category_id'],
                    'themes'      => [$validatedData['theme']]
                ];
            }
            if (file_put_contents($jsonFilePath, json_encode($existingData, JSON_PRETTY_PRINT)) === false) {
                throw new \Exception('Failed to write to the Arts and Crafts data file.');
            }
            return redirect()->back()->with('success', 'Theme added successfully.');
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function importCsv(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt'
        ]);
        $file = $request->file('csv_file');
        $filePath = $file->getRealPath();
        try {
            $this->importFromCSV($filePath, storage_path('app/contentData/arts_and_crafts.json'));
            return redirect()->back()->with('success', 'Arts and Crafts imported successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to import Arts and Crafts: ' . $e->getMessage());
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
            $header = fgetcsv($handle);
            if ($header === false) {
                throw new \Exception("Failed to read header from CSV file: " . $csvFilePath);
            }
            while (($row = fgetcsv($handle)) !== FALSE) {
                $newEntry = array_combine($header, $row);
                $newEntry['category_id'] = preg_replace('/[^0-9]/', '', $newEntry['category_id']);
                $categoryFound = false;
                foreach ($data['arts_and_crafts'] as &$category) {
                    if ($category['category_id'] == $newEntry['category_id']) {
                        if (!in_array($newEntry['theme'], $category['themes'])) {
                            $category['themes'][] = $newEntry['theme'];
                        }
                        $categoryFound = true;
                        break;
                    }
                }
                if (!$categoryFound) {
                    $data['arts_and_crafts'][] = [
                        'category_id' => $newEntry['category_id'],
                        'themes'      => [$newEntry['theme']]
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
