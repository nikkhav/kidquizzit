<?php

namespace App\Console\Commands;


use App\Models\Tale;
use Illuminate\Console\Command;
use App\Services\ChatGPTService;
use App\Services\ImageGenerationService;
use Illuminate\Support\Facades\Storage;

class GenerateTale extends Command
{
    protected $signature = 'generate:tale';
    protected $description = 'Generates a tale with a question and an image';

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
        $jsonPath = storage_path('app/contentData/tales.json');

        if (!file_exists($jsonPath)) {
            $this->error("Tales JSON file does not exist: $jsonPath");
            return;
        }

        $jsonContent = file_get_contents($jsonPath);
        $allTales = json_decode($jsonContent, true)['tales'];

        if (json_last_error() !== JSON_ERROR_NONE) {
            $this->error('Failed to decode JSON: ' . json_last_error_msg());
            return;
        }

        if (empty($allTales)) {
            $this->error('No tales available in the JSON file.');
            return;
        }

        $categoryKey = array_rand($allTales);
        $category = $allTales[$categoryKey];

        $taleKey = array_rand($category['themes']);
        $categoryName = $category['category_name'];
        $tale = $category['themes'][$taleKey];

        $lineBreakToken = '__LINE_BREAK__'; // Special token for line breaks

        $answerPrompt = "create a kid " . $categoryName . " fairy tale in minimum 1000 words with the theme of: \n" . $tale . "Use the token '$lineBreakToken' for line breaks";
        $answer = $this->chatGPTService->generateContent($answerPrompt);

        if (!isset($answer['choices'][0]['message']['content'])) {
            $this->error('Failed to retrieve answer from ChatGPT API.');
            return;
        }
        $answerText = str_replace($lineBreakToken, "\n", $answer['choices'][0]['message']['content']);

        $imagePrompt = "Create image for kids designed to be wordless and free of any symbols illustrating the fairy tale with the theme of: \n" . $tale;
        $image = $this->imageService->generateImage($imagePrompt);

        if (isset($image['data'][0]['url'])) {
            $imageURL = $image['data'][0]['url'];

            $imageName = 'image_' . time() . '.png';
            $imagePath = "tale/" . $imageName;
            Storage::disk('public')->put($imagePath, file_get_contents($imageURL));

            Tale::create([
                'title' => $tale,
                'description' => $answerText,
                'category_id' => $category['category_id'],
                'image' => $imagePath,
            ]);

            unset($allTales[$categoryKey]['themes'][$taleKey]);

            // If the category now has 0 questions, remove the category as well

            if(empty($allTales[$categoryKey]['themes'])){
                unset($allTales[$categoryKey]);
            }

            // Re-index the array to prevent JSON from converting array to object
            $allTales = array_values($allTales);

            // Convert the updated array back to JSON
            $jsonContent = json_encode(['tales' => $allTales], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

            // Save the updated JSON back to the file
            file_put_contents($jsonPath, $jsonContent);

            $this->info("Successfully generated tale and image for: $tale");
        } else {
            $this->error('Failed to retrieve image from Image Generation API.');
            return;
        }
    }
}
