Celebrations plugin for Elgg 1.9 - 1.12
=======================================

Latest Version: 1.9.6  
Released: 2015-10-11  
Contact: iionly@gmx.de  
License: GNU General Public License version 2  
Copyright: (c) iionly 2012-2015, (C) Fernando Graells 2009-2015


Description
-----------

This plugin lets users enter and view celebrations like birthdays and wedding days. It's an updated and enhanced version of the Celebrations plugin originally published by Fernando Graells that works in Elgg 1.9 and newer. Any profile information entered by users with earlier versions of the Celebrations plugin in Elgg 1.8 and before should continue to be displayed and useable.

This version runs under Elgg 1.9 - 1.12 and doesn't need another plugins to work but if you have the Profile Manager plugin and/or the Widget Manager plugin installed you will gain additional functionality. The Celebrations plugin uses the core profile fields (not the core custom profile fields) and adds the necessary fields when saving the plugin settings automatically.


Installation and configuration
------------------------------

1. If you have a previous version of the Celebrations plugin installed, disable it and then remove the celebrations folder from your mod directory before copying the new version on the server,
2. Copy the Celebrations plugin folder into the mod folder on your server,
3. Enable the plugin in the admin section of your site,
4. Configure the plugin settings (especially which profile fields to be used) on the Celebrations plugin settings page.

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


Addition information
--------------------

At the moment the following field types are defined by the Celebrations plugin:

- "day_anniversary" with three pulldowns for the day, month and year to avoid the use of calendar input for old dates. This is used for the specific dates that has celebrations every year, like birthday, wedding day, etc...
- "yearly" a particular date with two pulldowns with day and month (in some countries like spain you celebrate the date of your name's saint). This is use for celebrations that repeat yearly, but not have an origin or specific date

Then the system creates the profile fields like "celebrations_birthdate", "celebrations_dieday" and "celebrations_feastdate". The prefix "celebrations_" is added to the Celebrations plugin's profile fields to avoid confusions with the original core fields. If you want to add some addtional fields, you must use the prefix (with underscore) before the field name, and use one of the defined types of field.
