<?php

namespace App\Console\Commands;

use App\Models\Game;
use Illuminate\Console\Command;
use App\Services\ChatGPTService;
use App\Services\ImageGenerationService;
use Illuminate\Support\Facades\Storage;

class GenerateGame extends Command
{
    protected $signature = 'generate:game';
    protected $description = 'Generates a game with a question and an image';

    protected $chatGPTService;
    protected $imageService;

    public function __construct(ChatGPTService $chatGPTService, ImageGenerationService $imageService)
    {
        parent::__construct();
        $this->chatGPTService = $chatGPTService;
        $this->imageService = $imageService;
    }

    public function handle()
    {
        $jsonPath = storage_path('app/contentData/games.json');
        $completedGamesPath = storage_path('app/contentData/completed_games.json');

        if (!file_exists($jsonPath)) {
            $this->error("Games JSON file does not exist: $jsonPath");
            return;
        }

        $jsonContent = file_get_contents($jsonPath);
        $allGames = json_decode($jsonContent, true)['games'];

        if (json_last_error() !== JSON_ERROR_NONE) {
            $this->error('Failed to decode JSON: ' . json_last_error_msg());
            return;
        }

        if (empty($allGames)) {
            $this->error('No games available in the JSON file.');
            return;
        }

        $categoryKey = array_rand($allGames);
        $category = $allGames[$categoryKey];

        $gameKey = array_rand($category['themes']);
        $game = $category['themes'][$gameKey];
        $lineBreakToken = '__LINE_BREAK__';
        $answerPrompt = "create a simple description or invent rules for the kids game: \n" . $game . " Use the token '$lineBreakToken' for line breaks";
        $answer = $this->chatGPTService->generateContent($answerPrompt);

        if (!isset($answer['choices'][0]['message']['content'])) {
            $this->error('Failed to retrieve answer from ChatGPT API.');
            return;
        }
        $answerText = str_replace($lineBreakToken, "\n", $answer['choices'][0]['message']['content']);

        $imagePrompt = "Prepare a colorful picture for kids illustrating the game: \n" . $game;
        $image = $this->imageService->generateImage($imagePrompt);

        if (isset($image['data'][0]['url'])) {
            $imageURL = $image['data'][0]['url'];
            $imageName = 'image_' . time() . '.png';
            $imagePath = "game/" . $imageName;
            Storage::disk('public')->put($imagePath, file_get_contents($imageURL));

            Game::create([
                'title' => $game,
                'description' => $answerText,
                'category_id' => $category['category_id'],
                'image' => $imagePath,
            ]);

            // Add to completed games JSON
            if (!file_exists($completedGamesPath)) {
                file_put_contents($completedGamesPath, json_encode(['completed_games' => []]));
            }
            $completedGamesContent = file_get_contents($completedGamesPath);
            $completedGames = json_decode($completedGamesContent, true);
            $completedGames['completed_games'][] = ['title' => $game, 'description' => $answerText, 'category_id' => $category['category_id']];
            file_put_contents($completedGamesPath, json_encode($completedGames, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

            unset($allGames[$categoryKey]['themes'][$gameKey]);
            if (empty($allGames[$categoryKey]['themes'])) {
                unset($allGames[$categoryKey]);
            }
            $allGames = array_values($allGames);
            $jsonContent = json_encode(['games' => $allGames], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            file_put_contents($jsonPath, $jsonContent);

            $this->info("Successfully generated game and image for: $game");
        } else {
            $this->error('Failed to retrieve image from Image Generation API.');
            return;
        }
    }
}
