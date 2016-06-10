<?php

namespace App\Http\Controllers;

use App\Models\Bet;
use App\Models\Game;
use App\Http\Requests;
use Illuminate\Http\Request;

class GamesController extends Controller
{
    public function index(){
    	return view('games.index')->with('games', Game::all());
    }

    public function show($id){
    	$game = Game::find($id);
    	if($game){
    		return view('games.show')->with(compact('game'));
    	}
    	return redirect('/');
    }

    public function store(Request $request){
    	$this->validate($request, [
    		'game_name' => 'required|string|unique:games|max:255',
    		'outcome_1_name' => 'required|string|max:255',
    		'outcome_2_name' => 'required|string|max:255',
    	]);

    	$game = new Game;
    	$game->game_name = $request->game_name;
    	$game->outcome_1_name = $request->outcome_1_name;
    	$game->outcome_2_name = $request->outcome_2_name;
    	$game->outcome_1_odds = 1.95;
    	$game->outcome_2_odds = 1.95;
    	$game->save();

    	return redirect('/games');
    }
}
