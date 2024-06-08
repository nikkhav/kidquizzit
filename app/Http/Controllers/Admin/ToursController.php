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
        $tourCategory = Category::where('parent_id', 58)->get();
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
        $categories = Category::all();
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
}
