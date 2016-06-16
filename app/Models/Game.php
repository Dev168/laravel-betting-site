<?php

namespace App\Models;

use App\Models\Outcome;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    public function outcomes(){
    	return $this->hasMany('App\Models\Outcome');
    }

    public function bets(){
    	return $this->hasMany('App\Models\Bets');
    }

    public function winner(){
    	return $this->hasOne('App\Models\Outcome');
    }

    public static function end($gameId, $winningOutcome){
    	$game = Game::find($gameId);
        $game->status = 'ended';
        $game->winning_outcome_id = Outcome::where(['game_id' => $gameId, 'outcome_name' => $winningOutcome])->first()->id;
        $game->save();
    }
}
