<?php

use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\ExperienceController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\SkillController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public API Routes
|--------------------------------------------------------------------------
| These routes are accessible without authentication.
| They power the public-facing Vue 3 portfolio SPA.
*/

Route::prefix('v1')->group(function () {
    // Profile (singleton)
    Route::get('/profile', [ProfileController::class, 'show']);

    // Projects
    Route::get('/projects', [ProjectController::class, 'index']);
    Route::get('/projects/featured', [ProjectController::class, 'featured']);
    Route::get('/projects/{project}', [ProjectController::class, 'show']);

    // Skills (grouped by category)
    Route::get('/skills', [SkillController::class, 'index']);

    // Experience (timeline)
    Route::get('/experiences', [ExperienceController::class, 'index']);

    // Contact form submission
    Route::post('/contact', [ContactController::class, 'store']);
});
