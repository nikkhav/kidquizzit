<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaleStore;
use App\Http\Requests\TaleUpdate;
use App\Models\Category;
use App\Models\Tale;
use App\Services\TaleService;

class TalesController extends Controller
{

    private $taleService;

    public function __construct(TaleService $taleService)
    {
        $this->taleService = $taleService;
        // TODO: change parent_id to the id of the category that tales belong to
        $taleCategory = Category::where('parent_id', 35)->get();
        view()->share('categories', $taleCategory);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.tale.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $view = view('admin.pages.tale.modal')->render();
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
    public function store(TaleStore $request)
    {
        $data = $request->toArray();
        $tale = $this->taleService->createTale($data);
        return response()->json([
            'code' =>  200,
            'item' =>  $tale
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
        $item = $this->taleService->getTaleById($id);
        $view = view('admin.pages.tale.form', compact('item'))->render();
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
    public function update(TaleUpdate $request, $id)
    {
        $data = $request->validated();
        $this->taleService->updateTale($id, $data);
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
        $this->taleService->deleteTale($id);

        // Return JSON response with success message and JavaScript snippet for page reload
        return response()->json([
            'code' => 200,
        ]);
    }

    public function getAll()
    {
        $tales = Tale::with('category')->get();

        $tales = $tales->map(function ($item) {
            $item->image = config('app.url') . '/storage/' . $item->image;
            return $item;
        });
        $tales = $tales->makeHidden(['created_at', 'updated_at']);
        $tales->each(function ($item) {
            $item->category->makeHidden(['created_at', 'updated_at']);
        });
        return response()->json($tales);
    }
}
