=== oik-events ===
Contributors: bobbingwide
Donate link: https://www.oik-plugins.com/oik/oik-donate/
Tags: oik, events
Requires at least: 6.6
Tested up to: 6.7.1
Stable tag: 0.1.0

Events plugin to replace All-In-One Events Calendar.

== Description ==
Use the oik-events plugin to create and display Events on your website. 

== Installation ==
1. Upload the contents of the oik-events plugin to the `/wp-content/plugins/oik-events' directory
1. Activate the oik-events plugin through the 'Plugins' menu in WordPress
1. Visit the oik-events admin page
1. Use the admin interface to migrate any events from the All-In-One Events Calendar.
1. Click on the link to activate/update the Must Use ( MU ) plugin
1. Disable the MU logic using the Deactivate link

The oik-events plugin is dependent upon the following plugins:
- oik-fields
- oik
- oik-dates

== Frequently Asked Questions ==

= How do I display event fields? =

Use one or more of the following plugin solutions:

- sb-field-block - to display the postmeta and virtual fields in the "Field block"
- oik-fields - to display the postmeta and virtual fields using `[bw_field]` and `[bw_fields]` shortcodes.


= How do I display future events? =

Use the `[bw_related]` shortcode from oik-fields.
Use the Advanced Query Loop plugin. 


= Can I migrate from other Events Calendar plugins =
No. This only supports migration from published posts in `ai1ec_events`


== Screenshots ==
1. Event fields displayed by sb-field-block
2. Event summary grid 

== Upgrade Notice ==
= 0.1.0 = 
Now supports Event start and end dates and times. 

= 0.0.0 = 
Switch to oik-events to replace the All-In-One Events Calendar plugin.

== Changelog ==
= 0.1.0 = 
* Changed: Change oik_events_event_when to use _start_date #1 #2 #4
* Changed: Set both start and end dates and the post_date #1
* Added: Add _googlemap virtual field #2. 
* Changed: Implement both start and end date fields #1
* Added: Add event_tickets button #3
* Added: Implement aql_query_vars to set meta_value for _date meta queries #4

= 0.0.0 = 
* Changed: Refactor oik_events_events_when() #2
* Changed: Don't theme virtual fields displayed by [bw_fields] #2
* Added: Start adding virtual fields for Events #2
* Added: Prototype display of event information as block bindings and virtual fields #2
* Added: Prototype 2 alternative block binding options #2
* Changed: Only migrate published posts. Cater for missing entry in ai1ec_events. Process 10 at a time #1
* Added: New Events plugin - migrate from ai1ec_event to event #1
* Tested: With WordPress 6.7.0 and WordPress Multisite
* Tested: With Gutenberg 19.6.1
* Tested: With PHP 8.3

== Further reading ==

If you want to read more about oik plugins and themes then please visit
[oik-plugins](https://www.oik-plugins.com/)