<?php

use App\Http\Controllers\Api\StoryApiController;
use Illuminate\Support\Facades\Route;

Route::get('/stories', [StoryApiController::class, 'index']);
Route::post('/stories', [StoryApiController::class, 'store']);