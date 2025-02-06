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
        $completedJsonPath = storage_path('app/contentData/completed_whyquestions.json');
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

        $questionKey = array_rand($category['themes']);
        $question = $category['themes'][$questionKey];

        $lineBreakToken = '__LINE_BREAK__'; // Special token for line breaks

        // First description generation
        $answerPrompt1 = "Generate a detailed yet simple answer to the following \"Why\" question: $question. The answer should be written in a fun, engaging, and age-appropriate tone for kids (ages 6–12) while remaining accurate and educational. Use short sentences and easy-to-understand language, with examples or comparisons kids can relate to. The answer should be conversational, as if a parent is explaining it to their child. Add a creative element (e.g., analogies, stories, or scenarios) to keep it entertaining.";
        $description1 = $this->generateDescription($answerPrompt1);

        // Second description generation
        $answerPrompt2 = "Using the explanation provided earlier for the \"Why\" question: $question, expand on the answer by adding additional details and examples to deepen the understanding of the topic. Introduce new, interesting facts and creative elements (such as an extended story, fresh analogies, or fun scenarios) that enrich the narrative without repeating the original content. Ensure the continuation flows naturally and logically.";
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

            // Record the completed why question
            if (!file_exists($completedJsonPath)) {
                file_put_contents($completedJsonPath, json_encode(['completed_questions' => []]));
            }
            $completedQuestions = json_decode(file_get_contents($completedJsonPath), true);
            $completedQuestions['completed_questions'][] = [
                'title' => $question,
                'category_id' => $category['category_id'],
            ];
            file_put_contents($completedJsonPath, json_encode($completedQuestions, JSON_PRETTY_PRINT));

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
