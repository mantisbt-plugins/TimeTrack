<?php
$query = trim( $_REQUEST['query'] );
$ql = strlen($query);
$limit = substr( $query, -2 );
if ( $limit == "50" ) {
	$query = substr( $query, 0,-8 );
}
$content ="";
$content .= lang_get('bug');
$content .= "|";
$content .= lang_get('summary');
$content .= "|"; 
$content .= lang_get('priority');
$content .= "|";
$content .= lang_get('category');
$content .= "|";
$content .= lang_get('severity');
$content .= "|";
$content .= lang_get('status');
$content .= "|";
$content .= lang_get('recorded');
$content .= "|";
$content .= lang_get('time_user');
$content .= "|";
$content .= lang_get('time_information') ;
$content .= "|";
$content .= lang_get('time_expenditure_date') ;
$content .= "|";
$content .= lang_get('time_hours');
$content .= "\r\n";

$result = db_query($query);
while ($t_row = db_fetch_array($result)) {
	$content .= $t_row["id"] ;
	$content .= "|";
	$content .= $t_row["summary"] ;
	$content .= "|";
	$content .= get_enum_element( 'priority', $t_row["priority"]) ;
	$content .= "|";
	$content .= $t_row["name"] ;
	$content .= "|";
	$content .= get_enum_element( 'severity', $t_row["severity"]) ;
	$content .= "|";
	$content .= get_enum_element( 'status', $t_row["status"]) ;
	$content .= "|";
	$content .= substr($t_row["timestamp"],0,10) ;
	$content .= "|";
	$content .= user_get_name($t_row["user"]) ;
	$content .= "|";
	$content .= $t_row["info"] ;
	$content .= "|";
	$content .= substr($t_row["expenditure_date"],0,10);
	$content .= "|";
	$content .= number_format($t_row["hours"], 2, ',', '.') ;
	$content .= "\r\n";
}	
$content .= "\r\n";
$content .= lang_get('selected_records');
$content .= "\r\n";
$content .= $query ;
header('Content-type: text/enriched');
header("Content-Disposition: attachment; filename=Export_Time_registrations.csv");
echo $content;
exit;
return;