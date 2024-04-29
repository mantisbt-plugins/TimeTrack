<?php
$create_his	= plugin_config_get('timetrack_history');
$maxrec 	= plugin_config_get('timetrack_maxrec');
$user = auth_get_current_user_id();
$bug_id		= gpc_get_int( 'id' );
$delete_id = $_REQUEST['delete_id'];
if ( access_has_bug_level( plugin_config_get( 'timetrack_delete_threshold' ), $bug_id ) ) {
	$query_pull_timerecords = "SELECT * FROM {plugin_TimeTrack_timelog} WHERE id = $delete_id ORDER BY expenditure_date DESC";
	$result_pull_timerecords = db_query($query_pull_timerecords);
	$row = db_fetch_array( $result_pull_timerecords );
	$query_delete = "DELETE FROM {plugin_TimeTrack_timelog} WHERE id = $delete_id";        
	db_query($query_delete);
	# Event is logged in the project
	if ( ON == $create_his ) {
		history_log_event_direct( $bug_id, lang_get( 'time_tracking_history' ). " " . lang_get('time_tracking_deleted') . ": " . $row['info'], date("d.m.Y", strtotime($row["expenditure_date"])) . ": " . number_format($row["hours"], 2, ',', '.') . " h.", "deleted", $user );
	}
}

print_header_redirect( 'view.php?id='.$bug_id.'' );
