<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Artist;
use App\Models\Album;

class AlbumSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        /*
         * Each Artist should have atleast two album
         */
        $allArtistArr = Artist::get()->toArray();
        if (!empty($allArtistArr)) {
            foreach ($allArtistArr as $artist) {
                for ($i = 1; $i <= 2; $i++) {
                    $albumName = ucwords($artist['name'] . "'s " . $i . " Album");
                    Album::firstOrCreate(['name' => $albumName,
                        'year' => 2022,
                        'artist_id' => $artist['id']
                    ]);
                }
            }
        }
    }

}
