<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\PrivacyAndPolicyController;
use App\Http\Controllers\Admin\TermsAndConditionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')->group(function () {
    Route::get('/about', [AboutController::class, 'getAll']);
    Route::get('/privacyandpolicy', [PrivacyAndPolicyController::class, 'getAll']);
    Route::get('/termsandcondition', [TermsAndConditionController::class, 'getAll']);

    // Add more routes for other resources as needed
});
