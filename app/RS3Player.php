<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RS3Player extends Model
{
    protected $table = 'rs3_players';

    public function lastTrack()
    {
        return $this->hasOne(RS3PlayerTrack::class)->orderBy('id', 'desc')->limit(1);
    }
}
