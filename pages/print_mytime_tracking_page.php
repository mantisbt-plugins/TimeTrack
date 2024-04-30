<?php
########################################################
# Mantis Bugtracker plugin Time Track
#
# Based upon Time Tracker by Elmar Schumacher (elmar.schumacher@web.de)  GAMBIT Consulting GmbH
#
# converted to plugin for version 2.x
# Cas Nuy www.NUY.info 2010-2024
#
########################################################
auth_ensure_user_authenticated();
layout_page_header( lang_get( 'plugin_format_title' ) );
layout_page_begin( 'manage_overview_page.php' );
?>
<br />
<?php
$t_project_id       = 0;
$day_from = @$_REQUEST['day_from'];
$month_from = @$_REQUEST['month_from'];
$year_from = @$_REQUEST['year_from'];
$day_to = @$_REQUEST['day_to'];
$month_to = @$_REQUEST['month_to'];
$year_to = @$_REQUEST['year_to'];
$informer = auth_get_current_user_id();

echo '<br><br>';

?>
<form method="post" action="plugin.php?page=TimeTrack/print_mytime_tracking_page.php">

<?php 
echo lang_get( 'print_time_tracking_from' ) ;
$current_date = explode ("-", date("Y-m-d"));
?>

<select tabindex="2" name="day_from"><option value="0">-</option>
<?php print_day_option_list( $current_date[2] ) ?>
</select>

<select tabindex="3" name="month_from"><option value="0">-</option>
<?php print_month_option_list( $current_date[1] ) ?>
</select>
<select tabindex="4" name="year_from"><option value="0">-</option>
<?php print_year_option_list( $current_date[0] ) ?>
</select>
&nbsp;&nbsp;
<?php echo lang_get( 'print_time_tracking_to' ) ?>
<select tabindex="5" name="day_to"><option value="0">-</option>
<?php print_day_option_list( $current_date[2] ) ?>
</select>
<select tabindex="6" name="month_to"><option value="0">-</option>
<?php print_month_option_list( $current_date[1] ) ?>
</select>
<select tabindex="7" name="year_to"><option value="0">-</option>
<?php print_year_option_list( $current_date[0] ) ?>
</select>
<input tabindex="8" type="submit" name="Send" value="<?php echo lang_get( 'print_time_tracking_update' ) ?>" />
</td>
</tr>
<tr>
<td>
</td>
<td>
</td>
</tr>
</table>
</form>

<table class="table table-bordered table-condensed table-striped"> 	
<?php
$bug_table = db_get_table( 'bug' );
$user_table = db_get_table( 'user' );
$category_table = db_get_table( 'category' );
$time_table		= plugin_table('timelog');

$all_reported_bugs_query="select t.id,b.priority,b.id,b.category_id,c.name,b.severity,b.status,t.timestamp,b.summary,t.user,t.info,t.hours,t.expenditure_date from $time_table t,$bug_table b,$category_table c where t.bugid=b.id and b.category_id=c.id ";
$all_reported_bugs_query=$all_reported_bugs_query." and t.user=" . $informer;

if (!empty($day_from) && !empty($day_to) && !empty($month_from) && !empty($month_to) && !empty($year_from) && !empty($year_to)) {
  $all_reported_bugs_query=$all_reported_bugs_query." and t.expenditure_date between '" . $year_from . "-" . $month_from . "-" . $day_from . "' and '" . $year_to . "-" . $month_to . "-" . $day_to . "'"; 
}
$t_project_id = helper_get_current_project();

if ($t_project_id!=0) {
  $all_reported_bugs_query=$all_reported_bugs_query . " and b.project_id=".$t_project_id;
} 
$all_reported_bugs_query=$all_reported_bugs_query . " order by t.expenditure_date ";
if (empty($informer) && empty($day_from) && empty($day_to) && empty($month_from) && empty($month_to) && empty($year_from) && empty($year_to)){
	$all_reported_bugs_query=$all_reported_bugs_query . " limit 50 ";
	$notall=TRUE;
} else {
	$notall=FALSE;
}
?>
<tr>
<td class="form-title" colspan="2">
<?php echo lang_get( 'viewing_bugs_title' ) ?>    
</td>  
<?php
if ($notall){
	?>
	<td class="form-title" colspan="2">
    <?php echo "Not all results shown (Max 50)" ?>    
	</td>  
	<?php   
} 
?>
</tr>
<tr class="row-category">
<b>
<td><?php echo lang_get( 'priority' ) ?></td>
<td><?php echo lang_get( 'id' ) ?></td>
<td><?php echo lang_get( 'category' ) ?></td>
<td><?php echo lang_get( 'severity' ) ?></td>
<td><?php echo lang_get( 'status' ) ?></td>
<td><?php echo lang_get( 'recorded' ) ?></td>
<td><?php echo lang_get( 'summary' ) ?></td>
<td><?php echo lang_get( 'time_user' ); ?></td>
<td><?php echo lang_get( 'time_information' ); ?></td>
<td><?php echo lang_get( 'time_expenditure_date' ); ?></td>
<td><?php echo lang_get( 'time_hours' ); ?></td>
</b>
</tr>
<tr>
<td class="spacer" colspan="11">&nbsp;</td>
</tr>
<?php
$result_timerecords = db_query($all_reported_bugs_query);
$num_timerecords = db_num_rows( $result_timerecords );
$total_hours=0;
for( $i=0; $i < $num_timerecords; $i++ ) {
    $t_row = db_fetch_array( $result_timerecords );
    $total_hours+=$t_row['hours'];    
?>
	<tr >  
	<td><?php echo get_enum_element( 'priority', $t_row["priority"]) ?></td>
	<td><a href="view.php?id=<?php echo $t_row["id"] ?>"><?php echo bug_format_id( $t_row["id"]) ?></a></td>
	<td><?php echo $t_row["name"] ?></td>
	<td><?php echo get_enum_element( 'severity', $t_row["severity"]) ?></td>
	<td><?php echo get_enum_element( 'status', $t_row["status"]) ?></td>
	<td><?php echo substr($t_row["timestamp"],0,10) ?></td>
	<td><?php echo $t_row["summary"] ?></td>
	<td><?php echo user_get_name($t_row["user"]) ?></td>
	<td><?php echo $t_row["info"] ?></td>
	<td><?php echo substr($t_row["expenditure_date"],0,10) ?></td>
	<td align="right"><?php echo number_format($t_row["hours"], 2, ',', '.') ?></td>
	</tr>
<?php
} 
?>
<tr class="row-category">
<?php
$dl_link1 = "plugin.php?page=TimeTrack/tt_xls.php&query=";
$dl_link1 .= $all_reported_bugs_query;
$dl_link2 = "plugin.php?page=TimeTrack/tt_csv.php&query=";
$dl_link2 .= $all_reported_bugs_query;
?>
<td><a href="<?php echo $dl_link1 ?>"><?php echo lang_get( 'timetrack_xls') ?></a></td> 
<td></td>
<td><a href="<?php echo $dl_link2 ?>"><?php echo lang_get( 'timetrack_xls') ?></a></td> 
<td colspan="7" align="right"><b><?php echo lang_get( 'timetrack_total') ?></b></td><td align="right"><?php echo number_format($total_hours,2,',','.') ?></td></tr>
<input type="hidden" name="show_flag" value="1" />
</table>
<br>
</form>
<?php
layout_page_end();
