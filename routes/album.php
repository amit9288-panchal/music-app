<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlbumController;

/*
  |--------------------------------------------------------------------------
  | Album Routes
  |--------------------------------------------------------------------------
  |
  |We can register all api related to album here
  |
 */
Route::get('/album/list', [AlbumController::class, 'list']);
