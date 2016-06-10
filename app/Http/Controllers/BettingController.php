<?php

namespace App\Http\Controllers;

use App\Models\Bet;
use App\Models\Game;
use App\Http\Requests;
use Illuminate\Http\Request;

class BettingController extends Controller
{
    public function index(){
    	return view('betting.index')->with('games', Game::all());
    }

    public function show($id){

    }
}
