<?php

class TimeTrackPlugin extends MantisPlugin {
 
	function register() {
		$this->name        = 'TimeTrack';
		$this->description = 'Allows for timetracking within an issue or outside an issue.';
		$this->version     = '1.01';
		$this->requires    = array('MantisCore'       => '2.0.0',);
		$this->author      = 'Cas Nuy';
		$this->contact     = 'Cas-at-nuy.info';
		$this->url         = 'https://github.com/mantisbt-plugins/TimeTrack';
		$this->page			= 'config';
	}
 
 	/**
	 * Default plugin configuration.
	 */
	function config() {
		return array(
			'consultant_hourly_charge'		=> 50,
			'consultant_manday_definition'	=> 8,
			'timetrack_delete_threshold'	=> DEVELOPER,
			'timetrack_add_threshold'		=> DEVELOPER,
			'timetrack_admin_threshold'		=> ADMINISTRATOR,
			'timetrack_history'				=> OFF,
			'timetrack_maxrec'				=> 35,
			);
	}

	function init() { 
		event_declare('EVENT_MYVIEW');
		plugin_event_hook( 'EVENT_MYVIEW', 'mainmenu1' );
		plugin_event_hook( 'EVENT_MENU_MANAGE', 'mainmenu2' );
		plugin_event_hook( 'EVENT_VIEW_BUG_EXTRA', 'timetrack_form1' );
	}

	
	function mainmenu1() {
		include 'plugins/TimeTrack/pages/myview_tt.php';
    }

	function mainmenu2() {
		return array('<a href="'. plugin_page( 'print_time_tracking_page.php' ) . '">' . lang_get( 'timetrack' ) . '</a>' );
    }
 
 	function timetrack_form1() {
		 include 'plugins/TimeTrack/pages/ttform.php';
	}
	

    function schema() {
        return array(
            # v1.01
            array('CreateTableSQL', array(plugin_table('timelog'), "
				id  				I   			NOTNULL UNSIGNED AUTOINCREMENT PRIMARY,
				bugid   			I   			DEFAULT NULL,
				user				I				DEFAULT NULL,
				expenditure_date	D				DEFAULT NULL,
				hours 				Decimal(15,3)	DEFAULT NULL,
				costs 				Decimal(15,3)	DEFAULT NULL,
				time_unit 			C(2)			DEFAULT 'hr',
				timestamp 			Timestamp(6)	NOTNULL,
				info 				C(255)			DEFAULT NULL
				" ) ),
			);
    }

}