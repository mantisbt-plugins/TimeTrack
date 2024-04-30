<?php
########################################################
# Mantis Bugtracker Plugin TimeTrack
#
########################################################
$bug_id		= gpc_get_int( 'id' );
$maxrec 	= plugin_config_get('timetrack_maxrec');

# Get Sum for this bug
$query_pull_costs_hours = "SELECT SUM(costs) as costs, SUM(hours) as hours FROM {plugin_TimeTrack_timelog} WHERE bugid = $bug_id";
$result_pull_costs_hours = db_query($query_pull_costs_hours);
$row_pull_costs_hours = db_fetch_array( $result_pull_costs_hours );		

?>
<div class="col-md-12 col-xs-12">
<div class="space-10"></div>
<div class="form-container" > 

	<div class="widget-box widget-color-blue2">
	<div class="widget-header widget-header-small">
	<h4 class="widget-title lighter">
		<i class="ace-icon fa fa-text-width"></i>
		<?php echo "Time recording:"  ?>
	</h4>
</div>
<div class="widget-body">
<div class="widget-main no-padding">
<div class="table-responsive"> 
<table class="table table-bordered table-condensed table-striped"> 	

	<tr>
	<td class="center" colspan="6">
	<br>
<?php 
	$colspan=6;
?>
    <tr>
    <td colspan="<?php echo $colspan ?>" class="row-category"><div align="left"><a name="timerecord"></a>
	<?php 
	echo lang_get( 'time_tracking' ); 
	echo " ";
	echo "<i>";
	echo lang_get( 'time_maxrec' ); 
	echo $maxrec;
	echo "</i>";
	?>
	</div>
    </td>
    </tr>
    <tr class="row-category">
    <td><div align="center"><?php echo lang_get( 'time_user' ); ?></div>
    </td>
    <td><div align="center"><?php echo lang_get( 'time_expenditure_date' ); ?></div>
    </td>
    <td><div align="center"><?php echo lang_get( 'time_hours' ); ?>/<?php echo lang_get( 'time_mandays' ); ?></div>
    </td>
    <td><div align="center"><?php echo lang_get( 'time_information' ); ?></div>
    </td>
<?php if ( access_has_bug_level( plugin_config_get( 'timetrack_delete_threshold' ), $bug_id ) ) { ?>
      <td><div align="center"><?php echo lang_get( 'time_costs_auto' ); ?></div>
      </td> 
<?php } ?>
    <td><div align="center"><?php echo lang_get( 'time_entry_date' ); ?></div>
    </td>
    <td>&nbsp;</td>
    </tr>
<?php
	if ( access_has_bug_level(plugin_config_get( 'timetrack_add_threshold' ), $bug_id ) ) { 
?>
		<form name="time_tracking" method="post" action="plugin.php?page=TimeTrack/ttform_db.php">
		<?PHP # Nesessary Parameter. Due to base inconsistency we have a double entry ?>
		<input type="hidden" name="bug_id" value="<?php echo $bug_id;  ?>">
		<input type="hidden" name="id" value="<?php echo $bug_id;  ?>">
	    <tr >
		<?php
		if ( access_has_bug_level(plugin_config_get( 'report_other_threshold' ), $bug_id ) ) { 
			?><td> <select tabindex="1" name="informer"><option value="0"><?php echo lang_get( 'print_time_tracking_all_informers' ) ?>
			<?php print_user_option_list( auth_get_current_user_id() ) ?>
			</select></td>
			<?php
		} else {
		?>
		<td><?php echo user_get_name( auth_get_current_user_id() ) ?></td>
		<?php } ?>
		<td nowrap>
        <div align="center">
<?php 
         $current_date = explode ("-", date("Y-m-d"));
?>
        <select tabindex="2" name="day">
        <?php print_day_option_list( $current_date[2] ) ?>
        </select>
        <select tabindex="3" name="month">
        <?php print_month_option_list( $current_date[1] ) ?>
        </select>
        <select tabindex="4" name="year">
        <?php print_year_option_list( $current_date[0] ) ?>
        </select>
        <br>
        <select tabindex="5" name="day1">
        <?php print_day_option_list( $current_date[2] ) ?>
        </select>
        <select tabindex="6" name="month1">
        <?php print_month_option_list( $current_date[1] ) ?>
        </select>
        <select tabindex="7" name="year1">
        <?php print_year_option_list( $current_date[0] ) ?>
        </select>
		</div>
		</td>
		<td><table class="table table-bordered table-condensed table-striped"> 	
        <tr>
        <td><div align="right">
        <select tabindex="8" name="time_unit">
        <option value="hr" selected><?php echo lang_get( 'time_hours' ) ?></option>
        <option value="md"><?php echo lang_get( 'time_mandays' ) ?></option>
        </select>
        </div>
        </td>
        <td><div align="left">
        <input tabindex="9" name="time_value" type="text">
        </div>
        </td>
        </tr>
        </table>
		</td>
		<td><div align="center">
        <input tabindex="10" type="text" name="time_info">
        </div>
		</td>
		<td>
		</td>
		<td><input tabindex="11" name="<?php echo lang_get( 'time_submit' ) ?>" type="submit" value="<?php echo lang_get( 'time_submit' ) ?>">
		</td>
		<td>	</td>
		</tr>
		</form>
<?php
	} 
	# Pull all Time-Record entries for the current Bug
	$query_pull_timerecords = "SELECT * FROM {plugin_TimeTrack_timelog} WHERE bugid = $bug_id ORDER BY expenditure_date DESC limit $maxrec";
	$result_pull_timerecords = db_query($query_pull_timerecords);
	while ($row = db_fetch_array($result_pull_timerecords)) {
?>
		<tr >
		<td><?php echo user_get_name($row["user"]); ?></td>
		<td><div align="center"><?php  echo date("d.m.Y", strtotime($row["expenditure_date"])); ?> </div>
		</td>
<?php
	  	$mdBold = "";
		$mdBoldStop = "";
		$hrBold = "";
		$hrBoldStop = "";
		if($row["time_unit"]=="md"){
			$mdBold = "<b>";
			$mdBoldStop = "</b>";
			$hrBold = "";
			$hrBoldStop = "";
		} else {
			$mdBold = "";
			$mdBoldStop = "";
			$hrBold = "<b>";
			$hrBoldStop = "</b>";
		}
?>
		<td><div align="center"><?php echo $hrBold.number_format($row["hours"], 2, ',', '.').$hrBoldStop; ?> / <?php echo $mdBold.number_format($row["hours"]/plugin_config_get('consultant_manday_definition'), 2, ',', '.').$mdBoldStop; ?></div>
		</td>
		<td><center><?php echo $row["info"]; ?> </center></td>
		<td><div align="right"><?php echo number_format($row["costs"], 2, ',', '.'); ?> &euro;</div> 
		</td>
		<td><div align="center"><?php  echo date("d.m.Y G:i:s", strtotime($row["timestamp"])); ?> </div>
		</td>
		<td>
		<?php # DELETE Button just available for 'Delete-Bug Users'
		if ( access_has_bug_level( plugin_config_get( 'timetrack_delete_threshold' ), $bug_id ) ) {?>
			
			<a href="plugin.php?page=TimeTrack/tt_del_db.php&bug_id=<?php echo $bug_id; ?>&id=<?php echo $bug_id; ?>&delete_id=<?php echo $row["id"]; ?>#timerecord"><?php echo lang_get( 'time_tracking_delete' ) ?></a></td>
<?php
		} 
?>
		</tr>
<?php
	} 
?>
	<tr class="row-category">
    <td><b><?php echo lang_get( 'time_sum' ) ?></b></td>
    <td>&nbsp;</td>
    <td><div align="center"><b><?php echo number_format($row_pull_costs_hours['hours'], 2, ',', '.'); ?> / <?php echo number_format($row_pull_costs_hours['hours']/plugin_config_get('consultant_manday_definition'), 2, ',', '.'); ?></b></div></td>
    <td>&nbsp;</td>
<?php if ( access_has_bug_level( plugin_config_get( 'timetrack_delete_threshold' ), $bug_id ) ) { ?>
     <td><div align="right"><b><?php echo number_format($row_pull_costs_hours['costs'], 2, ',', '.'); ?> &euro;</b></div></td> 
<?php } ?>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
</table>
</div>
</div>
</div>
</div>
</div>
</div>


