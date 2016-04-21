<?php

/*

This Class is used to get the difference between time

AUTHOR 			: Reyan Celestial Tropia
Interface Name 	: TIME
Class Name 		: ComputeTime
				(NOTE: THIS CLASS SHOULD IMPLETEMENT ALL THE INTERFACE DECLARATION)

				Additional : This will compute the difference of time. Both of the time parameters can be used in any order. 
				E.G timeDiff(highTime , lowTime)
					timeDiff(lowTime , highTime)

*/

Interface Time{
	function timeDiff($from, $to); /*Returns a decimal type data e.g  1.5, 4.5*/
	function time(); /*Returns a formated date in human readable time*/
	function getHour($time); /*Returns Hour from the timeDiff by DEFAULT it will get from $return_val;*/
	function getMinute($time); /*Returns Minute from the timeDiff by DEFAULT it will get from $return_val*/
}


class ComputeTime implements Time
{
	private $return_val = ""; /* This var will receive the value from timeDiff (Raw Time in Decimal)*/

	function time(){


		/*format hours*/
		$hour = $this->getHour();
		$minute = $this->getMinute();

		return abs($hour).":".abs($minute);
	}

	

	function timeDiff($from, $to ){

	$t_from = strtotime($from);
	$t_to = strtotime($to);

	$time_diff = number_format(substr((($t_to) - ($t_from))/(60*60),0,4),2);


	$this->return_val = $time_diff;
	return $time_diff;
	}


	function getHour($time = null)
	{


	if(!$time)
	{
		$time = $this->return_val;
	}



	$array = explode('.', $time);

	/*return index 0 which is the hour*/
	return $array[0]; 
	}

	function getMinute($time = null)
	{
		/*if time is not invoke get the time computed from the properties of this parent*/
		if(!$time)
		{
			$time = $this->return_val;
		}

		$array = explode('.' , $time);
		$minute = str_pad(ceil(($array[1] / 100) * 60), 2 , '0' , STR_PAD_LEFT);

		/*return index 0 which is the minute*/
		return $minute; 
	}


}

/*
########################
###### HOW TO USE ######
########################
1. Declare the class as new object. e.g $x = new ComputeTime();
2. Fill data in timeDiff function; $x->timeDiff("5:00 AM" , "8:00 AM");
3. Get data using ->time() , ->getHour() , ->getMinute();

$x->time(); will output 3:00
$x->getHours(); will output 3
$x->getMinutes(); will output 00
*/



$x = new ComputeTime();

$x->timeDiff("9:30 AM" , "8:00 AM");

echo $x->time();
?>
