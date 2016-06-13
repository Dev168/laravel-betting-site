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

    public static function updateOdds(Bet $bet){
    	//Only works for 2 possible outcomes
    	$selectedOutcome = Outcome::where(['game_id' => $bet->game_id, 'outcome_name' => $bet->outcome_name])->first();
    	$selectedOutcome->outcome_odds = $selectedOutcome->outcome_odds - 0.05;
    	$selectedOutcome->save();

    	$otherOutcome = Outcome::getOppositeOutcome($bet->game_id, $bet->outcome_name);
    	$otherOutcome->outcome_odds = 20*$selectedOutcome->outcome_odds/(21*$selectedOutcome->outcome_odds - 20);
    	$otherOutcome->save();
    }

    public static function getOppositeOutcome($gameId, $currentOutcomeName){
    	return Outcome::where('game_id', $gameId)->where('outcome_name', '!=', $currentOutcomeName)->first();
    }
}
