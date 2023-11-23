<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GameStore;
use App\Http\Requests\GameUpdate;
use App\Models\Category;
use App\Models\Game;
use App\Services\GameService;

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
}
