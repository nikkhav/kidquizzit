<?php

namespace App\Console\Commands;

use App\Models\Tour;
use Illuminate\Console\Command;
use App\Services\ChatGPTService;
use App\Services\ImageGenerationService;
use Illuminate\Support\Facades\Storage;

class GenerateTour extends Command
{
    protected $signature = 'generate:tour';
    protected $description = 'Generates a tour with a detailed description and an accompanying image';

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
        $jsonPath = storage_path('app/contentData/tours.json');
        $completedJsonPath = storage_path('app/contentData/completed_tours.json');
        if (!file_exists($jsonPath)) {
            $this->error("Tour JSON file does not exist: $jsonPath");
            return;
        }

        $jsonContent = file_get_contents($jsonPath);
        $allTours = json_decode($jsonContent, true)['tours'];

        if (json_last_error() !== JSON_ERROR_NONE) {
            $this->error('Failed to decode JSON: ' . json_last_error_msg());
            return;
        }

        if (empty($allTours)) {
            $this->error('No tours available in the JSON file.');
            return;
        }

        // Selecting a random tour
        $tourKey = array_rand($allTours);
        $tour = $allTours[$tourKey];

        // Selecting a random question
        $questionKey = array_rand($tour['questions']);
        $question = $tour['questions'][$questionKey];

//        // Article prompt for generating content
//        $articlePrompt = "Write an article in a tone principally targeting parents, encouraging them to plan and enjoy this tour with their kids. Cover the history and detailed tour scenarios related to: " . $question . ". Include H2 and H3 as needed and expand on key points or add more if needed to hit at least 1500 words.";
//
//        // Generate the full article description
//        $fullArticleDescription = $this->generateDescription($articlePrompt);
        $prompt = 'Write an article in a tone principally targeting parents, encouraging them to plan and enjoy these tours with their kids. Cover the history and detailed tour scenarios. Include H2 and H3 as needed and expand on key points or add more if needed to hit at least 1500 words.';

        $description1 = $this->generateDescription($prompt . $question);

        $prompt2 = 'Continue this article by providing a detailed description of the tour, including the best time to visit, the weather, and the best places to stay.' . $description1;
        $description2 = $this->generateDescription($prompt2 . $question);

        // Image generation
        $imagePrompt = "Create an engaging illustration for a travel brochure related to: \n" . $question;
        $image = $this->imageService->generateImage($imagePrompt);

        if ($image && isset($image['data'][0]['url'])) {
            $imageURL = $image['data'][0]['url'];
            $imageName = 'tour_image_' . time() . '.png';
            $imagePath = "tours/" . $imageName;
            Storage::disk('public')->put($imagePath, file_get_contents($imageURL));

            Tour::create([
                'title' => $question,
                'description1' => $description1,
                'description2' => $description2,
                'category_id' => $tour['category_id'],
                'city_id' => $tour['city_id'],
                'image' => $imagePath,
            ]);

            // Record the completed tour
            if (!file_exists($completedJsonPath)) {
                file_put_contents($completedJsonPath, json_encode(['completed_tours' => []]));
            }
            $completedTours = json_decode(file_get_contents($completedJsonPath), true);
            $completedTours['completed_tours'][] = [
                'title' => $question,
                'category_id' => $tour['category_id'],
                'city_id' => $tour['city_id'],  // Also recording city_id in completed tours
            ];
            file_put_contents($completedJsonPath, json_encode($completedTours, JSON_PRETTY_PRINT));

            $this->info("Successfully generated tour with a detailed article and an image for: " . $question);
        } else {
            $this->error('Failed to retrieve or save the image.');
            return;
        }
    }

    private function generateDescription($prompt)
    {
        $answer = $this->chatGPTService->generateContent($prompt);
        if (isset($answer['choices'][0]['message']['content'])) {
            return $answer['choices'][0]['message']['content'];
        }
        $this->error('Failed to retrieve answer from ChatGPT API.');
        return null;
    }
}
