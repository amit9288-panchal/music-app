<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Models\Song;

class SongController extends Controller
{

    public function __construct()
    {
    }

    /*
     * @Description  Get list of songs with associated artist name and album and year
     * @auther <panchal.amit9288@gmail.com>
     */

    public function list(Request $request)
    {
        try {
            $songs = Song::get();
            if ($songs->isEmpty()) {
                return response()->json([
                    'status' => 'error',
                    'declaration' => 'record_not_found',
                ],
                    404);
            }
            if ($songs) {
                foreach ($songs as $song) {
                    $song->songable;
                }
            }
            $songsArr = $songs->toArray();
            $result = [];
            $count = 0;
            foreach ($songsArr as $song) {
                $type = (stripos($song['songable_type'], 'album')) ? 'album' : 'artist';
                $result[$count]['id'] = $song['id'];
                $result[$count]['name'] = $song['name'];
                $result[$count]['year'] = $song['year'];
                $result[$count]['type'] = $type;
                $result[$count][$type . '_name'] = $song['songable']['name'];
                $count++;
            }
            return response()->json([
                'status' => 'success',
                'declaration' => 'found_data',
                'payload' => $result,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'declaration' => 'bad_request',
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    /*
     * @Description  Get songs based on search parameter and display name , year ,type and base on type their name
     * @auther <panchal.amit9288@gmail.com>
     */

    public function search(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'search' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'declaration' => 'invalid_request',
                'message' => $validator->errors(),
            ],
                400);
        }
        try {
            $requestParam = $request->all();
            $songs = Song::where('name', 'like', '%' . $requestParam['search'] . '%')->get();
            if ($songs->isEmpty()) {
                return response()->json([
                    'status' => 'error',
                    'declaration' => 'record_not_found',
                ],
                    404);
            }
            if ($songs) {
                foreach ($songs as $song) {
                    $song->songable;
                }
            }
            $songsArr = $songs->toArray();
            $result = [];
            $count = 0;
            foreach ($songsArr as $song) {
                $type = (stripos($song['songable_type'], 'album')) ? 'album' : 'artist';
                $result[$count]['id'] = $song['id'];
                $result[$count]['name'] = $song['name'];
                $result[$count]['year'] = $song['year'];
                $result[$count]['type'] = $type;
                $result[$count][$type . '_name'] = $song['songable']['name'];
                $count++;
            }
            return response()->json([
                'status' => 'success',
                'declaration' => 'found_data',
                'payload' => $result,
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
