<?php

// Module Info

// The name of this module
define('_MI_RECETTE_NAME','Rezepte');

// A brief description of this module
define('_MI_RECETTE_DESC','Erzeugt einen Rezepte-Bereich in dem Mitglieder Rezepte und Kommentare schreiben können.');

// Names of blocks for this module (Not all module has blocks)
define('_MI_RECETTE_BNAME1','Rezeptarten');
define('_MI_RECETTE_BNAME3','Rezept des Tages');
define('_MI_RECETTE_BNAME4','Top Rezept');
define('_MI_RECETTE_BNAME5','Meistgelesene Rezepte');
define('_MI_RECETTE_BNAME6','Rezepte moderieren');
define('_MI_RECETTE_BNAME7','Rezeptnavigation');
define('_MI_RECETTE_BNAME8','Rezeptarten-Block');
define('_MI_RECETTE_BNAME9','das letzte Rezept');

// Sub menus in main menu block
define('_MI_RECETTE_SMNAME1','Rezept schreiben');
define('_MI_RECETTE_SMNAME2','Archiv');
define('_MI_RECETTE_SMNAME3','Index der Zutaten');

// Names of admin menu items
define('_MI_RECETTE_ADMENU2','Kategorien');
define('_MI_RECETTE_ADMENU3','Rezepte bearbeiten');
define('_MI_RECETTE_GROUPPERMS', 'Rechtevergabe');
define('_MI_RECETTE_FUSION', 'Zutaten zusammenfügen');
define('_MI_RECETTE_ICONE', 'Verwaltung der Piktogramme');

// Title of config items
define('_MI_RECETTE_STORYHOME', 'Wieviel Rezepte auf der Indexseite?');
define('_MI_RECETTE_NOTIFYSUBMIT', 'Bei Rezepteingang benachrichtigen?');
define('_MI_RECETTE_DISPLAYNAV', 'Navigations-Box anzeigen?');
define('_MI_RECETTE_ANONPOST','Darf ein Gast ein Rezept veröffentlichen?');
define('_MI_RECETTE_AUTOAPPROVE','Rezept automatisch veröffentlichen?');
define("_MI_RECETTE_ALLOWEDSUBMITGROUPS", "Gruppenberechtigung zum Schreiben");
define("_MI_RECETTE_ALLOWEDAPPROVEGROUPS", "Gruppenberechtigung zum Freigeben");
define("_MI_RECETTE_NEWSDISPLAY", "Anzeigelayout");
define("_MI_RECETTE_NAMEDISPLAY","Name des Autors");
define("_MI_RECETTE_COLUMNMODE","Spalten");
define("_MI_RECETTE_STORYCOUNTADMIN","Anzahl der Rezepte, die im Adminbereich angezeigt werden: ");
define('_MI_RECETTE_UPLOADFILESIZE', 'MAX Dateigröße für Upload (KB) 1048576 = 1 MB');
define("_MI_RECETTE_UPLOADGROUPS","Gruppen, die uploaden dürfen");

// Description of each config items
define('_MI_RECETTE_STORYHOMEDSC', '');
define('_MI_RECETTE_NOTIFYSUBMITDSC', '');
define('_MI_RECETTE_DISPLAYNAVDSC', '');
define('_MI_RECETTE_AUTOAPPROVEDSC', '');
define("_MI_RECETTE_ALLOWEDSUBMITGROUPSDESC", "Die gewählten Gruppen dürfen Rezepte schreiben");
define("_MI_RECETTE_ALLOWEDAPPROVEGROUPSDESC", "Die gewählten Gruppen dürfen Rezepte");
define("_MI_RECETTE_NEWSDISPLAYDESC", "\"Klassisch\" zeigt die Rezepte sortiert nach Datum. \"Nach Kategorie\" gruppiert die Rezepte nach Kategorie wobei das neueste Rezept voll gezeigt wird - von den anderen wir nur der Titel gezeigt");
define('_MI_RECETTE_ADISPLAYNAMEDSC', 'Wie soll der Name des Autors angezeigt werden?');
define("_MI_RECETTE_COLUMNMODE_DESC","In wievielen Spalten soll die Rezeptliste angezeigt werden?");
define("_MI_RECETTE_STORYCOUNTADMIN_DESC","");
define("_MI_RECETTE_UPLOADFILESIZE_DESC","");
define("_MI_RECETTE_UPLOADGROUPS_DESC","Wählen Sie die Gruppen, die Dateien zum Server hochladen dürfen");


// Name of config item values
define("_MI_RECETTE_NEWSCLASSIC", "Klassisch");
define("_MI_RECETTE_NEWSBYTOPIC", "nach Kategorie");
define('_MI_RECETTE_DISPLAYNAME1', "Username" );
define('_MI_RECETTE_DISPLAYNAME2', "Voller Name");
define('_MI_RECETTE_DISPLAYNAME3', "Autor nicht anzeigen");
define("_MI_RECETTE_UPLOAD_GROUP1","Verfasser und Moderatoren");
define("_MI_RECETTE_UPLOAD_GROUP2","Nur Moderatoren");
define("_MI_RECETTE_UPLOAD_GROUP3","Upload deaktiviert");


// Text for notifications

define('_MI_RECETTE_GLOBAL_NOTIFY', 'Allgemein');
define('_MI_RECETTE_GLOBAL_NOTIFYDSC', 'Allgemeine News-Benachrichtigungsoptionen.');

define('_MI_RECETTE_STORY_NOTIFY', 'Rezepte');
define('_MI_RECETTE_STORY_NOTIFYDSC', 'Benachrichtigungsoptionen die das aktuelle Rezept betreffen.');

define('_MI_RECETTE_GLOBAL_NEWCATEGORY_NOTIFY', 'Neue Rezeptkategorie');
define('_MI_RECETTE_GLOBAL_NEWCATEGORY_NOTIFYCAP', 'Benachrichtigen wenn ein neue Rezeptkategorie angelegt worden ist.');
define('_MI_RECETTE_GLOBAL_NEWCATEGORY_NOTIFYDSC', 'Benachrichtigung wenn ein neue Rezeptkategorie angelegt worden ist.');
define('_MI_RECETTE_GLOBAL_NEWCATEGORY_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} Automatische Benachrichtigung: Neue Rezeptkategorie');

define('_MI_RECETTE_GLOBAL_STORYSUBMIT_NOTIFY', 'Neues Rezept eingeschickt');       
define('_MI_RECETTE_GLOBAL_STORYSUBMIT_NOTIFYCAP', 'Benachrichtigen wenn ein neues Rezept eingeschickt worden ist (noch freizugeben).');                           
define('_MI_RECETTE_GLOBAL_STORYSUBMIT_NOTIFYDSC', 'Benachrichtigung wenn ein neues Rezept eingeschickt worden ist (noch freizugeben).');                
define('_MI_RECETTE_GLOBAL_STORYSUBMIT_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} Automatische Benachrichtigung: Neues Rezept eingeschickt');                              

define('_MI_RECETTE_GLOBAL_NEWSTORY_NOTIFY', 'Neues Rezept');       
define('_MI_RECETTE_GLOBAL_NEWSTORY_NOTIFYCAP', 'Benachrichtigen wenn ein neues Rezept veröffentlicht worden ist.');
define('_MI_RECETTE_GLOBAL_NEWSTORY_NOTIFYDSC', 'Benachrichtigung wenn ein neues Rezept veröffentlicht worden ist.');
define('_MI_RECETTE_GLOBAL_NEWSTORY_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} Automatische Benachrichtigung: Neues Rezept veröffentlicht');                              

define('_MI_RECETTE_STORY_APPROVE_NOTIFY', 'Rezept freigegeben');
define('_MI_RECETTE_STORY_APPROVE_NOTIFYCAP', 'Benachrichtigen wenn dieses Rezept freigegeben worden ist.');
define('_MI_RECETTE_STORY_APPROVE_NOTIFYDSC', 'Benachrichtigung wenn dieses Rezept freigegeben worden ist.');
define('_MI_RECETTE_STORY_APPROVE_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} Automatische Benachrichtigung: Rezept freigegeben');

define('_MI_RECETTE_RESTRICTINDEX', 'Rezeptkategorie auf der Hauptseite einschränken?');
define('_MI_RECETTE_RESTRICTINDEXDSC', 'Wenn ja, können die Benutzer nur Rezepte sehen, für deren Rezeptkategorien sie eine Leseberechtigung besitzen');
?>