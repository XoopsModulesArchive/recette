<?php
// $Id: admin.php,v 1.8 2003/04/01 09:07:28 mvandam Exp $
// Support Francophone de Xoops (www.frxoops.org)
//%%%%%%        Admin Module Name  Articles         %%%%%
define("_AM_ICON_TITLE","Verwaltung der Piktogramme");
define("_AM_ICON_CAT","Kategorie");
define("_AM_ICON_DESCR","Beschreibung");
define("_AM_ICON_IMG","Bild");
define("_AM_ADD_OK","Bild zufügen");
define("_AM_ADD_KO","Bild nicht zufügen");

define("_AM_FUSION_TITLE","Zutaten zusammenfügen");
define("_AM_FUSION_SELECT","Zutat auswählen");
define("_AM_FUSION_KEEP","Zutat behalten");
define("_AM_FUSION_CHANGED","Zutat wechseln");
define("_AM_FUSION_SUBMIT","ändern");
define("_AM_FUSION_PB","Zusammenfassen fehlerhaft. Prüfen, ob Sie die Bestätigung in der vorhergehenden Seite angekreuzt haben.");
define("_AM_FUSION_OK","Zusammenfassen war erfolgreich.");
define("_AM_FUSION_ALERTE","Hiermit nehme ich zur Kenntnis, daß die nachfolgenden Änderungen unwiderruflich sind. <br />Sie verursacht den Austausch der zweiten Zutat durch die erste.");

define('_AM_DBUPDATED','Datenbank wurde erfolgreich aktualisiert!');
define('_AM_CONFIG','Rezeptkonfiguration');
define('_AM_AUTOARTICLES','Automatisierte Rezepte');
define('_AM_STORYID','Rezept-ID');
define('_AM_TITLE','Rezepttitel');
define('_AM_TOPIC','Rezeptkategorie');
define('_AM_POSTER','Autor');
define('_AM_PROGRAMMED','Zeitgesteuerte Veröffentlichung');
define('_AM_ACTION','Aktion');
define('_AM_EDIT','Bearbeiten');
define('_AM_DELETE','Löschen');
define('_AM_LAST10ARTS','Die letzten 10 Rezepte');
define('_AM_PUBLISHED','Veröffentlicht am '); // Published Date
define('_AM_GO','Los!');
define('_AM_EDITARTICLE','Bearbeite Rezept');
define('_AM_POSTNEWARTICLE','Neues Rezept veröffentlichen');
define('_AM_ARTPUBLISHED','Ihr Rezept wurde veröffentlicht!');
define('_AM_HELLO','Hallo %s,');
define('_AM_YOURARTPUB','Das von Ihnen verfasste Rezept wurde veröffentlicht.');
define('_AM_TITLEC','Rezepttitel: ');
define('_AM_URLC','URL: ');
define('_AM_PUBLISHEDC','Veröffentlicht: ');
define('_AM_RUSUREDEL','Sind Sie sicher Sie wollen dieses Rezept und alle damit verbundenen Kommentare löschen');
define('_AM_YES','Ja');
define('_AM_NO','Nein');
define('_AM_INTROTEXT','Einführungstext');
define('_AM_EXTEXT','Das Rezept:');
define('_AM_ALLOWEDHTML','HTML-Tags erlauben:');
define('_AM_DISAMILEY','Smilies deaktivieren');
define('_AM_DISHTML','HTML deaktivieren');
define('_AM_APPROVE','Freigeben');
define('_AM_MOVETOTOP','Rezept nach oben verschieben');
define('_AM_CHANGEDATETIME','Datum/Uhrzeit der Veröffentlichung ändern');
define('_AM_NOWSETTIME','Veröffentlichung ist eingestellt auf: %s'); // %s is datetime of publish
define('_AM_CURRENTTIME','Aktuelle Uhrzeit: %s');  // %s is the current datetime
define('_AM_SETDATETIME','<b>Datum/Uhrzeit der Veröffentlichung setzen:</b>');
define('_AM_MONTHC','Monat:');
define('_AM_DAYC','Tag:');
define('_AM_YEARC','Jahr:');
define('_AM_TIMEC','Uhrzeit:');
define('_AM_PREVIEW','Vorschau');
define('_AM_SAVE','Sichern');
define('_AM_PUBINHOME','Auf der Indexseite anzeigen?');
define('_AM_ADD','Hinzufügen');

//%%%%%%        Admin Module Name  Topics         %%%%%

define('_AM_ADDMTOPIC','Eine Rezept-Hauptkategorie hinzufügen');
define('_AM_TOPICNAME','Rezepttitel');
define('_AM_MAX40CHAR','(max. 40 Zeichen)');
define('_AM_TOPICIMG','Rezeptkategoriebild');
define('_AM_IMGNAEXLOC','Bildname + Dateiendung befinden sich in %s');
define('_AM_FEXAMPLE','z. B.: games.gif');
define('_AM_ADDSUBTOPIC','Eine Rezept-Unterkategorie hinzufügen');
define('_AM_IN','in');
define('_AM_MODIFYTOPIC','Rezeptkategorie ändern');
define('_AM_MODIFY','Ändern');
define('_AM_PARENTTOPIC','Übergeordnerte Rezeptkategorie');
define('_AM_SAVECHANGE','Änderungen sichern');
define('_AM_DEL','Löschen');
define('_AM_CANCEL','Abbrechen');
define('_AM_WAYSYWTDTTAL','WARNUNG: Sind Sie sicher Sie wollen diese Rezeptkategorie und alle damit verbundenen Rezepte und Kommentare löschen?');


// Added in Beta6
define('_AM_TOPICSMNGR','Kategorien');
define('_AM_PEARTICLES','Rezepte bearbeiten');
define('_AM_NEWSUB','Neuzugänge');
define('_AM_POSTED','Veröffentlicht');
define('_AM_GENERALCONF','Modulkonfiguration');
define("_AM_CATEGPERMS","Erlaubnisse der Rezeptkategorie");

// Added in RC2
define('_AM_TOPICDISPLAY','Kategoriebild anzeigen?');
define('_AM_TOPICALIGN','Position');
define('_AM_RIGHT','Rechts');
define('_AM_LEFT','Links');

define('_AM_EXPARTS','Abgelaufene Rezepte');
define('_AM_EXPIRED','Abgelaufen');
define('_AM_CHANGEEXPDATETIME','Datum/Uhrzeit des Ablaufs ändern');
define('_AM_SETEXPDATETIME','Datum/Uhrzeit des Ablaufs setzen');
define('_AM_NOWSETEXPTIME','Aktuell eingestellt auf: %s');

// Added in RC3
define("_AM_ERRORTOPICNAME", "Sie müssen einen Rezeptkategorie Namen angeben!");
define("_AM_EMPTYNODELETE", "Nichts zu löschen!");

// Added 240304 (Mithrandir)
define('_AM_GROUPPERM', 'Rechtevergabe');
define('_AM_SELFILE','Datei auswählen');

// Added by Hervé
define('_AM_UPLOAD_DBERROR_SAVE','Fehler beim Anhängen der Datei');
define('_AM_UPLOAD_ERROR','Fehler beim Upload der Datei');
define('_AM_UPLOAD_ATTACHFILE','Angehängte Datei(en)');
define('_AM_APPROVEFORM', 'Berechtigung zur Freigabe');
define('_AM_SUBMITFORM', 'Berechtigung zum Schreiben');
define('_AM_VIEWFORM', 'Berechtigung zum Ansehen');
define('_AM_APPROVEFORM_DESC', 'Wer soll Rezepte freigeben können?');
define('_AM_SUBMITFORM_DESC', 'Wer soll Rezepte schreiben können?');
define('_AM_VIEWFORM_DESC', 'Wer soll die Rezeptkategorien sehen können?');
define('_AM_DELETE_SELFILES', 'Ausgewählte Datei(en) löschen');
define('_AM_TOPIC_PICTURE', 'Bild hochladen');
define('_AM_UPLOAD_WARNING', '<B>Hinweis - Bitte nicht vergessen, die Schreibberechtigung für den Ordner "%s" zu setzen!</B>');
define('_AM_ADD_TOPIC', 'Eine Rezeptkategorie hinzufügen');

define('_AM_RECETTE_UPGRADE', 'Upgrade');
define('_AM_RECETTE_UPGRADECOMPLETE', 'Upgrade Fertig');
define('_AM_RECETTE_UPGRADEFAILED', 'Fehler beim Upgrade');
define('_AM_UPDATEMODULE', 'Update Modultemplates und -Blocks');

?>