<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtistController;

/*
  |--------------------------------------------------------------------------
  | Artists Routes
  |--------------------------------------------------------------------------
  |
  |We can register all api related to artists here
  |
 */
Route::get('/artist/list', [ArtistController::class, 'list']);
Route::post('/artist/single', [ArtistController::class, 'listSingle']);
