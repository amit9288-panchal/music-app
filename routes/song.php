<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SongController;

/*
  |--------------------------------------------------------------------------
  | Songs Routes
  |--------------------------------------------------------------------------
  |
  |We can register all api related to songs here
  |
 */
Route::get('/song/list', [SongController::class, 'list']);
Route::post('/song/search', [SongController::class, 'search']);
