<?php

namespace App\Console\Commands;

use App\Models\WhyQuestion;
use Illuminate\Console\Command;
use App\Services\ChatGPTService;
use App\Services\ImageGenerationService;
use Illuminate\Support\Facades\Storage;

class GenerateWhyQuestion extends Command
{
    protected $signature = 'generate:why';
    protected $description = 'Generates an answer and a picture for a random why question';

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
        $jsonPath = storage_path('app/contentData/whyquestions.json');
        if (!file_exists($jsonPath)) {
            $this->error("Questions JSON file does not exist: $jsonPath");
            return;
        }

        $jsonContent = file_get_contents($jsonPath);
        $allQuestions = json_decode($jsonContent, true)['questions'];

        if (json_last_error() !== JSON_ERROR_NONE) {
            $this->error('Failed to decode JSON: ' . json_last_error_msg());
            return;
        }

        if (empty($allQuestions)) {
            $this->error('No questions available in the JSON file.');
            return;
        }

        $categoryKey = array_rand($allQuestions);
        $category = $allQuestions[$categoryKey];

        $questionKey = array_rand($category['questions']);
        $question = $category['questions'][$questionKey];

        $lineBreakToken = '__LINE_BREAK__'; // Special token for line breaks

        // First description generation
        $answerPrompt1 = "Provide a 300 words direct answer for a young child, each explanation part separated by '$lineBreakToken'. Question:\n$question";
        $description1 = $this->generateDescription($answerPrompt1);

        // Second description generation
        $answerPrompt2 = "Provide a 500 words direct, detailed answer for a young child, each explanation part separated by '$question";
        $description2 = $this->generateDescription($answerPrompt2);

        // Image generation
        $imagePrompt = "Create a simple illustration for kids' magazine related to: \n" . $question;
        $image = $this->imageService->generateImage($imagePrompt);

        if ($image && isset($image['data'][0]['url'])) {
            $imageURL = $image['data'][0]['url'];
            $imageName = 'image_' . time() . '.png';
            $imagePath = "whyquestion/" . $imageName;
            Storage::disk('public')->put($imagePath, file_get_contents($imageURL));

            WhyQuestion::create([
                'title' => $question,
                'description' => $description1,
                'description2' => $description2,
                'category_id' => $category['category_id'],
                'image' => $imagePath,
            ]);

            $this->info("Successfully generated why question with two descriptions and an image for: $question");
        } else {
            $this->error('Failed to retrieve or save the image.');
            return;
        }
    }

    private function generateDescription($prompt)
    {
        $lineBreakToken = '__LINE_BREAK__'; // Special token for line breaks
        $answer = $this->chatGPTService->generateContent($prompt);
        if (isset($answer['choices'][0]['message']['content'])) {
            return str_replace($lineBreakToken, "\n", $answer['choices'][0]['message']['content']);
        }
        $this->error('Failed to retrieve answer from ChatGPT API.');
        return null;
    }

}
