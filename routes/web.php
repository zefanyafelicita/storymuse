<?php

use App\Http\Controllers\CollectionController;
use App\Http\Controllers\DiscoverController;
use App\Http\Controllers\HiddenGemsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RecommendationController;
use App\Http\Controllers\StoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
Route::get('/discover', DiscoverController::class)->name('discover');
Route::get('/hidden-gems', HiddenGemsController::class)->name('gems');
Route::get('/for-you', RecommendationController::class)->name('recommendations');
Route::get('/collections', [CollectionController::class, 'index'])->name('collections.index');
Route::get('/collections/{slug}', [CollectionController::class, 'show'])->name('collections.show');
Route::get('/stories/{story:slug}', [StoryController::class, 'show'])->name('stories.show');
