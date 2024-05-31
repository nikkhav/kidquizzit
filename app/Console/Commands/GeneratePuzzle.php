<?php

namespace App\Console\Commands;

use App\Models\Difference;
use App\Models\Game;
use Illuminate\Console\Command;
use App\Services\ChatGPTService;
use App\Services\ImageGenerationService;
use Illuminate\Support\Facades\Storage;

class GeneratePuzzle extends Command
{
    protected $signature = 'generate:puzzle';
    protected $description = 'Generates a puzzle with a question and an image';

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
        $jsonPath = storage_path('app/contentData/puzzles.json');
        $completedJsonPath = storage_path('app/contentData/completed_puzzles.json');

        if (!file_exists($jsonPath)) {
            $this->error("Puzzles JSON file does not exist: $jsonPath");
            return;
        }

        $jsonContent = file_get_contents($jsonPath);
        $allPuzzles = json_decode($jsonContent, true)['puzzles'];

        if (json_last_error() !== JSON_ERROR_NONE) {
            $this->error('Failed to decode JSON: ' . json_last_error_msg());
            return;
        }

        if (empty($allPuzzles)) {
            $this->error('No puzzles available in the JSON file.');
            return;
        }

        $categoryKey = array_rand($allPuzzles);
        $category = $allPuzzles[$categoryKey];

        $puzzleKey = array_rand($category['themes']);
        $puzzle = $category['themes'][$puzzleKey];

        $lineBreakToken = '__LINE_BREAK__'; // Special token for line breaks

        $answerPrompt = "create a simple rules and clues for kids puzzle for : \n" . $puzzle . "Use the token '$lineBreakToken' for line breaks";
        $answer = $this->chatGPTService->generateContent($answerPrompt);

        if (!isset($answer['choices'][0]['message']['content'])) {
            $this->error('Failed to retrieve answer from ChatGPT API.');
            return;
        }
        $answerText = str_replace($lineBreakToken, "\n", $answer['choices'][0]['message']['content']);

        $imagePrompt = "Prepare a colorful picture for kids illustrating the puzzle: \n" . $puzzle;
        $image = $this->imageService->generateImage($imagePrompt);

        if (isset($image['data'][0]['url'])) {
            $imageURL = $image['data'][0]['url'];

            $imageName = 'image_' . time() . '.png';
            $imagePath = "puzzle/" . $imageName;
            Storage::disk('public')->put($imagePath, file_get_contents($imageURL));

            Difference::create([
                'title' => $puzzle,
                'description' => $answerText,
                'category_id' => $category['category_id'],
                'image' => $imagePath,
            ]);


            unset($allPuzzles[$categoryKey]['themes'][$puzzleKey]);

            // If the category now has 0 questions, remove the category as well

            if(empty($allPuzzles[$categoryKey]['themes'])){
                unset($allPuzzles[$categoryKey]);
            }

            // Re-index the array to prevent JSON from converting array to object
            $allPuzzles = array_values($allPuzzles);

            // Convert the updated array back to JSON
            $jsonContent = json_encode(['puzzles' => $allPuzzles], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

            // Save the updated JSON back to the file
            file_put_contents($jsonPath, $jsonContent);

            // Save to completed puzzles JSON
            if (!file_exists($completedJsonPath)) {
                file_put_contents($completedJsonPath, json_encode(['completed_puzzles' => []]));
            }
            $completedPuzzles = json_decode(file_get_contents($completedJsonPath), true);
            $completedPuzzles['completed_puzzles'][] = [
                'title' => $puzzle,
                'category_id' => $category['category_id'],
            ];
            file_put_contents($completedJsonPath, json_encode($completedPuzzles, JSON_PRETTY_PRINT));

            $this->info("Successfully generated puzzle and image for: $puzzle");
        } else {
            $this->error('Failed to retrieve image from Image Generation API.');
            return;
        }
    }
}
