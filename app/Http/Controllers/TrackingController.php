<?php

namespace App\Http\Controllers;

use App\Http\Requests\TrackRequest;
use App\OSPlayer;
use App\RS3Player;
use App\Traits\GameTypes;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    public function track(TrackRequest $request) {

        $track = $request->input('rsn');
        $gameType = $request->input('game', 'rs3');

        if($gameType === GameTypes::RS3)
        {
            $found = RS3Player::whereRsn($track)->first();
            $type = 'rs3';

            if(!$found)
            {
                $found = new RS3Player();
                $found->rsn = $track;
                $found->save();
            }

        }
        else if($gameType === GameTypes::OS)
        {
            $found = OSPlayer::whereRsn($track)->first();
            $type = 'os';

            if(!$found)
            {
                $found = new OSPlayer();
                $found->rsn = $track;
                $found->save();
            }
        }

        return response()->redirectToRoute("profile.{$type}", [
            'rsn'   =>  $track
        ]);
    }
}
