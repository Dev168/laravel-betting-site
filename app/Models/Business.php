<?php

namespace App\Models;

use App\Models\Bet;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    protected $table = 'business_data';

    public static function bankBalance(){
    	return Business::where('name', 'business_bank_balance')->first()->value;
    }

    public static function updateBankBalance($value){
    	$businessData = Business::where('name', 'business_bank_balance')->first();
    	$businessData->value = $businessData->value + $value;
    	$businessData->save();
    }
}
