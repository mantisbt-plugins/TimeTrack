<?php
auth_reauthenticate();
access_ensure_global_level( config_get( 'manage_plugin_threshold' ) );

$f_consultant_hourly_charge=gpc_get_int( 'consultant_hourly_charge', 10 );
$f_consultant_manday_definition=gpc_get_int( 'consultant_manday_definition', 8 );
$f_timetrack_maxrec=gpc_get_int( 'timetrack_maxrec', 35 );
$f_timetrack_admin_threshold = gpc_get_int( 'timetrack_admin_threshold', ADMINISTRATOR );
$f_timetrack_add_threshold = gpc_get_int( 'timetrack_add_threshold', DEVELOPER );
$f_timetrack_delete_threshold = gpc_get_int( 'timetrack_delete_threshold', DEVELOPER );
$f_timetrack_history = gpc_get_int( 'timetrack_history', OFF );
$f_show_myview = gpc_get_int( 'show_myview', OFF );
$f_show_main = gpc_get_int( 'show_main', ONF );
$f_report_other_threshold = gpc_get_int( 'report_other_threshold', DEVELOPER );
plugin_config_set( 'consultant_hourly_charge', $f_consultant_hourly_charge );
plugin_config_set( 'consultant_manday_definition', $f_consultant_manday_definition );
plugin_config_set( 'timetrack_maxrec', $f_timetrack_maxrec );
plugin_config_set( 'timetrack_admin_threshold', $f_timetrack_admin_threshold );
plugin_config_set( 'timetrack_add_threshold', $f_timetrack_add_threshold );
plugin_config_set( 'timetrack_delete_threshold', $f_timetrack_delete_threshold );
plugin_config_set( 'timetrack_history', $f_timetrack_history );
plugin_config_set( 'show_myview', $f_show_myview );
plugin_config_set( 'show_main', $f_show_main );
plugin_config_set( 'report_other_threshold', $f_report_other_threshold );

print_successful_redirect( plugin_page( 'config',TRUE ) );