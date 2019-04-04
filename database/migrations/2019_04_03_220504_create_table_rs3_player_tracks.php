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

            foreach ($skillsList as $index => $skill)
            {
                $table->integer($this->clearNames($skill) . "_xp");
                $table->integer($this->clearNames($skill) . "_rank");
                $table->integer($this->clearNames($skill) . "_level");
            }

            foreach ($activitiesList as $index => $activity)
            {
                $table->integer($this->clearNames($activity) . "_rank");
                $table->integer($this->clearNames($activity) . "_total");
            }

            $table->timestamps();
        });
    }



    private function clearNames($name)
    {
        $name = strtolower($name);
        $name = str_ireplace([
            '.',
            ':',
        ], '', $name);
        $name = str_ireplace(' ', '_', $name);
        return $name;
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
