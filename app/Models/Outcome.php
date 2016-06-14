<?php

namespace App\Models;

use App\Models\Bet;
use App\Models\Outcome;
use Illuminate\Database\Eloquent\Model;

class Outcome extends Model
{
    public function game(){
    	return $this->belongsTo('App\Models\Game');
    }

    public static function updateOutcomes(Bet $bet){
    	//Only works for 2 possible outcomes
    	$currentOutcome = Outcome::where(['game_id' => $bet->game_id, 'outcome_name' => $bet->outcome_name])->first();
    	$currentOutcome->outcome_odds = $currentOutcome->outcome_odds - 0.05;
    	$currentOutcome->total_volume_pending = $currentOutcome->total_volume_pending + $bet->stake * $bet->odds;
    	$currentOutcome->save();

    	$oppositeOutcome = Outcome::getOppositeOutcome($bet->game_id, $bet->outcome_name);
    	$oppositeOutcome->outcome_odds = 20*$currentOutcome->outcome_odds/(21*$currentOutcome->outcome_odds - 20);
    	$oppositeOutcome->save();
    }

    public static function getOppositeOutcome($gameId, $currentOutcomeName){
    	return Outcome::where('game_id', $gameId)->where('outcome_name', '!=', $currentOutcomeName)->first();
    }
}
