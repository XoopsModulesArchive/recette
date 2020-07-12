<?php
// $Id: admin.php,v 1.8 2003/04/01 09:07:28 mvandam Exp $
// Support Francophone de Xoops (www.frxoops.org)
//%%%%%%        Admin Module Name  Articles         %%%%%
define('_AM_ICON_TITLE', 'Manage Pictograms');
define('_AM_ICON_CAT', 'Category');
define('_AM_ICON_DESCR', 'Description');
define('_AM_ICON_IMG', 'Image');
define('_AM_ADD_OK', 'Add image');
define('_AM_ADD_KO', 'Don\\\'t add image');

define('_AM_FUSION_TITLE', 'Add ingredients');
define('_AM_FUSION_SELECT', 'Select ingredients');
define('_AM_FUSION_KEEP', 'Keep ingredients');
define('_AM_FUSION_CHANGED', 'Change ingredients');
define('_AM_FUSION_SUBMIT', 'change');
define('_AM_FUSION_PB', 'Summary contains errors. Please check, if you have confirmed the action on the previous page.');
define('_AM_FUSION_OK', 'Summary was successful');
define('_AM_FUSION_ALERTE', 'I confirm, that the applied changes can not be reverted back to the original form.<br />This will cause the first ingredient to be replaced with the second.');

define('_AM_DBUPDATED', 'Database has been successfully updated !');
define('_AM_CONFIG', 'Recipe Konfiguration');
define('_AM_AUTOARTICLES', 'Automated Recipes');
define('_AM_STORYID', 'Recipe-ID');
define('_AM_TITLE', 'Recipe Title');
define('_AM_TOPIC', 'Recipe Category');
define('_AM_POSTER', 'Author');
define('_AM_PROGRAMMED', 'Timecontrolled Release');
define('_AM_ACTION', 'Action');
define('_AM_EDIT', 'Modify');
define('_AM_DELETE', 'Delete');
define('_AM_LAST10ARTS', 'The last 10 recipes');
define('_AM_PUBLISHED', 'Published on'); // Published Date
define('_AM_GO', 'Go!');
define('_AM_EDITARTICLE', 'Modify recipe');
define('_AM_POSTNEWARTICLE', 'Publish new recipe');
define('_AM_ARTPUBLISHED', 'Your recipe has been published !');
define('_AM_HELLO', 'Hello %s,');
define('_AM_YOURARTPUB', 'The recipe you have created has been published.');
define('_AM_TITLEC', 'Recipe title');
define('_AM_URLC', 'URL:');
define('_AM_PUBLISHEDC', 'Published:');
define('_AM_RUSUREDEL', 'Are you sure, you want to delet this recipe and all associated comments');
define('_AM_YES', 'Yes');
define('_AM_NO', 'No');
define('_AM_INTROTEXT', 'Introduction text');
define('_AM_EXTEXT', 'The recipe:');
define('_AM_ALLOWEDHTML', 'Allow HTML tags');
define('_AM_DISAMILEY', 'Deactivate smilies');
define('_AM_DISHTML', 'Deactivate HTML');
define('_AM_APPROVE', 'Release');
define('_AM_MOVETOTOP', 'Move recipe to the top');
define('_AM_CHANGEDATETIME', 'Change date/time of publication');
define('_AM_NOWSETTIME', 'Publication date is set to : %s'); // %s is datetime of publish
define('_AM_CURRENTTIME', 'Current time : %s');  // %s is the current datetime
define('_AM_SETDATETIME', '<strong>Set date/time of publication to :</strong>');
define('_AM_MONTHC', 'Month :');
define('_AM_DAYC', 'Day :');
define('_AM_YEARC', 'Year :');
define('_AM_TIMEC', 'Time :');
define('_AM_PREVIEW', 'Preview');
define('_AM_SAVE', 'Save');
define('_AM_PUBINHOME', 'Display on index page ?');
define('_AM_ADD', 'Add');

//%%%%%%        Admin Module Name  Topics         %%%%%

define('_AM_ADDMTOPIC', 'Add a recipe main category');
define('_AM_TOPICNAME', 'Recipe title');
define('_AM_MAX40CHAR', '(max. 40 characters)');
define('_AM_TOPICIMG', 'Image of recipe category');
define('_AM_IMGNAEXLOC', 'Image filename (including extension) can be found at %s');
define('_AM_FEXAMPLE', 'z.B: games.gif');
define('_AM_ADDSUBTOPIC', 'Create a recipe sub-category');
define('_AM_IN', 'in');
define('_AM_MODIFYTOPIC', 'Modify recipe category');
define('_AM_MODIFY', 'Modify');
define('_AM_PARENTTOPIC', 'Parent recipe category');
define('_AM_SAVECHANGE', 'Save changes');
define('_AM_DEL', 'Delete');
define('_AM_CANCEL', 'Cancel');
define('_AM_WAYSYWTDTTAL', 'WARNING: Are you sure you want to delete this recipe category and all associated recipes and comments ?');


// Added in Beta6
define('_AM_TOPICSMNGR', 'Category');
define('_AM_PEARTICLES', 'Modify recipe');
define('_AM_NEWSUB', 'New entries');
define('_AM_POSTED', 'Published');
define('_AM_GENERALCONF', 'Modul konfiguration');
define('_AM_CATEGPERMS', 'Recipe category permissions');

// Added in RC2
define('_AM_TOPICDISPLAY', 'Display category image ?');
define('_AM_TOPICALIGN', 'Position');
define('_AM_RIGHT', 'right');
define('_AM_LEFT', 'left');

define('_AM_EXPARTS', 'Expired recipes');
define('_AM_EXPIRED', 'Expired');
define('_AM_CHANGEEXPDATETIME', 'Change date/time of expiration');
define('_AM_SETEXPDATETIME', 'Set date/time of expiration');
define('_AM_NOWSETEXPTIME', 'Currently set to : %s');

// Added in RC3
define('_AM_ERRORTOPICNAME', 'You must provide a recipe category name !');
define('_AM_EMPTYNODELETE', 'Nothing to delete !');

// Added 240304 (Mithrandir)
define('_AM_GROUPPERM', 'Permissions');
define('_AM_SELFILE', 'Select file');

// Added by Hervé
define('_AM_UPLOAD_DBERROR_SAVE', 'Error attaching file');
define('_AM_UPLOAD_ERROR', 'Error while uploading file');
define('_AM_UPLOAD_ATTACHFILE', 'Attached file(s)');
define('_AM_APPROVEFORM', 'Permission to publish');
define('_AM_SUBMITFORM', 'Permission to submit');
define('_AM_VIEWFORM', 'Permission to view');
define('_AM_APPROVEFORM_DESC', 'Who may publish recipes ?');
define('_AM_SUBMITFORM_DESC', 'Who may submit recipes ?');
define('_AM_VIEWFORM_DESC', 'Who my view recipe categories ?');
define('_AM_DELETE_SELFILES', 'Delete selected file(s)');
define('_AM_TOPIC_PICTURE', 'Upload image');
define('_AM_UPLOAD_WARNING', '<strong>Attention - Please do not forget to chmod the folder \\\"%s\\\" !</strong>');
define('_AM_ADD_TOPIC', 'Add recipe category');

define('_AM_RECETTE_UPGRADE', 'Upgrade');
define('_AM_RECETTE_UPGRADECOMPLETE', 'Upgrade done');
define('_AM_RECETTE_UPGRADEFAILED', 'Error while upgrading');
define('_AM_UPDATEMODULE', 'Update modul templates and blocks');

?>