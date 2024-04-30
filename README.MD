
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

- consultant_hourly_charge			What is the labor rate per hour						Default	= 50
- consultant_manday_definition		How many hours in one working day					Default = 8
- timetrack_delete_threshold		What level is required to delete a time recording	Default = DEVELOPER
- timetrack_add_threshold			What level is required to add a time recording		Deafult = DEVELOPER
- timetrack_admin_threshold			What level is required to manage plugin				Default = ADMINISTRATOR
- timetrack_history					Make history entries for time recording activities	Default = ON
- timetrack_maxrec					Max records to show without selection criteris		Default = 35
- show_myview						Show a section in the My View page					Default = OFF
- show_main							Show an option on the main menu						Default = ON
- report_other_threshold			Level required to make time recording for others	Default = MANAGER

## Support

Support via https://github.com/mantisbt-plugins/TimeTrack

## Greetings

Cas Nuy 
cas@nuy.info
http://www.nuy.info
