<?php

namespace App\Http;

use App\Models\Outcome;

class CustomValidator{
	//Example call: "odds" => "within_percentage:".$request->outcome_name.",10"
	public function validateWithinPercentage($attribute, $value, $parameters, $validator){
		$outcomeName = $parameters[0];
		$requestOdds = $parameters[1];
		$percentage = $parameters[2];

		$outcome = Outcome::select('outcome_odds')->where('outcome_name', $outcomeName)->first();

		if(absolutePercentageDifference($requestOdds, $outcome->outcome_odds) < $percentage){
			return true;
		}
		return false;
	}
}