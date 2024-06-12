<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DifferenceThemesController;
use App\Http\Controllers\Admin\GamesThemesController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\PrivacyAndPolicyController;
use App\Http\Controllers\Admin\QuizThemesController;
use App\Http\Controllers\Admin\TermsAndConditionController;
use App\Http\Controllers\Admin\ToursController;
use App\Http\Controllers\Admin\ToursThemesController;
use App\Http\Controllers\Api\DatatableController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ColouringController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\DifferenceController;
use App\Http\Controllers\Admin\GamesController;
use App\Http\Controllers\Admin\QuizAnswerController;
use App\Http\Controllers\Admin\QuizController;
use App\Http\Controllers\Admin\QuizQuestionController;
use App\Http\Controllers\Admin\WhyQuestionController;
use App\Http\Controllers\Admin\TalesController;
use App\Http\Controllers\Admin\WhyQuestionThemesController;
use App\Http\Controllers\Admin\TalesThemesController;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('auth.login');
})->name('/');
Route::post('/whyquestion/store-to-json', [WhyQuestionController::class, 'storeToJson'])->name('whyquestion.storeToJson');
Route::post('/quiz/store-to-json', [QuizController::class, 'storeToJson'])->name('quiz.storeToJson');
Route::post('/game/store-to-json', [GamesController::class, 'storeToJson'])->name('game.storeToJson');
Route::post('/tale/store-to-json', [TalesController::class, 'storeToJson'])->name('tale.storeToJson');
Route::post('/difference/store-to-json', [DifferenceController::class, 'storeToJson'])->name('difference.storeToJson');
Route::post('/tour/store-to-json', [ToursController::class, 'storeToJson'])->name('tour.storeToJson');

Route::post('/quiz/import-csv', [QuizController::class, 'importCsv'])->name('quiz.importCsv');
Route::post('/whyquestion/import-csv', [WhyQuestionController::class, 'importCsv'])->name('whyquestion.importCsv');
Route::post('/game/import-csv', [GamesController::class, 'importCsv'])->name('game.importCsv');
Route::post('/tale/import-csv', [TalesController::class, 'importCsv'])->name('tale.importCsv');
Route::post('/difference/import-csv', [DifferenceController::class, 'importCsv'])->name('difference.importCsv');
Route::post('/tour/import-csv', [ToursController::class, 'importCsv'])->name('tour.importCsv');

Auth::routes(['register' => false]);
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('home');


    Route::get('about', [AboutController::class, 'edit'])->name('about.edit');
    Route::match(['put', 'patch'], 'about-update', [AboutController::class, 'update'])->name('about.update');
    Route::get('privacyandpolicy', [PrivacyAndPolicyController::class, 'edit'])->name('privacyandpolicy.edit');
    Route::match(['put', 'patch'], 'privacyandpolicy-update', [PrivacyAndPolicyController::class, 'update'])->name('privacyandpolicy.update');
    Route::get('termsandcondition', [TermsAndConditionController::class, 'edit'])->name('termsandcondition.edit');
    Route::match(['put', 'patch'], 'termsandcondition-update', [TermsAndConditionController::class, 'update'])->name('termsandcondition.update');


    Route::resource('category', CategoryController::class);
    Route::resource('colouring', ColouringController::class);
    Route::resource('difference', DifferenceController::class);
    Route::resource('whyquestion', WhyQuestionController::class);
    Route::resource('tale', TalesController::class);
    Route::resource('game', GamesController::class);
    Route::resource('tour', ToursController::class);


    Route::resource('quiz', QuizController::class);
    Route::resource('contact', ContactController::class)->except(['store', 'update']);

    Route::put('contact/{status}', [ContactController::class, 'status'])->name('contact.status');
    Route::resource('quizquestion', QuizQuestionController::class)->except('show');
    Route::get('quizquestion/show', [QuizQuestionController::class, 'show'])->name('quizquestion.show');


    Route::resource('quizanswer', QuizAnswerController::class)->except(['show']);
    Route::get('quizanswer/show', [QuizAnswerController::class, 'show'])->name('quizanswer.show');


    Route::get('datatable/{table}', [DatatableController::class, 'handle'])->name('datatable.source');
    Route::get('datatable/{table}/{id}', [DatatableController::class, 'handle'])->name('datatable.sourceid');

    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::match(['put', 'patch'], 'profile-update', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('themes/quiz', [QuizThemesController::class, 'index'])->name('themes.quiz');
    Route::get('themes/whyquestion', [WhyQuestionThemesController::class, 'index'])->name('themes.whyquestion');
    Route::get('themes/tale', [TalesThemesController::class, 'index'])->name('themes.tale');
    Route::get('themes/game', [GamesThemesController::class, 'index'])->name('themes.game');
    Route::get('themes/difference', [DifferenceThemesController::class, 'index'])->name('themes.difference');
    Route::get('themes/tour', [ToursThemesController::class, 'index'])->name('themes.tour');

    Route::get('themes/quiz/completed', [QuizThemesController::class, 'completedQuizzes'])->name('themes.quiz.completed');
    Route::get('themes/whyquestion/completed', [WhyQuestionThemesController::class, 'completedWhyQuestions'])->name('themes.whyquestion.completed');
    Route::get('themes/tale/completed', [TalesThemesController::class, 'completedTales'])->name('themes.tale.completed');
    Route::get('themes/game/completed', [GamesThemesController::class, 'completedGames'])->name('themes.game.completed');
    Route::get('themes/difference/completed', [DifferenceThemesController::class, 'completedPuzzles'])->name('themes.difference.completed');
    Route::get('themes/tour/completed', [ToursThemesController::class, 'completedTours'])->name('themes.tour.completed');


});
