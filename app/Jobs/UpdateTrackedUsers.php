<?php

namespace App\Jobs;

use App\RS3Player;
use App\RS3PlayerTrack;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UpdateTrackedUsers implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $p = RS3Player::where('next_track', '<', Carbon::now())
                      ->orWhereNull('next_track');

        foreach($p->cursor() as $player) {

            $this->handleTrack($player);

        };
    }

    private function handleTrack($player)
    {
        $hiscore = new \RunescapeTracker\RunescapePlayerApi\RS3Player($player->rsn);
        $hiscore->getHiscore();

        $rs3Track = new RS3PlayerTrack();
        $rs3Track->player_id = $player->id;

        foreach($hiscore->player()['skills'] as $skill => $rankings)
        {
            $rs3Track->{strtolower($skill) . "_rank"} = $rankings['rank'] === "-1" ? 0 : $rankings['rank'];
            $rs3Track->{strtolower($skill) . "_level"} = $rankings['level'] === "-1" ? 0 : $rankings['level'];
            $rs3Track->{strtolower($skill) . "_xp"} = $rankings['experience'] === "-1" ? 0 : $rankings['experience'];
        }

        $rs3Track->save();

        $player->next_track = (new Carbon())->addSeconds($player->interval);
        $player->save();
    }
}
