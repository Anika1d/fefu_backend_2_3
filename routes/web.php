<?php

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
