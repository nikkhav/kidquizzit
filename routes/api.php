<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\ColouringController;
use App\Http\Controllers\Admin\PrivacyAndPolicyController;
use App\Http\Controllers\Admin\TermsAndConditionController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\DifferenceController;
use App\Http\Controllers\Admin\GamesController;
use App\Http\Controllers\Admin\QuizController;
use App\Http\Controllers\Admin\WhyQuestionController;
use App\Http\Controllers\Admin\TalesController;
use App\Http\Controllers\Admin\ToursController;
use App\Http\Controllers\Admin\ArtsAndCraftsController;

Route::prefix('v1')->group(function () {
    Route::get('/about', [AboutController::class, 'getAll']);
    Route::get('/privacyandpolicy', [PrivacyAndPolicyController::class, 'getAll']);
    Route::get('/termsandcondition', [TermsAndConditionController::class, 'getAll']);
    Route::get('/category', [CategoryController::class, 'getAll']);
    Route::get('/colouring', [ColouringController::class, 'getAll']);
    Route::get('/difference', [DifferenceController::class, 'getAll']);
    Route::get('/whyquestion', [WhyQuestionController::class, 'getAll']);
    Route::get('/tale', [TalesController::class, 'getAll']);
    Route::get('/game', [GamesController::class, 'getAll']);
    Route::get('/tour', [ToursController::class, 'getAll']);
    Route::get('/quiz', [QuizController::class, 'getAll']);
    Route::post('/contact', [ContactController::class, 'store']);
    Route::get('/arts_and_crafts', [ArtsAndCraftsController::class, 'getAll']);
});
