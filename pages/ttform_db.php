<?php
$bug_id		= gpc_get_int( 'id' );
$create_his	= plugin_config_get('timetrack_history');
$maxrec 	= plugin_config_get('timetrack_maxrec');
$user = auth_get_current_user_id();
$time_info = db_prepare_string($_REQUEST["time_info"]);

# Work on Time-Entry so we can eval it
$time_value = $_REQUEST["time_value"];
$time_value = strtr( $time_value, ",", ".");
$time_value = doubleval($time_value);
$time_unit = $_REQUEST["time_unit"];
		
# Trigger in case of non-evaluatable entry
if ( $time_value == 0 ) {
	trigger_error( lang_get( 'time_value_error' ), ERROR );
}
		
# Converting mandays into hours for unified database values
if($_REQUEST["time_unit"] == "md"){
	$time_value = $time_value * plugin_config_get('consultant_manday_definition');
}
		
# For record-keeping we also calc the costs according to the hourly charges 
$costs = $time_value * plugin_config_get('consultant_hourly_charge');
	
# Write Post-Data to DB
$year = $_REQUEST["year"];
$month = $_REQUEST["month"];
$day = $_REQUEST["day"];
$year1 = $_REQUEST["year1"];
$month1 = $_REQUEST["month1"];
$day1 = $_REQUEST["day1"];
$bookdate = mktime(0, 0, 0, $month,$day,$year);
$bookdate1 = mktime(0, 0, 0, $month1,$day1,$year1);
if ($bookdate1<$bookdate){
	$bookdate1=$bookdate;
}
while  ($bookdate<=$bookdate1){
	$bookdate2  = date("Y", $bookdate);
	$bookdate2 .= "-"; 
	$bookdate2 .= date("m", $bookdate);
	$bookdate2 .= "-"; 
	$bookdate2 .= date("d", $bookdate);
	$query = "INSERT INTO {plugin_TimeTrack_timelog}
   		( user, bugid, expenditure_date, hours, costs, time_unit, timestamp, info )
  		VALUES
   		( '$user', '$bug_id', '$bookdate2', '$time_value', '$costs', '$time_unit', NOW(), '$time_info')";
	if(!db_query($query)){
		trigger_error( ERROR_DB_QUERY_FAILED, ERROR );
	}
	$bookdate = calcduedate($bookdate,1);
	// function above can be replaced with
	/*
		$bookdate += 86400; // Add a day.
		$date_info  = getdate($bookdate);
		if ($date_info["wday"] == 0)    {
			$bookdate += 86400; // Add a day.
		}
		if  ($date_info["wday"] == 6)  {
			$bookdate += 172800; // Add 2 days
		}
		*/
}	
# Event is logged in the project
if ( ON == $create_his ) {
	history_log_event_direct( $bug_id, lang_get( 'time_tracking_history' ). ": " . $time_info, "$day.$month.$year: $time_value h.", "set", $user );
}

print_header_redirect( 'view.php?id='.$bug_id.'' );	