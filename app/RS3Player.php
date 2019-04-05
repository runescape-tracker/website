<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class RS3Player extends Model
{
    protected $table = 'rs3_players';

    protected $primaryKey = 'id';


    public function currentTrack()
    {
        return RS3PlayerTrack::where('player_id', $this->id)
            ->whereDate('created_at', '=', (new Carbon()))
            ->orderBy('id', 'DESC')
            ->limit(1)
            ->first();

    }

    public function yesterdayTrack()
    {
        return RS3PlayerTrack::where('player_id', $this->id)
                             ->whereDate('created_at', '=', (new Carbon())->yesterday())
                             ->orderBy('id', 'DESC')
                             ->limit(1)
                             ->first();
    }

    public function specificTrack($date)
    {
        $res = RS3PlayerTrack::where('player_id', $this->id)
                             ->whereDate('created_at', '=', $date)
                             ->orderBy('id', 'DESC')
                             ->limit(1)
                             ->first();

        return $res;
    }

    public function getTodaysTrack()
    {
        return $this->hasOne(RS3PlayerTrack::class, 'player_id', 'id')
                    ->where('created_at', Carbon::today())
                    ->orderBy('id', 'desc');
    }

}
