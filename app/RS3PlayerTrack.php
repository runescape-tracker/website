<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RS3PlayerTrack extends Model
{
    protected $table = 'rs3_player_tracks';

    protected $primaryKey = 'player_id';
}
