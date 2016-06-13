<?php

namespace App\Models;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class Bet extends Model
{
    public function user(){
    	return $this->belongsTo('App\Models\User');
    }

    public function scopeAmountStillPending($query){
    	return $query->where('pending_amount', '!=', 0);
    }

    public static function createBet(Request $request){
    	$bet = new Bet;
    	$bet->user_id = Auth::id();
    	$bet->game_id = $request->gameId;
    	$bet->outcome_name = $request->outcome_name;
    	$bet->odds = $request->odds;
    	$bet->amount = $request->amount;
    	$bet->pending_amount = $request->amount;
    	$bet->save();
    	return $bet;
    }

    public static function matchBets(Bet $currentBet){
    	$oppositeOutcomeName = Outcome::getOppositeOutcome($currentBet->game_id, $currentBet->outcome_name)->outcome_name;
    	$pendingBet = Bet::where([
    		'game_id' => $currentBet->game_id, 
    		'outcome_name' => $oppositeOutcomeName, 
    		'odds' => $currentBet->odds
    	])
    	->amountStillPending()
    	->orderBy('created_at')
    	->first();

    	if($pendingBet){
	    	if($pendingBet->pending_amount >= $currentBet->pending_amount){
	    		$pendingBet->pending_amount = $pendingBet->pending_amount - $currentBet->pending_amount;
	    		$currentBet->pending_amount = 0;
	    		$pendingBet->save();
	    		$currentBet->save();
	    	}
	    	elseif($pendingBet->pending_amount < $currentBet->pending_amount){
	    		$currentBet->pending_amount = $currentBet->pending_amount - $pendingBet->pending_amount;
	    		$pendingBet->pending_amount = 0;
	    		$pendingBet->save();
	    		$currentBet->save();
	    		Bet::matchBets($currentBet);
	    	}
	    }
    }
}
