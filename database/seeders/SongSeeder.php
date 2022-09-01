<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Artist;
use App\Models\Album;
use App\Models\Song;

class SongSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        /*
         * Each Album should have atleast five songs
         */
        $allAlbumsArr = Album::get()->toArray();
        if (!empty($allAlbumsArr)) {
            foreach ($allAlbumsArr as $album) {
                for ($i = 1; $i <= 5; $i++) {
                    $songName = ucwords($album['name'] . "'s " . $i . "Album's Song");
                    Song::firstOrCreate(['name' => $songName,
                        'year' => 2022,
                        'songable_type' => 'App\Models\Album',
                        'songable_id' => $album['id']
                    ]);
                }
            }
        }
        /*
         * Each Artist should have atleast two songs
         */
        $allArtistArr = Artist::get()->toArray();
        if (!empty($allArtistArr)) {
            foreach ($allArtistArr as $artist) {
                for ($i = 1; $i <= 2; $i++) {
                    $songName = ucwords($artist['name'] . "'s " . $i . " Single");
                    Song::firstOrCreate(['name' => $songName,
                        'year' => 2022,
                        'songable_type' => 'App\Models\Artist',
                        'songable_id' => $artist['id']
                    ]);
                }
            }
        }
    }

}
