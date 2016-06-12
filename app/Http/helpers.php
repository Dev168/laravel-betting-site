<?php
function absolutePercentageDifference($number1, $number2){
	$difference = $number2 - $number1;
	if($difference == 0){
		return 0;
	}
	else{
		$percentageDifference = 1 / ($number1 / $difference);
		return abs($percentageDifference * 100);
	}
}