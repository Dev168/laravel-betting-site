<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Bet;
use App\Models\User;
use App\Http\Requests;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function bets(){
    	$bets = Bet::where('user_id', Auth::id())->orderBy('game_id', 'DESC')->get();
    	return view('user.bets')->with(compact('bets'));
    }
}
