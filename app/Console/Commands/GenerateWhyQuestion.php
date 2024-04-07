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

        $answerPrompt = "Provide a direct answer with each part of the explanation separated by a line break. Start directly with the explanation. A word is a group of letters separated by spaces, or the group of letters that starts or ends a sentence.  Please write a 500 word answer for a 5-year-old kid to the below question. Use the token '$lineBreakToken' for line breaks:\n$question";
        $answer = $this->chatGPTService->generateContent($answerPrompt);

        if (!isset($answer['choices'][0]['message']['content'])) {
            $this->error('Failed to retrieve answer from ChatGPT API.');
            return;
        }
        $answerText = str_replace($lineBreakToken, "\n", $answer['choices'][0]['message']['content']);

        $imagePrompt = "Create simple illustration for kids' magazine regarding the subject of: \n" . $question;
        $image = $this->imageService->generateImage($imagePrompt);

        if (isset($image['data'][0]['url'])) {
            $imageURL = $image['data'][0]['url'];

            $imageName = 'image_' . time() . '.png';
            $imagePath = "whyquestion/" . $imageName;
            Storage::disk('public')->put($imagePath, file_get_contents($imageURL));

            WhyQuestion::create([
                'title' => $question,
                'description' => $answerText,
                'category_id' => $category['category_id'],
                'image' => $imagePath,
            ]);

            // After successfully creating the WhyQuestion record in the database:
            unset($allQuestions[$categoryKey]['questions'][$questionKey]);

            // If the category now has 0 questions, remove the category as well
            if (empty($allQuestions[$categoryKey]['questions'])) {
                unset($allQuestions[$categoryKey]);
            }

            // Re-index the array to prevent JSON from converting array to object
            $allQuestions = array_values($allQuestions);

            // Convert the updated array back to JSON
            $jsonContent = json_encode(['questions' => $allQuestions], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

            // Save the updated JSON back to the file
            file_put_contents($jsonPath, $jsonContent);

            $this->info("Successfully generated why question and image for: $question");
        } else {
            $this->error('Failed to retrieve image from Image Generation API.');
            return;
        }
    }
}
