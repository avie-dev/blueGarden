<?php
namespace Model;
class Calendar extends \Model {

  public static function display_year($selected_month)
  {
	$now = date($selected_month);//,strtotime($now));
	$year = date("Y",strtotime($now));
	return $year;
  }
  
  public static function display_month($selected_month)
  {
	$now = date($selected_month);
	$month = date("m",strtotime($now));
	return $month;
  }
  
  public static function display_day($selected_month)
  {
	$days = array();
	$month = date("m",strtotime($selected_month));
    $year = date("Y",strtotime($selected_month));
	
	$first = date('Y-m-d', mktime(0, 0, 0, $month, 1, $year));
    $last = date('Y-m-t', mktime(0, 0, 0, $month, 1, $year));

    $thisTime = strtotime($first);
    $endTime = strtotime($last);
	
	while($thisTime <= $endTime)
      {
        $days[] = date('d', $thisTime);
        $thisTime = strtotime('+1 day', $thisTime); // increment for loop
      }
	  return $days;
  }
  
  public static function display_dayofweek($datelist)
  {
	//$selected_month = date('2014-02-04');
	$time = strtotime($datelist);
  	$w = date("w", $time);
	$weekday = array( "日", "月", "火", "水", "木", "金", "土" );
	
	return $weekday[$w];
  }
  
}