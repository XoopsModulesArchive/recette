<?php

// Module Info

// The name of this module
define('_MI_RECETTE_NAME', 'Recipes');

// A brief description of this module
define('_MI_RECETTE_DESC', 'Creates a section in which users can post and comment recipes.');

// Names of blocks for this module (Not all module has blocks)
define('_MI_RECETTE_BNAME1', 'Recipe types');
define('_MI_RECETTE_BNAME3', 'Recipe of the day');
define('_MI_RECETTE_BNAME4', 'Top recipe');
define('_MI_RECETTE_BNAME5', 'Most read recipe');
define('_MI_RECETTE_BNAME6', 'Moderate recipes');
define('_MI_RECETTE_BNAME7', 'Recipe navigation');
define('_MI_RECETTE_BNAME8', 'Recipe type block');
define('_MI_RECETTE_BNAME9', 'the last recipe');

// Sub menus in main menu block
define('_MI_RECETTE_SMNAME1', 'Submit recipe');
define('_MI_RECETTE_SMNAME2', 'Achive');
define('_MI_RECETTE_SMNAME3', 'Index of ingredients');

// Names of admin menu items
define('_MI_RECETTE_ADMENU2', 'Categories');
define('_MI_RECETTE_ADMENU3', 'Modify recipes');
define('_MI_RECETTE_GROUPPERMS', 'Permissions');
define('_MI_RECETTE_FUSION', 'Add ingredients');
define('_MI_RECETTE_ICONE', 'Manage pictograms');

// Title of config items
define('_MI_RECETTE_STORYHOME', 'How many recipies should be displayed on the index page ?');
define('_MI_RECETTE_NOTIFYSUBMIT', 'Notify on recipe submission ?');
define('_MI_RECETTE_DISPLAYNAV', 'Display navigation-box ?');
define('_MI_RECETTE_ANONPOST', 'Should guests be allowed to submit recipes ?');
define('_MI_RECETTE_AUTOAPPROVE', 'Automaticly publish recipes ?');
define('_MI_RECETTE_ALLOWEDSUBMITGROUPS', 'Group permission to submit');
define('_MI_RECETTE_ALLOWEDAPPROVEGROUPS', 'Group permission to publish');
define('_MI_RECETTE_NEWSDISPLAY', 'Display layout');
define('_MI_RECETTE_NAMEDISPLAY', 'Name of author');
define('_MI_RECETTE_COLUMNMODE', 'Columns');
define('_MI_RECETTE_STORYCOUNTADMIN', 'Number of recipes to display on index page in admin area :');
define('_MI_RECETTE_UPLOADFILESIZE', 'MAX filesize for uploads (kb) 1048576 = 1 Mb');
define('_MI_RECETTE_UPLOADGROUPS', 'Groups that may upload');

// Description of each config items
define('_MI_RECETTE_STORYHOMEDSC', '');
define('_MI_RECETTE_NOTIFYSUBMITDSC', '');
define('_MI_RECETTE_DISPLAYNAVDSC', '');
define('_MI_RECETTE_AUTOAPPROVEDSC', '');
define('_MI_RECETTE_ALLOWEDSUBMITGROUPSDESC', 'Selected groups may submit recipes');
define('_MI_RECETTE_ALLOWEDAPPROVEGROUPSDESC', 'Selected groups may');
define('_MI_RECETTE_NEWSDISPLAYDESC', '\\\"Classic\\\\\\\" displays recipes according to their date. \\\\\\\"According to category\\\\\\\" groups recipes according to their category, whereby the latest recipe is displayed completly - only the titles will be displayed of the others.');
define('_MI_RECETTE_ADISPLAYNAMEDSC', 'How should the name of the author be displayed ?');
define('_MI_RECETTE_COLUMNMODE_DESC', 'In how many columns should the recipe list be displayed ?');
define('_MI_RECETTE_STORYCOUNTADMIN_DESC', '');
define('_MI_RECETTE_UPLOADFILESIZE_DESC', '');
define('_MI_RECETTE_UPLOADGROUPS_DESC', 'Select the groups, that may upload files on to the server');


// Name of config item values
define('_MI_RECETTE_NEWSCLASSIC', 'Classic');
define('_MI_RECETTE_NEWSBYTOPIC', 'According to category');
define('_MI_RECETTE_DISPLAYNAME1', 'Username');
define('_MI_RECETTE_DISPLAYNAME2', 'Full name');
define('_MI_RECETTE_DISPLAYNAME3', 'Do not display author');
define('_MI_RECETTE_UPLOAD_GROUP1', 'Submiter and moderator');
define('_MI_RECETTE_UPLOAD_GROUP2', 'Moderators only');
define('_MI_RECETTE_UPLOAD_GROUP3', 'Upload deactivatet');


// Text for notifications

define('_MI_RECETTE_GLOBAL_NOTIFY', 'General');
define('_MI_RECETTE_GLOBAL_NOTIFYDSC', 'General recipe notification options.');

define('_MI_RECETTE_STORY_NOTIFY', 'Recipes');
define('_MI_RECETTE_STORY_NOTIFYDSC', 'Notification options that affect the current recipe.');

define('_MI_RECETTE_GLOBAL_NEWCATEGORY_NOTIFY', 'New recipe category');
define('_MI_RECETTE_GLOBAL_NEWCATEGORY_NOTIFYCAP', 'Notify on creation of a new recipe.');
define('_MI_RECETTE_GLOBAL_NEWCATEGORY_NOTIFYDSC', 'Notification on creation of a new recipe.');
define('_MI_RECETTE_GLOBAL_NEWCATEGORY_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} Automatic Notification: New recipe category');

define('_MI_RECETTE_GLOBAL_STORYSUBMIT_NOTIFY', 'New recipe submited');       
define('_MI_RECETTE_GLOBAL_STORYSUBMIT_NOTIFYCAP', 'Notify on submission of a new recipe (still pending publication).');                           
define('_MI_RECETTE_GLOBAL_STORYSUBMIT_NOTIFYDSC', 'Notification on submission of a new recipe (still pending publication).');                
define('_MI_RECETTE_GLOBAL_STORYSUBMIT_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} Automatic Notification: Submission of new recipe');                              

define('_MI_RECETTE_GLOBAL_NEWSTORY_NOTIFY', 'New recipe');       
define('_MI_RECETTE_GLOBAL_NEWSTORY_NOTIFYCAP', 'Notify on publication of a new recipe.');
define('_MI_RECETTE_GLOBAL_NEWSTORY_NOTIFYDSC', 'Notification on publication of a new recipe.');
define('_MI_RECETTE_GLOBAL_NEWSTORY_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} Automatic Notification: New recipe has been published.');                              

define('_MI_RECETTE_STORY_APPROVE_NOTIFY', 'Recipe published');
define('_MI_RECETTE_STORY_APPROVE_NOTIFYCAP', 'Notify on publication of this recipe.');
define('_MI_RECETTE_STORY_APPROVE_NOTIFYDSC', 'Notification on publication of this recipe.');
define('_MI_RECETTE_STORY_APPROVE_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} Automatic Notification: Recipes publication');

define('_MI_RECETTE_RESTRICTINDEX', 'Restrict display of recipe categories on main page ?');
define('_MI_RECETTE_RESTRICTINDEXDSC', 'If you select yes, the users will only be able to view recipes of those recipe categories, for which their user group has access to.');
?>