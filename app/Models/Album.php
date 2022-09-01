<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'album';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'name', 'year', 'artist_id', 'created_at', 'updated_at'];

    /*
     * Get all of album's songs
     */

    public function songs()
    {
        return $this->morphMany(Song::class, 'songable');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function artist()
    {
        return $this->belongsTo('App\Models\Artist', 'artist_id');
    }

}
