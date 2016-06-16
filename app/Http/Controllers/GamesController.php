<?php

namespace App\Http\Controllers;

use DB;
use Carbon\Carbon;
use App\Models\Bet;
use App\Models\Game;
use App\Http\Requests;
use App\Models\Outcome;
use Illuminate\Http\Request;

class GamesController extends Controller
{
    public function index(){
    	return view('games.index')->with('games', Game::all());
    }

    public function show($id){
    	if($game = Game::with('outcomes')->find($id)){
    		$pendingBets = Bet::where('game_id', $id)->where('pending_amount', '>', 0)->orderBy('odds', 'desc')->get();
    		$filledBets = Bet::where('game_id', $id)->where('pending_amount', 0)->orderBy('odds', 'desc')->get();
    		$outcomes = Outcome::select('outcome_name', 'total_volume_pending')->where('game_id', $id)->get();
    		return view('games.show')->with(compact('game', 'pendingBets', 'filledBets', 'outcomes'));
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
    	$game->save();

        DB::table('outcomes')->insert([
            ['game_id' => $game->id, 'outcome_name' => $request->outcome_1_name, 'outcome_odds' => 1.95, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['game_id' => $game->id, 'outcome_name' => $request->outcome_2_name, 'outcome_odds' => 1.95, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);

    	return redirect('/games');
    }

    public function declareWinner(Request $request){
        Bet::deactivateUnfilledBets($request->gameId);
        Bet::updateWinningBets($request->gameId, $request->winningOutcome);
        Bet::updateLosingBets($request->gameId, $request->winningOutcome);
        Game::end($request->gameId, $request->winningOutcome);
        return redirect()->back();
    }
}
