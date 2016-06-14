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

    public function scopeWhereActive($query){
    	return $query->where('active', 1);
    }

    public static function createBet(Request $request){
    	$bet = new Bet;
    	$bet->user_id = Auth::id();
    	$bet->game_id = $request->gameId;
    	$bet->outcome_name = $request->outcome_name;
    	$bet->odds = $request->odds;
    	$bet->stake = $request->amount;
    	$bet->total_amount = $request->amount * $request->odds;
    	$bet->pending_amount = $request->amount * $request->odds;
    	$bet->save();
    	return $bet;
    }

    public static function matchBets(Bet $currentBet){
    	Bet::adjustVolume($currentBet);
    	Bet::fillPendingBets($currentBet);
    }

    public static function adjustVolume(Bet $currentBet){
    	$currentOutcome = Outcome::where(['game_id' => $currentBet->game_id, 'outcome_name' => $currentBet->outcome_name])->first();
    	$oppositeOutcome = Outcome::getOppositeOutcome($currentBet->game_id, $currentBet->outcome_name);
    	if($oppositeOutcome->total_volume_pending >= $currentOutcome->total_volume_pending){
    		$oppositeOutcome->total_volume_pending = $oppositeOutcome->total_volume_pending - $currentOutcome->total_volume_pending;
    		$currentOutcome->total_volume_pending = 0;
    	}
    	elseif($oppositeOutcome->total_volume_pending < $currentOutcome->total_volume_pending){
    		$currentOutcome->total_volume_pending = $currentOutcome->total_volume_pending - $oppositeOutcome->total_volume_pending;
    		$oppositeOutcome->total_volume_pending = 0;
    	}
		$oppositeOutcome->save();
    	$currentOutcome->save();
    }

    public static function fillPendingBets(Bet $currentBet){
    	$oppositeOutcomeName = Outcome::getOppositeOutcome($currentBet->game_id, $currentBet->outcome_name)->outcome_name;
    	$pendingBet = Bet::whereActive()->where([
    		'game_id' => $currentBet->game_id,
    		'outcome_name' => $oppositeOutcomeName,
    	])
    	->where('pending_amount', '>', 0)
    	->orderBy('odds', 'DESC')
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

    			//Repeat until $currentBet->pending_amount is 0
    			Bet::fillPendingBets($currentBet);
    		}
    	}
    }
}
