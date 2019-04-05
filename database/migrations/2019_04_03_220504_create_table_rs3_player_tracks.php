<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableRs3PlayerTracks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $activitiesList = config('rs3.activities');
        $skillsList = config('rs3.skills');

        Schema::create('rs3_player_tracks', function (Blueprint $table) use($skillsList, $activitiesList){
            $table->bigIncrements('id');
            $table->integer('player_id')->unsigned();

            foreach ($skillsList as $index => $skill)
            {
                $table->bigInteger(normalise_rs($skill) . "_xp")->default(0);
                $table->integer(normalise_rs($skill) . "_rank")->default(0);
                $table->integer(normalise_rs($skill) . "_level")->default(0);
            }

            foreach ($activitiesList as $index => $activity)
            {
                $table->integer(normalise_rs($activity) . "_rank")->default(0);
                $table->integer(normalise_rs($activity) . "_total")->default(0);
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
        Schema::dropIfExists('rs3_player_tracks');
    }
}
