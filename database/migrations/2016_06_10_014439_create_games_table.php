<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->increments('id');
            $table->string('game_name');
            $table->dateTime('game_start_time');
            $table->string('outcome_1_name');
            $table->string('outcome_2_name');
            $table->decimal('outcome_1_odds', 8, 2);
            $table->decimal('outcome_2_odds', 8, 2);
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
        Schema::drop('games');
    }
}
