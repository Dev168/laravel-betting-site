<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Bet;
use App\Models\Game;
use App\Http\Requests;
use Illuminate\Http\Request;

class BettingController extends Controller
{
    public function index(){
    	return view('betting.index')->with('games', Game::with('outcomes')->get());
    }

    public function show($id){
    	if($game = Game::with('outcomes')->find($id)){
    		return view('betting.show')->with(compact('game'));
    	}
    	return redirect('/');
    }

    public function store(Request $request){
    	$this->validate($request, [
    		"outcome_name" => "required|string",
    		"odds" => "required|within_percentage:".$request->outcome_name.",".$request->odds.",10",
    		"amount" => "required|numeric|min:1"
    	]);

    	$bet = new Bet;
    	$bet->user_id = Auth::id();
    	$bet->game_id = $request->gameId;
    	$bet->outcome_name = $request->outcome_name;
    	$bet->odds = $request->odds;
    	$bet->amount = $request->amount;
    	$bet->pending_amount = $request->amount;
    	$bet->save();
    }
}
