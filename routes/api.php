<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\StatisticController;

/*Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');*/

// Categories routes
Route::post('/categories', [CategoryController::class, 'store']);
Route::get('/categories', [CategoryController::class, 'index']);

// Authors routes
Route::post('/authors', [AuthorController::class, 'store']);
Route::get('/authors', [AuthorController::class, 'index']);

// Books routes
Route::post('/books', [BookController::class, 'store']);
Route::get('/books', [BookController::class, 'index']);
Route::get('/books/search', [BookController::class, 'search']);
Route::get('/books/{book}', [BookController::class, 'show']);

//statistic routes
Route::get('/statistics/expensive-books', [StatisticController::class, 'aboveAverage']);
Route::get('/statistics/popular-categories', [StatisticController::class, 'popularCategories']);
Route::get('/statistics/top-fantasy-and-sci-fi', [StatisticController::class, 'mostExpensive']);