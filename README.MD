
# 	Mantis TimeTrack plugin
Version 1.10
Copyright 2024 Cas Nuy

## Description

This plugin implements Time tracking outside of the Note system offering greater flexability

## License

Released under the [GPL v3 license](http://opensource.org/licenses/GPL-3.0).

## Background

Original by Elmar Schumacher  2005 (elmar.schumacher@web.de)  GAMBIT Consulting GmbH for mantis version 1.x

##  Installation

Like any other plugin. 
After copying to your webserver :
- Start mantis as administrator
- Select manage
- Select manage Plugins
- Select Install behind TimeTrack 1.10
- Once installed, click on the plugin-name for further configuration.

In case you want to have an overview in My View, do ensure to define a signal in my_view_page.php.
Then add the following line right after "layout_page_begin( __FILE__ ); "<br>
event_signal( 'EVENT_MYVIEW' ); 

## configuration options

- consultant_hourly_charge <br>
&nbsp;&nbsp;&nbsp;&nbsp; What is the labor rate per hour <br>
&nbsp;&nbsp;&nbsp;&nbsp; Default	= 50
- consultant_manday_definition <br>
&nbsp;&nbsp;&nbsp;&nbsp; How many hours in one working day <br>
&nbsp;&nbsp;&nbsp;&nbsp; Default = 8
- timetrack_delete_threshold <br>
&nbsp;&nbsp;&nbsp;&nbsp;	What level is required to delete a time recording <br>
&nbsp;&nbsp;&nbsp;&nbsp;	Default = DEVELOPER
- timetrack_add_threshold		<br>
&nbsp;&nbsp;&nbsp;&nbsp;	What level is required to add a time recording	<br>
&nbsp;&nbsp;&nbsp;&nbsp;	Deafult = DEVELOPER
- timetrack_admin_threshold	<br>
&nbsp;&nbsp;&nbsp;&nbsp; What level is required to manage plugin <br>
&nbsp;&nbsp;&nbsp;&nbsp;		Default = ADMINISTRATOR
- timetrack_history		<br>
&nbsp;&nbsp;&nbsp;&nbsp; Make history entries for time recording activities <br>
&nbsp;&nbsp;&nbsp;&nbsp; Default = ON
- timetrack_maxrec		<br>
&nbsp;&nbsp;&nbsp;&nbsp; Max records to show without selection criteris <br>
&nbsp;&nbsp;&nbsp;&nbsp; Default = 35
- show_myview	<br>
&nbsp;&nbsp;&nbsp;&nbsp; Show a section in the My View page	<br>
&nbsp;&nbsp;&nbsp;&nbsp; Default = OFF
- show_main			<br>
&nbsp;&nbsp;&nbsp;&nbsp; Show an option on the main menu		<br>
&nbsp;&nbsp;&nbsp;&nbsp; Default = ON
- report_other_threshold	<br>
&nbsp;&nbsp;&nbsp;&nbsp; Level required to make time recording for others <br>
&nbsp;&nbsp;&nbsp;&nbsp; Default = MANAGER

## Support

Support via https://github.com/mantisbt-plugins/TimeTrack

## Greetings

Cas Nuy 
cas@nuy.info
http://www.nuy.info
