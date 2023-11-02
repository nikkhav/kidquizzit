<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use App\Http\Requests\CategoryStore;
use App\Http\Requests\CategoryUpdate;
use App\Models\Category;

class CategoryController extends Controller
{
    private $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();

        return view('admin.pages.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $view = view('admin.pages.category.modal', compact('categories'))->render();
        dd($categories);
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
    public function store(CategoryStore $request)
    {
        $data = $request->validated();
        $category = $this->categoryService->createCategory($data);
        return response()->json([
            'code' =>  200,
            'item' =>  $category
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
        $categories = Category::all();
        $item = $this->categoryService->getCategoryById($id);
        $view = view('admin.pages.category.form', compact('item', 'categories'))->render();
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
    public function update(CategoryUpdate $request, $id)
    {
        $data = $request->validated();
        $this->categoryService->updateCategory($id, $data);
        $category = $this->categoryService->getCategoryById($id);
        return response()->json([
            'code' => 200,
            'item' => $category,
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
        // Check if the category has children
        if ($this->categoryService->hasChildren($id)) {
            return response()->json([
                'code' => 400,
                'alert' => 'Cannot delete the category. Please delete its children categories first.'
            ]);
        }

        // Delete the category
        $this->categoryService->deleteCategory($id);

        // Return JSON response with success message and JavaScript snippet for page reload
        return response()->json([
            'code' => 200,
        ]);
    }

    public function getAll()
    {
        $categories = Category::with('childCategories')->whereNull('parent_id')->get();
        return response()->json($categories);
    }
}
