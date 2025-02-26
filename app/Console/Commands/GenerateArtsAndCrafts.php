<?php

namespace App\Console\Commands;

use App\Models\ArtsAndCraft;
use Illuminate\Console\Command;
use App\Services\ChatGPTService;
use App\Services\ImageGenerationService;
use Illuminate\Support\Facades\Storage;

class GenerateArtsAndCrafts extends Command
{
    protected $signature = 'generate:artsandcrafts';
    protected $description = 'Generates an Arts and Crafts activity with description and an image';

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
        $jsonPath = storage_path('app/contentData/arts_and_crafts.json');
        $completedPath = storage_path('app/contentData/completed_arts_and_crafts.json');

        if (!file_exists($jsonPath)) {
            $this->error("Arts and Crafts JSON file does not exist: $jsonPath");
            return;
        }

        $jsonContent = file_get_contents($jsonPath);
        $allActivities = json_decode($jsonContent, true)['arts_and_crafts'];

        if (json_last_error() !== JSON_ERROR_NONE) {
            $this->error('Failed to decode JSON: ' . json_last_error_msg());
            return;
        }

        if (empty($allActivities)) {
            $this->error('No Arts and Crafts activities available in the JSON file.');
            return;
        }

        $categoryKey = array_rand($allActivities);
        $category = $allActivities[$categoryKey];

        $activityKey = array_rand($category['themes']);
        $activity = $category['themes'][$activityKey];

        $lineBreakToken = '__LINE_BREAK__';
        $answerPrompt = "Generate a detailed, engaging, and simple description for the following kids' arts and crafts activity: $activity. The description should be creative, easy to follow, and fun, suitable for children ages 6–12. Include a list of materials, step-by-step instructions, and any creative ideas to enhance the activity.";
        $answer = $this->chatGPTService->generateContent($answerPrompt);

        if (!isset($answer['choices'][0]['message']['content'])) {
            $this->error('Failed to retrieve answer from ChatGPT API.');
            return;
        }
        $answerText = str_replace($lineBreakToken, "\n", $answer['choices'][0]['message']['content']);

        $imagePrompt = "Prepare a colorful and creative image for a kids' arts and crafts activity: \n" . $activity;
        $image = $this->imageService->generateImage($imagePrompt);

        if (isset($image['data'][0]['url'])) {
            $imageURL = $image['data'][0]['url'];
            $imageName = 'image_' . time() . '.png';
            $imagePath = "arts_and_crafts/" . $imageName;
            Storage::disk('public')->put($imagePath, file_get_contents($imageURL));

            ArtsAndCraft::create([
                'title'       => $activity,
                'description' => $answerText,
                'category_id' => $category['category_id'],
                'image'       => $imagePath,
            ]);

            // Add to completed arts and crafts JSON
            if (!file_exists($completedPath)) {
                file_put_contents($completedPath, json_encode(['completed_arts_and_crafts' => []]));
            }
            $completedContent = file_get_contents($completedPath);
            $completedData = json_decode($completedContent, true);
            $completedData['completed_arts_and_crafts'][] = [
                'title'       => $activity,
                'description' => $answerText,
                'category_id' => $category['category_id']
            ];
            file_put_contents($completedPath, json_encode($completedData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

            unset($allActivities[$categoryKey]['themes'][$activityKey]);
            if (empty($allActivities[$categoryKey]['themes'])) {
                unset($allActivities[$categoryKey]);
            }
            $allActivities = array_values($allActivities);
            $jsonContent = json_encode(['arts_and_crafts' => $allActivities], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            file_put_contents($jsonPath, $jsonContent);

            $this->info("Successfully generated Arts and Crafts activity and image for: $activity");
        } else {
            $this->error('Failed to retrieve image from Image Generation API.');
            return;
        }
    }
}
