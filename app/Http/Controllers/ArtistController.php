<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Artist;
use App\Models\Album;
use App\Models\Song;

class ArtistController extends Controller
{
    /*
     * @Description  Get Artist list with number of album and singles belongs to that artist
     * @auther <panchal.amit9288@gmail.com>
     */

    public function list(Request $request)
    {
        try {
            $artists = Artist::with('albums')->get();
            if ($artists->isEmpty()) {
                return response()->json([
                    'status' => 'error',
                    'declaration' => 'record_not_found',
                ],
                    404);
            }
            if ($artists) {
                foreach ($artists as $artist) {
                    $artist->songs;
                }
            }
            $artistsArr = $artists->toArray();
            if (!empty($artistsArr)) {
                for ($i = 0; $i < count($artistsArr); $i++) {
                    $artistsArr[$i]['total_album'] = count($artistsArr[$i]['albums']);
                    $artistsArr[$i]['total_singles'] = count($artistsArr[$i]['songs']);
                    unset($artistsArr[$i]['albums']);
                    unset($artistsArr[$i]['songs']);
                }
            }
            return response()->json([
                'status' => 'success',
                'declaration' => 'found_data',
                'payload' => $artistsArr,
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
     * @Description  Get Artist with album and singles
     * @parameter  $request : integer id
     * @auther <panchal.amit9288@gmail.com>
     */

    public function listSingle(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'id' => 'required|integer'
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'declaration' => 'invalid_request',
                    'message' => $validator->errors(),
                ],
                    400);
            }
            $id = $request->get('id');
            $artists = Artist::with('albums')->where('id', $id)->get();
            if ($artists->isEmpty()) {
                return response()->json([
                    'status' => 'error',
                    'declaration' => 'record_not_found',
                ],
                    404);
            }
            if ($artists) {
                foreach ($artists as $artist) {
                    $artist->songs;
                }
            }
            return response()->json([
                'status' => 'success',
                'declaration' => 'found_data',
                'payload' => $artist,
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
