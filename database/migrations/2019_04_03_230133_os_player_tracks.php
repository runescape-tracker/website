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
                $table->bigInteger($this->clearNames($skill) . "_xp");
                $table->integer($this->clearNames($skill) . "_rank");
                $table->integer($this->clearNames($skill) . "_level");
            }

            foreach ($activitiesList as $index => $activity) {
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
        Schema::dropIfExists('os_player_tracks');
    }
}
