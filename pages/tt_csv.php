<?php
$query = trim( $_REQUEST['query'] );
$ql = strlen($query);
$limit = substr( $query, -2 );
if ( $limit == "50" ) {
	$query = substr( $query, 0,-8 );
}
$content ="";
$content .= "Issue";
$content .= "|";
$content .= "Summary";
$content .= "|"; 
$content .= "Priority";
$content .= "|";
$content .= "Category";
$content .= "|";
$content .= "Severity";
$content .= "|";
$content .= "Status"; 
$content .= "|";
$content .= "Recorded";
$content .= "|";
$content .= "User";
$content .= "|";
$content .= "Information";
$content .= "|";
$content .= "Allocation";
$content .= "|";
$content .= "Hours";
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
$content .= "You requested these records: ";
$content .= "\r\n";
$content .= $query ;
header('Content-type: text/enriched');
header("Content-Disposition: attachment; filename=Export_Time_registrations.csv");
echo $content;
exit;
return;