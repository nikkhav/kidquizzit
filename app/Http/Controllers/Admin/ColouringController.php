<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ColouringStore;
use App\Http\Requests\ColouringUpdate;
use App\Models\Category;
use App\Models\Colouring;
use App\Services\ColouringService;
use Illuminate\Http\Request;

class ColouringController extends Controller
{
    private $colouringService;

    public function __construct(ColouringService $colouringService)
    {
        $this->colouringService = $colouringService;
        $colouringCategory = Category::where('parent_id', 2)->get();
        view()->share('categories', $colouringCategory);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.colouring.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $view = view('admin.pages.colouring.modal')->render();
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
    public function store(ColouringStore $request)
    {
        $data = $request->toArray();
        $colouring = $this->colouringService->createColouring($data);
        return response()->json([
            'code' =>  200,
            'item' =>  $colouring
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
        $item = $this->colouringService->getColouringById($id);
        $view = view('admin.pages.colouring.form', compact('item'))->render();
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
    public function update(ColouringUpdate $request, $id)
    {
        $data = $request->validated();
        $this->colouringService->updateColouring($id, $data);
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
        $this->colouringService->deleteColouring($id);

        // Return JSON response with success message and JavaScript snippet for page reload
        return response()->json([
            'code' => 200,
        ]);
    }

    public function getAll()
    {
        $colouring = Colouring::all();
        return response()->json($colouring);
    }
}
