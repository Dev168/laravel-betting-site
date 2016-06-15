<?php

namespace App\Models;

use Auth;
use App\Models\Bet;
use App\Models\User;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'account_balance',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function bets(){
        return $this->hasMany('App\Models\Bet');
    }

    public static function updateAccountBalance(Bet $bet){
        $user = User::find(Auth::id());
        $user->account_balance = $user->account_balance - $bet->stake;
        $user->save();
    }
}
