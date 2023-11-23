<?php

namespace App\Services;

use App\Models\Game;
use Illuminate\Support\Facades\Storage;

class GameService
{
    public function createGame($data)
    {
        if (isset($data['image']) && $data['image']->isValid()) {
            $imagePath = $data['image']->store('game', 'public');
            $data['image'] = $imagePath;
        }

        $game = Game::create($data);

        return $game;
    }

    public function getGameById($id)
    {
        return Game::find($id);
    }

    public function updateGame($id, $data)
    {
        if (isset($data['image'])) {
            // Upload the new image and get its path
            $imagePath = $data['image']->store('tale', 'public');

            // Delete the old image if it exists
            $oldGame = Game::find($id);
            if ($oldGame->image && Storage::disk('public')->exists($oldGame->image)) {
                Storage::disk('public')->delete($oldGame->image);
            }

            // Update the data array with the new image path
            $data['image'] = $imagePath;
        }

        // Update the Why Question record with the updated data
        Game::where('id', $id)->update($data);
    }

    public function deleteGame($id)
    {
        $game = Game::find($id);

        if ($game) {
            // Delete the associated image file if it exists
            if ($game->image && Storage::disk('public')->exists($game->image)) {
                Storage::disk('public')->delete($game->image);
            }

            // Delete the Why Question record from the database
            $game->delete();
        }
    }
}
