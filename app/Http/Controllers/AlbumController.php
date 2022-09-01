<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Album;
use App\Models\Song;

class AlbumController extends Controller
{

    public function __construct()
    {
    }

    /*
     * @Description  Get list of album and their songs
     * @auther <panchal.amit9288@gmail.com>
     */
    public function list(Request $request)
    {
        try {
            $albums = Album::get();
            if ($albums->isEmpty()) {
                return response()->json([
                    'status' => 'error',
                    'declaration' => 'record_not_found',
                ],
                    404);
            }
            if ($albums) {
                foreach ($albums as $album) {
                    $album->songs;
                }
            }
            return response()->json([
                'status' => 'success',
                'declaration' => 'found_data',
                'payload' => $album,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'declaration' => 'bad_request',
                'message' => $e->getMessage(),
            ], 400);
        }
    }

}
