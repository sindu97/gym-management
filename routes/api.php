<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Data\CommonDataController;
use App\Http\Controllers\Api\Plan\PlanController;
use App\Http\Controllers\Api\Plan\SpecialPlanController;
use App\Http\Controllers\Api\Subscription\SubscriptionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('user-common', [CommonDataController::class, 'userCommon'])->name('user-common');
    // plan types
});
// Route::name('plans.')->prefix('plans')->group(function () {
//     Route::post('/create', [PlanController::class, 'create'])->name('create');
//     // Add other routes here if needed
// });

Route::controller(PlanController::class)->prefix('plans')->group(function () {
    Route::get('/', 'index')->name('plans.index');
    Route::post('/create', 'create')->name('plans.create');
});
//Route::post('/create', [PlanController::class, 'create'])->name('create');
//Route::post('/plan/create', [SpecialPlanController::class, 'create'])->name('plan.create');
Route::post('/subscription/create', [SubscriptionController::class, 'create'])->name('plan.create');
Route::post('login', [AuthController::class, 'login'])->name('login');
