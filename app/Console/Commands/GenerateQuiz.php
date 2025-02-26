<?php

namespace App\Console\Commands;

use App\Models\Quiz;
use App\Models\QuizAnswer;
use App\Models\QuizQuestion;
use Illuminate\Console\Command;
use App\Services\ChatGPTService;
use Illuminate\Support\Facades\Log;

class GenerateQuiz extends Command
{
    protected $signature = 'generate:quiz';
    protected $description = 'Generates quizzes and saves them to a JSON file';

    protected $chatGPTService;

    public function __construct(ChatGPTService $chatGPTService)
    {
        parent::__construct();
        $this->chatGPTService = $chatGPTService;
    }

    public function handle()
    {
        // Define JSON paths
        $jsonPath = storage_path('app/contentData/quizzes.json');
        $completedJsonPath = storage_path('app/contentData/completed_quizzes.json');

        if (!file_exists($jsonPath)) {
            $this->error("Quizzes JSON file does not exist: $jsonPath");
            Log::error("Quizzes JSON file missing at: $jsonPath");
            return;
        }

        $jsonContent = file_get_contents($jsonPath);
        $data = json_decode($jsonContent, true);
        if (json_last_error() !== JSON_ERROR_NONE || empty($data['quizzes'])) {
            $this->error('Failed to decode JSON or no quizzes found.');
            Log::error('Invalid JSON structure.', ['json_error' => json_last_error_msg()]);
            return;
        }

        // Randomly select one category and theme
        $categoryIndex = array_rand($data['quizzes']);
        $category = $data['quizzes'][$categoryIndex] ?? null;
        if (!$category || empty($category['themes'])) {
            $this->error('Category or themes not found.');
            Log::error('Category or themes missing.', ['category_data' => $category]);
            return;
        }
        $themeIndex = array_rand($category['themes']);
        $theme = $category['themes'][$themeIndex];

        // Terminal output before execution
        $this->info("Generating quiz: $theme");

        // Create prompt for ChatGPT
        $prompt = "Generate 10 fun, engaging, and age-appropriate quiz questions for kids (ages 6–12) in the category of $theme. Output strictly in the following format without any extra text or explanation: For each question, start with 'Q1: ' (increment the number for each question) followed by the question text on the same line, then on separate lines list answers with 'A: ' for the correct answer and 'W: ' for each wrong answer. Example: Q1: What is the capital of France?\\nA: Paris\\nW: London\\nW: Rome\\nW: Berlin. Repeat for all 10 questions.";

        $answer = $this->chatGPTService->generateContent($prompt);
        // Log the full ChatGPT response for inspection
        Log::info("ChatGPT raw response", ['response' => $answer]);

        if (!isset($answer['choices'][0]['message']['content']) || empty($answer['choices'][0]['message']['content'])) {
            $this->error('ChatGPT returned an empty response.');
            Log::error('ChatGPT API failure.', ['response' => $answer]);
            return;
        }
        $content = $answer['choices'][0]['message']['content'];

        // Parse quiz questions using Q/A format
        $lines = explode("\n", $content);
        $quizzes = [];
        $currentQuestion = null;
        foreach ($lines as $line) {
            $line = trim($line);
            // Expect questions like "Q1: What is ...?"
            if (preg_match('/^Q(\d+)?: (.*)$/', $line, $questionMatches)) {
                if ($currentQuestion) {
                    $quizzes[] = $currentQuestion;
                }
                $currentQuestion = [
                    'question_text' => $questionMatches[2],
                    'answers' => []
                ];
            }
            // Expect answers like "A: Answer text" or "W: Wrong answer"
            elseif (preg_match('/^(A|W): (.*)$/', $line, $answerMatches)) {
                if ($currentQuestion) {
                    $currentQuestion['answers'][] = [
                        'answer_text' => $answerMatches[2],
                        'is_correct' => $answerMatches[1] === 'A' ? 1 : 0
                    ];
                }
            }
        }
        if ($currentQuestion) {
            $quizzes[] = $currentQuestion;
        }
        if (empty($quizzes)) {
            $this->error("Failed to generate quiz for theme: $theme");
            Log::error("Quiz parsing failed for theme: $theme");
            return;
        }
        // Shuffle answers for each question
        foreach ($quizzes as &$quiz) {
            shuffle($quiz['answers']);
        }
        unset($quiz);

        // Save quiz to database
        $newQuiz = Quiz::create([
            "category_id" => $category['category_id'] ?? null,
            "title" => $theme,
        ]);
        if (!$newQuiz) {
            $this->error('Failed to save quiz to the database.');
            Log::error('Quiz database insert failed.');
            return;
        }
        $newQuizId = $newQuiz->id;
        foreach ($quizzes as $quiz) {
            $newQuestion = QuizQuestion::create([
                "quiz_id" => $newQuizId,
                "question_text" => $quiz['question_text'],
            ]);
            if (!$newQuestion) {
                Log::error("Failed to save question.", ['question' => $quiz['question_text']]);
                continue;
            }
            foreach ($quiz['answers'] as $answer) {
                $newAnswer = QuizAnswer::create([
                    "quiz_question_id" => $newQuestion->id,
                    "answer_text" => $answer['answer_text'],
                    "is_correct" => $answer['is_correct'],
                ]);
                if (!$newAnswer) {
                    Log::error("Failed to save answer.", ['answer' => $answer['answer_text']]);
                }
            }
        }

        // Update JSON data: remove used theme
        unset($data['quizzes'][$categoryIndex]['themes'][$themeIndex]);
        if (empty($data['quizzes'][$categoryIndex]['themes'])) {
            unset($data['quizzes'][$categoryIndex]);
        }
        $data['quizzes'] = array_values($data['quizzes']);
        file_put_contents($jsonPath, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        // Update completed quizzes JSON
        if (!file_exists($completedJsonPath)) {
            file_put_contents($completedJsonPath, json_encode(['completed_quizzes' => []]));
        }
        $completedQuizzes = json_decode(file_get_contents($completedJsonPath), true);
        $completedQuizzes['completed_quizzes'][] = [
            'category_id' => $category['category_id'] ?? null,
            'title' => $theme,
        ];
        file_put_contents($completedJsonPath, json_encode($completedQuizzes, JSON_PRETTY_PRINT));

        // Terminal output after successful execution
        $this->info("Successfully Generated quiz: $theme");
    }
}
