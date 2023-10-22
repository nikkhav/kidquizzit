<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DifferenceStore;
use App\Http\Requests\DifferenceUpdate;
use App\Models\Category;
use App\Models\Difference;
use App\Services\DifferenceService;

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
        $difference = Difference::all();
        return response()->json($difference);
    }
}
