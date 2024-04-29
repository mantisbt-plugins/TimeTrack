<?php
$query = trim( $_REQUEST['query'] );
$ql = strlen($query);
$limit = substr( $query, -2 );
if ( $limit == "50" ) {
	$query = substr( $query, 0,-8 );
}

# Make sure that IE can download the attachments under https.
$t_export_title = "Export_Time_registrations";
header( 'Pragma: public' );
header( 'Content-Type: application/vnd.ms-excel' );
header( 'Content-Disposition: attachment; filename="' . $t_export_title . '.xls"' );
//header('Content-type: text/enriched');
//header("Content-Disposition: attachment; filename=Export_Time_registrations.csv");

?>
<html xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:x="urn:schemas-microsoft-com:office:excel"
xmlns="http://www.w3.org/TR/REC-html40">
<style id="Classeur1_16681_Styles">
</style>
<div id="Classeur1_16681" align=center x:publishsource="Excel">
<table x:str border=0 cellpadding=0 cellspacing=0 width=100% style='border-collapse:collapse'>

<tr>
  <td>Issue</td>
  <td>Summary</td>
  <td>Priority</td>
  <td>Category</td>
  <td>Severity</td>
  <td>Status</td>
  <td>Recorded</td>
  <td>User</td>
  <td>Information</td>
  <td>Allocation</td>
  <td>Hours</td>
 </tr>

<?php
# Pull all Tasks-Record entries for the current user
$result = db_query($query);
while ($t_row = db_fetch_array($result)) {
	?>
	<tr>

	<td><?php echo $t_row["id"] ?></td>
	<td><?php echo $t_row["summary"] ?></td>
	<td><?php echo get_enum_element( 'priority', $t_row["priority"]) ?></td>
	<td><?php echo $t_row["name"] ?></td>
	<td><?php echo get_enum_element( 'severity', $t_row["severity"]) ?></td>
	<td><?php echo get_enum_element( 'status', $t_row["status"]) ?></td>
	<td><?php echo substr($t_row["timestamp"],0,10) ?></td>
	<td><?php echo user_get_name($t_row["user"]) ?></td>
	<td><?php echo $t_row["info"] ?></td>
	<td><?php echo substr($t_row["expenditure_date"],0,10) ?></td>
	<td align="right"><?php echo number_format($t_row["hours"], 2, ',', '.') ?></td>
	</tr>
	<?php
}	
?>
<tr>
<td>You requested these records: </td>
</tr><tr>
<td><?php echo $query ?></td>
</tr>
</table>