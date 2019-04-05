<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OsPlayerTracks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        $activitiesList = config('os.activities');
        $skillsList = config('os.skills');

        Schema::create('os_player_tracks', function (Blueprint $table) use ($skillsList, $activitiesList) {
            $table->bigIncrements('id');
            $table->integer('player_id')->unsigned();

            foreach ($skillsList as $index => $skill) {
                $table->bigInteger(normalise_rs($skill) . "_xp");
                $table->integer(normalise_rs($skill) . "_rank");
                $table->integer(normalise_rs($skill) . "_level");
            }

            foreach ($activitiesList as $index => $activity) {
                $table->integer(normalise_rs($activity) . "_rank");
                $table->integer(normalise_rs($activity) . "_total");
            }

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('os_player_tracks');
    }
}
