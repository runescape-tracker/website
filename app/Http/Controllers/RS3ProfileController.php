<?php

namespace App\Http\Controllers;

use App\RS3Player;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RS3ProfileController extends Controller
{
    public function index(Request $request)
    {
        $rsn = $request->route()->parameter('rsn');

        $player = RS3Player::whereRsn($rsn)->first();

        if(!$player)
            abort('404', 'user_not_found');

        $skills = config('rs3.skills');

        $currentTrack = $player->currentTrack();
        $yesterdayTrack = $player->yesterdayTrack();
        $dayBeforeYesterdayTrack = $player->specificTrack((new Carbon())->subDays(2));

        return view('profile.rs3.index', compact('player', 'rsn', 'skills', 'currentTrack', 'yesterdayTrack', 'dayBeforeYesterdayTrack'));
    }
}
