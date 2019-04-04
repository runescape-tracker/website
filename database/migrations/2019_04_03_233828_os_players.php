<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OsPlayers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('os_players', function(Blueprint $blueprint)
        {
            $blueprint->increments('id');
            $blueprint->string('rsn');
            $blueprint->integer('interval')->default(600);
            $blueprint->dateTime('next_track')->nullable();
            $blueprint->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('os_players');
    }
}
