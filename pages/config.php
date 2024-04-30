<?php
auth_reauthenticate();
access_ensure_global_level( config_get( 'manage_plugin_threshold' ) );
layout_page_header( lang_get( 'plugin_format_title' ) );
layout_page_begin( 'manage_overview_page.php' );
print_manage_menu( 'manage_plugin_page.php' );
?>
<div class="col-md-12 col-xs-12">
<div class="space-10"></div>
<div class="form-container" > 
<form action="<?php echo plugin_page( 'config_edit' ) ?>" method="post">
<div class="widget-box widget-color-blue2">
<div class="widget-header widget-header-small">
	<h4 class="widget-title lighter">
		<i class="ace-icon fa fa-text-width"></i>
		<?php echo lang_get( 'plugin_tt_title' ) . ': ' . lang_get( 'plugin_tt_config' )?>
	</h4>
</div>
<div class="widget-body">
<div class="widget-main no-padding">
<div class="table-responsive"> 
<table class="table table-bordered table-condensed table-striped"> 
<tr  >
<td class="category" colspan="3">
</td>
</tr>
<form action="<?php echo plugin_page( 'config_edit' ) ?>" method="post">
<tr >
	<td class="category">
		<?php echo lang_get( 'timetrack_delete_threshold' ) ?>
	</td>
	<td class="center">
			<select name="timetrack_delete_threshold">
			<?php print_enum_string_option_list( 'access_levels', plugin_config_get( 'timetrack_delete_threshold'  ) ) ?>;
			</select> 
	</td>
	<td></td>
</tr>

<tr >
	<td class="category">
		<?php echo lang_get( 'timetrack_add_threshold' ) ?>
	</td>
	<td class="center">
			<select name="timetrack_add_threshold">
			<?php print_enum_string_option_list( 'access_levels', plugin_config_get( 'timetrack_add_threshold'  ) ) ?>;
			</select> 
	</td>
		<td></td>
</tr>

<tr >
	<td class="category">
		<?php echo lang_get( 'timetrack_admin_threshold' ) ?>
	</td>
	<td class="center">
			<select name="timetrack_admin_threshold">
			<?php print_enum_string_option_list( 'access_levels', plugin_config_get( 'timetrack_admin_threshold'  ) ) ?>;
			</select> 
	</td>
		<td></td>
</tr>

<tr>
	<td class="category">
		<?php echo lang_get( 'timetrack_maxrec' ) ?>
	</td>
	<td class="center">
		<label><input type="text" name="timetrack_maxrec" size="5" value="<?php echo plugin_config_get( 'timetrack_maxrec' ) ?>"/> </label>
	</td>
		<td></td>
</tr>

<tr >
	<td class="category">
		<?php echo lang_get( 'consultant_hourly_charge' ) ?>
	</td>
	<td class="center">
		<label><input type="text" name="consultant_hourly_charge" size="5" value="<?php echo plugin_config_get( 'consultant_hourly_charge' ) ?>"/> </label>
	</td>
		<td></td>
</tr>

<tr >
	<td class="category">
		<?php echo lang_get( 'consultant_manday_definition' ) ?>
	</td>
	<td class="center">
		<label><input type="text" name="consultant_manday_definition" size="5" value="<?php echo plugin_config_get( 'consultant_manday_definition' ) ?>"/> </label>
	</td>
		<td></td>
</tr>

<tr >
	<td class="category" width="60%">
		<?php echo lang_get( 'timetrack_history' )?>
	</td>
	<td class="center" width="20%">
		<label><input type="radio" name='timetrack_history' value="1" <?php echo( ON == plugin_config_get( 'timetrack_history' ) ) ? 'checked="checked" ' : ''?>/>
			<?php echo lang_get( 'enabledtt' )?></label>
	</td>
	<td class="center" width="20%">
		<label><input type="radio" name='timetrack_history' value="0" <?php echo( OFF == plugin_config_get( 'timetrack_history' ) )? 'checked="checked" ' : ''?>/>
			<?php echo lang_get( 'disabledtt' )?></label>
	</td>
</tr> 

<tr >
	<td class="category" width="60%">
		<?php echo lang_get( 'show_myview')?>
	</td>
	<td class="center" width="20%">
		<label><input type="radio" name='show_myview' value="1" <?php echo( ON == plugin_config_get( 'show_myview' ) ) ? 'checked="checked" ' : ''?>/>
			<?php echo lang_get( 'enabledtt' )?></label>
	</td>
	<td class="center" width="20%">
		<label><input type="radio" name='show_myview' value="0" <?php echo( OFF == plugin_config_get( 'show_myview' ) )? 'checked="checked" ' : ''?>/>
			<?php echo lang_get( 'disabledtt' )?></label>
	</td>
</tr> 

<tr >
	<td class="category" width="60%">
		<?php echo lang_get( 'show_main')?>
	</td>
	<td class="center" width="20%">
		<label><input type="radio" name='show_main' value="1" <?php echo( ON == plugin_config_get( 'show_main' ) ) ? 'checked="checked" ' : ''?>/>
			<?php echo lang_get( 'enabledtt' )?></label>
	</td>
	<td class="center" width="20%">
		<label><input type="radio" name='show_main' value="0" <?php echo( OFF == plugin_config_get( 'show_main' ) )? 'checked="checked" ' : ''?>/>
			<?php echo lang_get( 'disabledtt' )?></label>
	</td>
</tr> 

<tr >
	<td class="category">
		<?php echo lang_get( 'report_other_threshold' ) ?>
	</td>
	<td class="center">
			<select name="report_other_threshold">
			<?php print_enum_string_option_list( 'access_levels', plugin_config_get( 'report_other_threshold'  ) ) ?>;
			</select> 
	</td>
		<td></td>
</tr>

<tr>
	<td class="center" colspan="3">
		<input type="submit" class="button" value="<?php echo lang_get( 'change_configuration' ) ?>" />
	</td>
</tr>

</table>
</div>
</div>
</div>
</div>
</form>
</div>
</div>
<?php
layout_page_end();