<?php
// $Id: admin.php,v 1.8 2003/04/01 09:07:28 mvandam Exp $
// Support Francophone de Xoops (www.frxoops.org)
//%%%%%%        Admin Module Name  Articles         %%%%%
define("_AM_ICON_TITLE","Verwaltung der Piktogramme");
define("_AM_ICON_CAT","Kategorie");
define("_AM_ICON_DESCR","Beschreibung");
define("_AM_ICON_IMG","Bild");
define("_AM_ADD_OK","Bild zuf�gen");
define("_AM_ADD_KO","Bild nicht zuf�gen");

define("_AM_FUSION_TITLE","Zutaten zusammenf�gen");
define("_AM_FUSION_SELECT","Zutat ausw�hlen");
define("_AM_FUSION_KEEP","Zutat behalten");
define("_AM_FUSION_CHANGED","Zutat wechseln");
define("_AM_FUSION_SUBMIT","�ndern");
define("_AM_FUSION_PB","Zusammenfassen fehlerhaft. Pr�fen, ob Sie die Best�tigung in der vorhergehenden Seite angekreuzt haben.");
define("_AM_FUSION_OK","Zusammenfassen war erfolgreich.");
define("_AM_FUSION_ALERTE","Hiermit nehme ich zur Kenntnis, da� die nachfolgenden �nderungen unwiderruflich sind. <br />Sie verursacht den Austausch der zweiten Zutat durch die erste.");

define('_AM_DBUPDATED','Datenbank wurde erfolgreich aktualisiert!');
define('_AM_CONFIG','Rezeptkonfiguration');
define('_AM_AUTOARTICLES','Automatisierte Rezepte');
define('_AM_STORYID','Rezept-ID');
define('_AM_TITLE','Rezepttitel');
define('_AM_TOPIC','Rezeptkategorie');
define('_AM_POSTER','Autor');
define('_AM_PROGRAMMED','Zeitgesteuerte Ver�ffentlichung');
define('_AM_ACTION','Aktion');
define('_AM_EDIT','Bearbeiten');
define('_AM_DELETE','L�schen');
define('_AM_LAST10ARTS','Die letzten 10 Rezepte');
define('_AM_PUBLISHED','Ver�ffentlicht am '); // Published Date
define('_AM_GO','Los!');
define('_AM_EDITARTICLE','Bearbeite Rezept');
define('_AM_POSTNEWARTICLE','Neues Rezept ver�ffentlichen');
define('_AM_ARTPUBLISHED','Ihr Rezept wurde ver�ffentlicht!');
define('_AM_HELLO','Hallo %s,');
define('_AM_YOURARTPUB','Das von Ihnen verfasste Rezept wurde ver�ffentlicht.');
define('_AM_TITLEC','Rezepttitel: ');
define('_AM_URLC','URL: ');
define('_AM_PUBLISHEDC','Ver�ffentlicht: ');
define('_AM_RUSUREDEL','Sind Sie sicher Sie wollen dieses Rezept und alle damit verbundenen Kommentare l�schen');
define('_AM_YES','Ja');
define('_AM_NO','Nein');
define('_AM_INTROTEXT','Einf�hrungstext');
define('_AM_EXTEXT','Das Rezept:');
define('_AM_ALLOWEDHTML','HTML-Tags erlauben:');
define('_AM_DISAMILEY','Smilies deaktivieren');
define('_AM_DISHTML','HTML deaktivieren');
define('_AM_APPROVE','Freigeben');
define('_AM_MOVETOTOP','Rezept nach oben verschieben');
define('_AM_CHANGEDATETIME','Datum/Uhrzeit der Ver�ffentlichung �ndern');
define('_AM_NOWSETTIME','Ver�ffentlichung ist eingestellt auf: %s'); // %s is datetime of publish
define('_AM_CURRENTTIME','Aktuelle Uhrzeit: %s');  // %s is the current datetime
define('_AM_SETDATETIME','<b>Datum/Uhrzeit der Ver�ffentlichung setzen:</b>');
define('_AM_MONTHC','Monat:');
define('_AM_DAYC','Tag:');
define('_AM_YEARC','Jahr:');
define('_AM_TIMEC','Uhrzeit:');
define('_AM_PREVIEW','Vorschau');
define('_AM_SAVE','Sichern');
define('_AM_PUBINHOME','Auf der Indexseite anzeigen?');
define('_AM_ADD','Hinzuf�gen');

//%%%%%%        Admin Module Name  Topics         %%%%%

define('_AM_ADDMTOPIC','Eine Rezept-Hauptkategorie hinzuf�gen');
define('_AM_TOPICNAME','Rezepttitel');
define('_AM_MAX40CHAR','(max. 40 Zeichen)');
define('_AM_TOPICIMG','Rezeptkategoriebild');
define('_AM_IMGNAEXLOC','Bildname + Dateiendung befinden sich in %s');
define('_AM_FEXAMPLE','z. B.: games.gif');
define('_AM_ADDSUBTOPIC','Eine Rezept-Unterkategorie hinzuf�gen');
define('_AM_IN','in');
define('_AM_MODIFYTOPIC','Rezeptkategorie �ndern');
define('_AM_MODIFY','�ndern');
define('_AM_PARENTTOPIC','�bergeordnerte Rezeptkategorie');
define('_AM_SAVECHANGE','�nderungen sichern');
define('_AM_DEL','L�schen');
define('_AM_CANCEL','Abbrechen');
define('_AM_WAYSYWTDTTAL','WARNUNG: Sind Sie sicher Sie wollen diese Rezeptkategorie und alle damit verbundenen Rezepte und Kommentare l�schen?');


// Added in Beta6
define('_AM_TOPICSMNGR','Kategorien');
define('_AM_PEARTICLES','Rezepte bearbeiten');
define('_AM_NEWSUB','Neuzug�nge');
define('_AM_POSTED','Ver�ffentlicht');
define('_AM_GENERALCONF','Modulkonfiguration');
define("_AM_CATEGPERMS","Erlaubnisse der Rezeptkategorie");

// Added in RC2
define('_AM_TOPICDISPLAY','Kategoriebild anzeigen?');
define('_AM_TOPICALIGN','Position');
define('_AM_RIGHT','Rechts');
define('_AM_LEFT','Links');

define('_AM_EXPARTS','Abgelaufene Rezepte');
define('_AM_EXPIRED','Abgelaufen');
define('_AM_CHANGEEXPDATETIME','Datum/Uhrzeit des Ablaufs �ndern');
define('_AM_SETEXPDATETIME','Datum/Uhrzeit des Ablaufs setzen');
define('_AM_NOWSETEXPTIME','Aktuell eingestellt auf: %s');

// Added in RC3
define("_AM_ERRORTOPICNAME", "Sie m�ssen einen Rezeptkategorie Namen angeben!");
define("_AM_EMPTYNODELETE", "Nichts zu l�schen!");

// Added 240304 (Mithrandir)
define('_AM_GROUPPERM', 'Rechtevergabe');
define('_AM_SELFILE','Datei ausw�hlen');

// Added by Herv�
define('_AM_UPLOAD_DBERROR_SAVE','Fehler beim Anh�ngen der Datei');
define('_AM_UPLOAD_ERROR','Fehler beim Upload der Datei');
define('_AM_UPLOAD_ATTACHFILE','Angeh�ngte Datei(en)');
define('_AM_APPROVEFORM', 'Berechtigung zur Freigabe');
define('_AM_SUBMITFORM', 'Berechtigung zum Schreiben');
define('_AM_VIEWFORM', 'Berechtigung zum Ansehen');
define('_AM_APPROVEFORM_DESC', 'Wer soll Rezepte freigeben k�nnen?');
define('_AM_SUBMITFORM_DESC', 'Wer soll Rezepte schreiben k�nnen?');
define('_AM_VIEWFORM_DESC', 'Wer soll die Rezeptkategorien sehen k�nnen?');
define('_AM_DELETE_SELFILES', 'Ausgew�hlte Datei(en) l�schen');
define('_AM_TOPIC_PICTURE', 'Bild hochladen');
define('_AM_UPLOAD_WARNING', '<B>Hinweis - Bitte nicht vergessen, die Schreibberechtigung f�r den Ordner "%s" zu setzen!</B>');
define('_AM_ADD_TOPIC', 'Eine Rezeptkategorie hinzuf�gen');

define('_AM_RECETTE_UPGRADE', 'Upgrade');
define('_AM_RECETTE_UPGRADECOMPLETE', 'Upgrade Fertig');
define('_AM_RECETTE_UPGRADEFAILED', 'Fehler beim Upgrade');
define('_AM_UPDATEMODULE', 'Update Modultemplates und -Blocks');

?>