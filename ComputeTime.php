<?php

/*

This Class is used to get the difference between time

AUTHOR 			: Reyan Celestial Tropia
Interface Name 	: TIME
Class Name 		: ComputeTime
				(NOTE: THIS CLASS SHOULD IMPLETEMENT ALL THE INTERFACE DECLARATION)

				MINUTES MUST BE DECLARE WITH 0 IF LESS THAN 10
				E.G 01 02 03 04
				DONT USE MINUTES LIKE 8:1 AM 

*/

Interface Time{
	function timeDiff($from, $to); /*Returns a decimal type data e.g  1.5, 4.5*/
	function time(); /*Returns a formated date in human readable time*/
	function getHour($time); /*Returns Hour from the timeDiff by DEFAULT it will get from $return_val;*/
	function getMinute($time); /*Returns Minute from the timeDiff by DEFAULT it will get from $return_val*/
	function raw();
}


class ComputeTime implements Time
{
	private $return_val = ""; /* This var will receive the value from timeDiff (Raw Time in Decimal)*/
	private $raw_val = 0;
	private $schedule = array();

	function time(){


		/*format hours*/
		$hour = $this->getHour();
		$minute = $this->getMinute();

		return $hour.":".$minute;
	}


	function raw()
	{
		return number_format($this->raw_val,2);
	}



	/*this is used to compute the break time*/
	function setSchedule($sched = array(null , null , null , null))
	{
		$this->schedule['AMIn'] = $sched[0];
		$this->schedule['AMOut'] = $sched[1];
		$this->schedule['PMIn'] = $sched[2];
		$this->schedule['PMOut'] = $sched[3];
	}

	function getSchedule()
	{
		return var_dump($this->schedule);
	}

	/*the last hour in*/
	function breaktime($hTo){

		/*OUT IS LESS THAN AMOut*/
		if(strtotime($hTo) < strtotime($this->schedule['AMOut']))
		{
			return 0; /*no deductions because it is MORNING UNDERTIME*/
		}
		/*OUTIS LESS THAN PMIn*/
		else if(strtotime($hTo) < strtotime($this->schedule['PMIn']))
		{
			$break = strtotime($hTo) - strtotime($this->schedule['AMOut']);
			return abs($break); /*e.g 1:00 PM - 12:30 OUT*/
		}
		/*OUT IS GREATER THAN PMIn*/
		else if( strtotime($hTo) > strtotime($this->schedule['PMIn']))
		{
			$break = strtotime($this->schedule['PMIn']) - strtotime($this->schedule['AMOut']);
			return $break;
		}
		else
		{
			return 0; /* default*/
		}

	}

	
	/*break parameter consist of from & to logic*/
	function timeDiff($from, $to , $withBreakTime = true){

	$t_from = strtotime($from);
	$t_to = strtotime($to);
	
	if($withBreakTime == true)
	{

	$mbreak = $this->breaktime($to);
	}

	else
	{
		$mbreak = 0;
	}

	/*$time_diff = number_format(substr((($t_to) - ($t_from))/(60*60),0,4),2);*/
	$time_diff = number_format(((($t_to) - ($t_from)) - $mbreak)/(60*60) ,2);

	$raw_time = ($t_to - $t_from) / (60*60);


	$this->return_val = $time_diff;
	$this->raw_val = $raw_time;
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
	return str_pad($array[0], '0' ,STR_PAD_LEFT); 
	}

	function getMinute($time = null)
	{
		/*if time is not invoke get the time computed from the properties of this parent*/
		if(!$time)
		{
			$time = $this->return_val;
		}

		$array = explode('.' , $time);
		$minute = str_pad(number_format((($array[1] / 100) * 60),0), 2 , '0' , STR_PAD_LEFT);

		/*return index 0 which is the minute*/
		return str_pad($minute, '0',STR_PAD_LEFT); 
	}


}

/*
########################
###### HOW TO USE ######
########################
1. Declare the class as new object. e.g $x = new ComputeTime();
	=>>> IF YOU NEED TO COMPUTE DEDUCTION SET THE WORK SCHEUDLE THIS CLASS WILL DETECT THE PROPER DEDUCTION
2. Fill data in timeDiff function; $x->timeDiff("5:00 AM" , "8:00 AM");
3. Get data using ->time() , ->getHour() , ->getMinute();

$x->time(); will output 3:00
$x->getHours(); will output 3
$x->getMinutes(); will output 00
*/



$x = new ComputeTime();

/*$x->timeDiff("8:00 AM" , "8:59 AM");*/ /*1:59hrs 1.98*/
/*$x->timeDiff("1:00 PM" , "1:59 PM") ; *//*0.75*/


/*echo $x->time();*/

?>