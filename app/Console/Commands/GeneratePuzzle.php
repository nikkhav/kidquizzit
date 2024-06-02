<?php

namespace App\Console\Commands;

use App\Models\Difference;
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

        if ($category['category_id'] == 21) {
            $answerPrompt = "Create Brain Blenders story clues for kids for each of the themes below. The story provides several clues scattered throughout the text. The child must use these clues to figure out where the item is hidden. The story clue shall be designed to challenge a child's critical thinking and problem-solving skills in a fun and engaging way. Each story clue description must be with answer. \n" . $puzzle . " Use the token '$lineBreakToken' for line breaks";
        }
        else if ($category['category_id'] == 54) {
            $answerPrompt = "create a pattern made up of shapes, numbers, and letters for kids. Kid's task is to find the next item in each pattern and to figure out the rule that governs it. Each pattern shall contain an answer. \n" . $puzzle . " Use the token '$lineBreakToken' for line breaks";
        }
        else if ($category['category_id'] == 55) {
            $answerPrompt = "Create a mystery story for kids for each of the themes below where events are described out of order. The child must rearrange the events in the correct sequence. Each story clue description must be with answer.
            \n" . $puzzle . " Use the token '$lineBreakToken' for line breaks";
        }
        else if ($category['category_id'] == 56) {
            $answerPrompt = "create a set of instructions for the child to follow to complete a task for kids for each of the themes below, such as drawing a picture or making a simple craft. The instructions should require careful reading and logical thinking.
            \n" . $puzzle . " Use the token '$lineBreakToken' for line breaks";
        } else {
            $answerPrompt = "Create a logic puzzle with simple rules and clues for kids for : \n" . $puzzle . " Use the token '$lineBreakToken' for line breaks";
        }

        //$answerPrompt = "create a simple rules and clues for kids puzzle for : \n" . $puzzle . "Use the token '$lineBreakToken' for line breaks";
        $answer = $this->chatGPTService->generateContent($answerPrompt);

        if (!isset($answer['choices'][0]['message']['content'])) {
            $this->error('Failed to retrieve answer from ChatGPT API.');
            return;
        }
        $answerText = str_replace($lineBreakToken, "\n", $answer['choices'][0]['message']['content']);

        $imagePrompt = "Create and image for logic puzzle for kids for : \n" . $puzzle . "And answer is : \n" . $answerText;
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

            if (empty($allPuzzles[$categoryKey]['themes'])) {
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
