<?php

namespace App\Console\Commands;

use App\Models\Quiz;
use App\Models\QuizAnswer;
use App\Models\QuizQuestion;
use Illuminate\Console\Command;
use App\Services\ChatGPTService;

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
        $jsonPath = storage_path('app/contentData/quizzes.json');
        $completedJsonPath = storage_path('app/contentData/completed_quizzes.json');
        if (!file_exists($jsonPath)) {
            $this->error("Quizzes JSON file does not exist: $jsonPath");
            return;
        }

        $jsonContent = file_get_contents($jsonPath);
        $data = json_decode($jsonContent, true);
        if (json_last_error() !== JSON_ERROR_NONE || empty($data['quizzes'])) {
            $this->error('Failed to decode JSON or no quizzes available.');
            return;
        }

        // Randomly select one category
        $categoryIndex = array_rand($data['quizzes']);
        $category = $data['quizzes'][$categoryIndex];

        // Randomly select one theme from the category
        $themeIndex = array_rand($category['themes']);
        $theme = $category['themes'][$themeIndex];

        $prompt = "Create a kid quiz of 10 different questions with answers on the below subject”: " . $theme . "each question should have 4 multiple choice answers. Each question should start with Q: and each right answer should start with A: and each wrong answer should start with W: . Please mix positions of right and wrong answers.";
        $answer = $this->chatGPTService->generateContent($prompt);
        $content = $answer['choices'][0]['message']['content'];
        $lines = explode("\n", $content);
        $quizzes = [];
        $currentQuestion = null;
        foreach ($lines as $line) {
            // Check if the line is a question (Q1, Q2, etc.)
            if (preg_match('/^Q(\d+)?: (.*)$/', trim($line), $questionMatches)) {
                if ($currentQuestion) {
                    // If there's an existing question being processed, append it before starting a new one
                    $quizzes[] = $currentQuestion;
                }
                // Start a new question based on the current match
                $currentQuestion = [
                    'question_text' => $questionMatches[2], // Get the question text
                    'answers' => []
                ];
            } elseif (preg_match('/^(A|W): (.*)$/', trim($line), $answerMatches)) {
                // If it's an answer, add it to the current question's answers
                $currentQuestion['answers'][] = [
                    'answer_text' => $answerMatches[2], // Get the answer text
                    'is_correct' => $answerMatches[1] == 'A' ? 1 : 0 // Determine if it's the correct answer
                ];
            }
        }
        if ($currentQuestion) {
            $quizzes[] = $currentQuestion;
        }

        if (empty($quizzes)) {
            $this->error("Failed to generate quiz for theme: $theme");
            return;
        }
        foreach ($quizzes as &$quiz) {
            shuffle($quiz['answers']);
        }
        unset($quiz);
        $newQuiz = Quiz::create([
            "category_id" => $category['category_id'],
            "title" => $theme,
        ]);
        $newQuizId = $newQuiz->id;

        foreach ($quizzes as $quiz) {
            $newQuestion = QuizQuestion::create([
                "quiz_id" => $newQuizId,
                "question_text" => $quiz['question_text'],
            ]);
            $newQuestionId = $newQuestion->id;
            foreach ($quiz['answers'] as $answer) {
                QuizAnswer::create([
                    "quiz_question_id" => $newQuestionId,
                    "answer_text" => $answer['answer_text'],
                    "is_correct" => $answer['is_correct'],
                ]);
            }
        }

        unset($data['quizzes'][$categoryIndex]['themes'][$themeIndex]);

        if (empty($data['quizzes'][$categoryIndex]['themes'])) {
            unset($data['quizzes'][$categoryIndex]);
        }

        $data['quizzes'] = array_values($data['quizzes']);

        $jsonContent = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        file_put_contents($jsonPath, $jsonContent);

        // Append to the completed quizzes JSON
        if (!file_exists($completedJsonPath)) {
            file_put_contents($completedJsonPath, json_encode(['completed_quizzes' => []]));
        }
        $completedQuizzes = json_decode(file_get_contents($completedJsonPath), true);
        $completedQuizzes['completed_quizzes'][] = [
            'category_id' => $category['category_id'],
            'title' => $theme,
        ];
        file_put_contents($completedJsonPath, json_encode($completedQuizzes, JSON_PRETTY_PRINT));

    }
}
