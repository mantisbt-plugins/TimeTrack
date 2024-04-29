
# 	Mantis TimeTrack plugin
Version 1.01
Copyright 2024 Cas Nuy

## Description

This plugin implements Time tracking outside of the Note system offering greater flexability

## License

Released under the [GPL v3 license](http://opensource.org/licenses/GPL-3.0).

## Background

Original by Elmar Schumacher  2005 (elmar.schumacher@web.de)  GAMBIT Consulting GmbH for mantis version 1.x

##  Installation                                                                             *

Like any other plugin. 
After copying to your webserver :
- Start mantis ad administrator
- Select manage
- Select manage Plugins
- Select Install behind TimeTrack 1.01
- Once installed, click on the plugin-name for further configuration.

In case you want to have an overview in My View, do ensure to define a signal in my_view_page.php.
Then add the following line right after "layout_page_begin( __FILE__ ); "
event_signal( 'EVENT_MYVIEW' ); 

## Support

Support via https://github.com/mantisbt-plugins/TimeTrack

## Greetings

Cas Nuy 
cas@nuy.info
http://www.nuy.info