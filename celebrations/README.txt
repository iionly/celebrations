Celebrations plugin for Elgg 1.9
Latest Version: 1.9.3.1
Released: 2014-07-20
Contact: iionly@gmx.de
License: GNU General Public License version 2
Copyright: (c) iionly 2012-2014, (C) Fernando Graells 2009-2014



This plugin lets users enter and view celebrations like birthdays and wedding days. It's an updated and enhanced version of the Celebrations plugin originally published by Fernando Graells that works in Elgg 1.9. Any profile information entered by users with earlier versions of the Celebrations plugin in Elgg 1.8 and before should continue to be displayed and useable.

This version runs under Elgg v1.9 and doesn't need another plugins to work but if you have the Profile Manager plugin and/or the Widget Manager plugin installed you will gain additional functionality. The Celebrations plugin uses the core profile fields (not the core custom profile fields) and adds the necessary fields when saving the plugin settings automatically.



Installation and configuration:

1. copy the Celebrations plugin folder into the mod folder on your server,
2. enable the plugin in the admin section of your site,
3. configure the plugin settings (especially which profile fields to be used) on the Celebrations plugin settings page.

Now, users can enter their profile information for the active profile fields and they also can add the Celebrations plugin's widget to their profile page and/or dashboards. All celebrations of users are additionally listed on the Celebrations plugins page sorted by month.


Addtional installation and configuration options, if the Profile Manager plugin is available:

- You don't need (should not!!) create any profile fields via the Profile Manager plugin settings. The necessary profile fields are created automatically by the Celebrations plugin when saving its settings.
- After you enable the Profile Manager plugin you should re-save the Celebrations plugin settings for the profile fields to appear.
- In case you want to remove any profile fields don't remove them via the Profile Manager plugin settings but disable them via the Celebrations plugin settings.
- Also, don't change the profile field names via the Profile Manager settings but make any necessary modifications via the Celebrations plugin's language files.

What you can do via the Profile Manager settings:
- change the order of the profile fields (in case you disable and later re-enable a Celebrations plugin's profile field you might need to update the order of the profile fields afterwards again),
- make any active profile field to be displayed on the registration page,
- make entering information to any active profile field mandatory when registering an account.


If the Widget Manager plugin is enabled - and the Widget Manager plugin is configured to built up your site's index page - you have the option to add the Celebrations plugin's widgets ("Today's celebrations" and/or "Next Celebrations") to your index page like the other available index page widgets.



Changelog:

Changes for release 1.9.3.1 (by iionly)
- Fix of deprecated usage of getFriends() function on Elgg 1.9.

Changes for release 1.9.3 (by iionly)
- Includes fixes of Celebrations version 1.9.3 with the necessary adaptions for Elgg 1.9,
- Fix of a deprecation issue on Elgg 1.9 on using the 'login', 'user' event which has now be change to the 'login:after', 'user' evnt.

Changes for release 1.8.3 (by iionly)

- getting the Celebrations plugin to fully work again on Elgg 1.8.19 (thanks to Brett for helping me to solve this issue),
- calculation and display of celebrations accounts for local (server) time instead of expecting GMT/UTC (celebration dates entered on profile pages are always saved in GMT/UTC but if the timezone of the server is different this should now taken into account correctly),
- date selection (number of days in a month) fixed for Special anniversaries,
- site menu "Celebrations" entry only included for logged-in users,
- layout fixes for listings of celebrations in widgets and on the "Our anniversary celebrations in..." page,
- success system message when plugin settings saved correctly,
- Spanish language file added (thanks to Joaquín Marín),
- code cleanup.

Changes for release 1.9.2 (by iionly)

- Updated for Elgg 1.9.

Changes for release 1.8.2 (by iionly)

- code cleanup,
- fixed: showing date in format selected in Celebrations plugin settings on Celebrations listing page, in profile pages info section and widgets,
- fixed: allow for translations of month names via language file and also use these translations then,
- fixed: user filter (all, friends, members of specific group) to work as intended on Celebrations listing page.

Changes for release 1.8.1 (by iionly)

- check if arrays of foreach loops are populated prior loop execution to prevent php warnings added to error log.

Changes for release 1.8.0 (by iionly)

- updated for Elgg 1.8
- code cleanup
- some minor bugfixes
- sending a message to a user who celebrates an anniversary on this day works now from every widget and also from the celebrations listings page
- made it to work with Profile Manager plugin installed
- index page widgets to be available when Widget Manager plugin is installed.

Changes for release 1.3

- Change strftime for gmstrftime to solve problems with dates between differents gmt places (test by chombian, thanks)
- corrected bug with image path in css to display the sendtomessage image in "today celebrations" widget
- corrected a bug with friends filter

Changes for release 1.2

- Add selects in settings because we had problems with checkboxes in plugins settings

Changes for release 1.1

- Correct some date type to strftime
- Added "friends filter"
- Now you can select fields to add from the plugin default

Changes for release 1.0

- Full code rewrite to improve the files and let it to grow up
- Now is very easy (with a few code) to add new fields types (as periodical events) and profile fields
- Tested in elgg v1.6
- Independent from other profile plugins (in this version you don't need the flexprofile plugin)
- Added a field for the wedding date

Changes for release 0.4

- problem in date dropdown with firefox fixed
- Added two languages files (spanish and catalan)

Changes for release 0.3

- Added a new widget to see the next celebrations (you can edit the widget setting in the edit button on the widget)
- Added a reminder when you login with the next celebrations (you can edit the settings in the admin plugin settings)
- Added the possibility to send a message in the today celebrations widget

Changes for release 0.2

- Change date by gmdate
- Correct some errors with feast celebrations
- Improve user experience with less screens
- Submenu added with the month's list
- Corrected some language errors
- Added icon and profile link for every user
- Corrected a double closed of select tag



Addition information:

At the moment the following field types are defined by the Celebrations plugin:

- "day_anniversary" with three pulldowns for the day, month and year to avoid the use of calendar input for old dates. This is used for the specific dates that has celebrations every year, like birthday, wedding day, etc...
- "yearly" a particular date with two pulldowns with day and month (in some countries like spain you celebrate the date of your name's saint). This is use for celebrations that repeat yearly, but not have an origin or specific date

Then the system creates the profile fields like "celebrations_birthdate", "celebrations_dieday" and "celebrations_feastdate". The prefix "celebrations_" is added to the Celebrations plugin's profile fields to avoid confusions with the original core fields. If you want to add some addtional fields, you must use the prefix (with underscore) before the field name, and use one of the defined types of field.
