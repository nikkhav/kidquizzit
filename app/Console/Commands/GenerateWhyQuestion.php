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
        $answerPrompt1 = "Provide a **direct, engaging, and educational** response to the following 'Why' question: \"$question\". The response should be **around 300 words**, using a natural, human-like style. Avoid introductions, disclaimers, or AI-generated phrases. Make the explanation **clear and fun** for kids (ages 6–12), using relatable examples, simple comparisons, and a storytelling element (e.g., a fun scenario or analogy). Ensure that the answer feels **complete on its own** without needing additional context.";
        $description1 = $this->generateDescription($answerPrompt1);

        // Second description generation
        $answerPrompt2 = "Now **expand on the previous explanation** for the question \"$question\". Do not repeat or rephrase any information from this original explanation: \"$description1\". Instead, build upon it by introducing **new facts, deeper insights, and additional details** that weren’t covered before. This could include scientific explanations, real-world historical examples, or additional creative storytelling elements (e.g., an extended analogy or a different perspective on the topic). The response should be **around 500 words**, structured as a seamless continuation without an introduction like 'Let’s continue' or 'Absolutely!'. Keep the tone **engaging, educational, and natural**, ensuring it feels like a smooth and logical next step.";
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
