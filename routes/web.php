<?php

use App\Http\Controllers\AuthWebController;
use App\Http\Controllers\NewsController;
use App\Http\Middleware\SuggestionManager;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppealController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/news/', [NewsController::class, 'getList'])->name('news_list_get_route');
Route::get('/news/{slug}', [NewsController::class, 'getDetails'])->name('news_get_route');
Route::get('/appeal', [AppealController::class, 'handleGet'])->name('appeal_get_route')->withoutMiddleware([SuggestionManager::class]);
Route::post('/appeal', [AppealController::class, 'handlePost'])->name('appeal_post_route')->withoutMiddleware([SuggestionManager::class]);
Route::prefix('/auth')->group(function () {
    Route::match(['GET', 'POST'], '/login', [AuthWebController::class, 'login'])->name('web_login');
    Route::match(['GET', 'POST'], '/register', [AuthWebController::class, 'register'])->name('web_register');
    Route::get('/logout', [AuthWebController::class, 'logout'])->name('web_logout')->middleware('auth:sanctum');
});
Route::get('/profile', [AuthWebController::class, 'profile'])->name('web_profile')->middleware('auth:sanctum');
