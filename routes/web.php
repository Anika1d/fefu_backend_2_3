<?php

use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppealController;
Route::get('/', function () {
    return view('welcome');
});
Route::get('/news/', [NewsController::class, 'getList'])->name('news_list_rol');
Route::get('/news/{slug}', [NewsController::class, 'getDetails'])->name('news_rol');
Route::match(['get','post'],'/appeal', AppealController::class)->name('appeal_rol');
   