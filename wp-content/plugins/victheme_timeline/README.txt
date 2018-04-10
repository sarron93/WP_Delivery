Welcome to VicTheme TimeLine
=====================================

This plugin is created for adding Timeline element shortcodes and integration to 
Visual composer plugin


Requirements
============

This plugin has 2 dependencies :
1. VicTheme Core Plugin
2. Visual Composer Plugin

Before the dependencies are installed and enabled, this plugin won't activate
itself to prevent site crash.


INSTALLATION
============

This plugin has no special installation instruction, just download the plugin
and its dependencies and upload them to wp-content/plugin directory then
activate this plugin and its dependencies via WordPress plugin manager page.


DEPENDENCIES
============

Version branch 1.4.x and below is compatible with Visual Composer before 1.7.x
Version branch 1.5.x is compatible with Visual Composer after 1.7.x



AVAILABLE SHORTCODES
====================


Time Events
-----------


Shortcode Tags :

Note :  This shortcode must be placed inside the [timeline] shortcode otherwise it will produce invalid HTML markup


[timeevents
   datetime="YYYY-MM-DDTHH:MM"
   day="eg. Monday"
   month="eg. January"
   year="eg. 2014"
   date="eg. 12"
   icon="fontawesome icon name"
   text="the event title"
   direction="left|right"
]

 Some content representing the event content

[/timeevents]





Time Line
---------

Note :  This shortcode must be have [timeevents] or [timemajor] as its direct children to avoid invalid markups or styling.


Shortcode Tags :

[timeline class="some class" id="someid" align="left|right|empty for center" ending_text="text for the end bubble"]
  
    [timemajor]Some text to represent major events[/timemajor]
    
    [timeevents
      datetime="YYYY-MM-DDTHH:MM"
      date="the date text"
      time="the time text"
      icon="fontawesome icon name"
      text="the event title"
      direction="left|right" // only applicable if the parent didn't specify align (centered)
      ]
      Some content representing the event content
    [/timeevents]
    
[/timeline]





Time Major
----------


Note :  This shortcode must be placed inside the [timeline] shortcode otherwise it will produce invalid HTML markup


Shortcode Tags :

[timemajor]Some text to represent major events[/timemajor]




SUPPORT
=======

You can contact support@victheme.com to request support for this plugin.