<?php

class TimeTrackPlugin extends MantisPlugin {
 
	function register() {
		$this->name        = lang_get("timetrack_title");
		$this->description = lang_get("timetrack_desc");
		$this->version     = '1.10';
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
			'timetrack_history'				=> ON,
			'timetrack_maxrec'				=> 35,
			'show_myview'					=> OFF,
			'show_main'						=> ON,
			'report_other_threshold'		=> MANAGER,
			);
	}

	function init() { 
		event_declare('EVENT_MYVIEW');
		plugin_event_hook( 'EVENT_MYVIEW', 'myview' );
		plugin_event_hook( 'EVENT_MENU_MAIN', 'mainmenu' );
		plugin_event_hook( 'EVENT_MENU_MANAGE', 'managemenu' );
		plugin_event_hook( 'EVENT_VIEW_BUG_EXTRA', 'timetrack_form1' );
	}

	
	function myview() {
		if ( ON == plugin_config_get( 'show_myview'  ) ) {
			include 'plugins/TimeTrack/pages/myview_tt.php';
		}
    }

	function mainmenu() {
		if ( ON == plugin_config_get( 'show_main'  ) ) {
			$links = array();
			$links[] = array(
			'title' => lang_get("timetrack_mytime"),
			'url' => plugin_page( 'print_mytime_tracking_page.php', true ),
			'icon' => 'fa-clock-o'
			);
			return $links;
		}
    }

	function managemenu() {
		return array('<a href="'. plugin_page( 'print_time_tracking_page.php' ) . '">' . lang_get( 'timetrack_title' ) . '</a>' );
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