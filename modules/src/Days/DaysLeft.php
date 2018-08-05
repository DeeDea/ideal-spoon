<?php

namespace Drupal\agiledrop\Days;

use Drupal\Core\Datetime\DrupalDateTime;

class DaysLeft{
	
	//function for calculating the day difference
	public function eventDays($days){
		//setting the default timezone
		date_default_timezone_set('Europe/Ljubljana'); 
		//setting the current and event date with Drupal DateTime object
		$currdate=new DrupalDateTime();
		$eventdate=new DrupalDateTime($days);
		
		//calculating the difference between dates with diff()
		/* %R positive or negative number 
		 * %a total number of days as a result of a DateTime::diff() or (unknown) otherwise in php */
		$diff = $currdate->diff($eventdate)->format('%R%a');
		
		//returning the block msg, depending on the result
		if ($diff>=1) {
			return "Days left to event start: <b>".$diff."</b>";
		} 
		if($diff==0) {
			return "The event is in progress";
		} 
		if ($diff<=0) {
			return "The event has ended";
		}
		else {
			return "There has been an error";
		}
		
	}
}

