<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class GamesThemesController extends Controller
{
    public function index()
    {
        $jsonPath = storage_path('app/contentData/games.json');
        $json = file_get_contents($jsonPath);
        $data = json_decode($json, true);
        $games = $data['games'];

        $categories = Category::all()->keyBy('id')->toArray();

        foreach ($games as &$game) {
            $game['category_name'] = $categories[$game['category_id']]['title'] ?? 'Unknown Category';
            $game['themes'] = array_map(function ($theme) {
                return "<li>$theme</li>";
            }, $game['themes']);
            $game['themes'] = "<ul>" . implode('', $game['themes']) . "</ul>";
        }

        return view('admin.pages.game.themes.index', ['games' => $games]);
    }

    public function completedGames()
    {
        $jsonPath = storage_path('app/contentData/completed_games.json');

        if (!file_exists($jsonPath)) {
            // Handle the error - possibly redirect or show a message
            return redirect()->back()->withErrors('Completed games file not found.');
        }

        $jsonContent = file_get_contents($jsonPath);
        $data = json_decode($jsonContent, true);
        $games = $data['completed_games'];

        $categories = Category::all()->keyBy('id')->toArray();

        foreach ($games as &$game) {
            $game['category_name'] = $categories[$game['category_id']]['title'] ?? 'Unknown Category';
            $game['category_name'] .= " (" . $game['category_id'] . ")";
        }

        return view('admin.pages.game.themes.completed.index', ['games' => $games]);
    }

}
