<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    public function outcomes(){
    	return $this->hasMany('App\Models\Outcome');
    }
}
