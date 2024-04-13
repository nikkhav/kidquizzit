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

        $lineBreakToken = '__LINE_BREAK__'; // Special token for line breaks

        //$answerPrompt = "Provide a direct answer with each part of the explanation separated by a line break. Start directly with the explanation. A word is a group of letters separated by spaces, or the group of letters that starts or ends a sentence.  Please write a 500 word answer for a 5-year-old kid to the below question. Use the token '$lineBreakToken' for line breaks:\n$question";
        $answerPrompt = "create a simple description or invent rules for the kids game: \n" . $game . "Use the token '$lineBreakToken' for line breaks";
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


            unset($allGames[$categoryKey]['themes'][$gameKey]);

            // If the category now has 0 questions, remove the category as well

            if(empty($allGames[$categoryKey]['themes'])){
                unset($allGames[$categoryKey]);
            }

            // Re-index the array to prevent JSON from converting array to object
            $allGames = array_values($allGames);

            // Convert the updated array back to JSON
            $jsonContent = json_encode(['games' => $allGames], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

            // Save the updated JSON back to the file
            file_put_contents($jsonPath, $jsonContent);

            $this->info("Successfully generated game and image for: $game");
        } else {
            $this->error('Failed to retrieve image from Image Generation API.');
            return;
        }
    }
}
