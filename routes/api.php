<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Data\CommonDataController;
use App\Http\Controllers\Api\Plan\PlanController;
use App\Http\Controllers\Api\Plan\SpecialPlanController;
use App\Http\Controllers\Api\Subscription\SubscriptionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/** ============  Route For Auth Process =================== */
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::middleware(['auth:sanctum'])->group(function () {

    /** ============  Route For Common data  =================== */
    Route::controller(CommonDataController::class)->group(function () {
        Route::get('user-common', 'userCommon')->name('user-common');
    });

    /** ============  Route For Plan =================== */
    Route::controller(PlanController::class)->prefix('plans')->group(function () {
        Route::get('/', 'index')->name('plans.index');
        Route::get('/{id}', 'getdetail')->name('plans.getdetail');
        Route::put('/{id}', 'statusUpdate')->name('plans.update');
        Route::post('/create', 'create')->name('plans.create');
    });

    /** ============  Route For Special Plans =================== */
    Route::controller(SpecialPlanController::class)->prefix('special-package')->group(function () {
        Route::get('/', 'index')->name('plans.index');
        Route::get('/{id}', 'getdetail')->name('plans.getdetail');
        Route::put('/{id}', 'statusUpdate')->name('plans.update');
        Route::post('/create', 'create')->name('plans.create');
    });

    Route::post('/subscription/create', [SubscriptionController::class, 'create'])->name('plan.create');
});


//Route::post('/create', [PlanController::class, 'create'])->name('create');
//Route::post('/plan/create', [SpecialPlanController::class, 'create'])->name('plan.create');
