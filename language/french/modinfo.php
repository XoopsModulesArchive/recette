<?php
// $Id: modinfo.php,v 1.2 2004/01/29 17:15:54 mithyt2 Exp $
// Module Info

// The name of this module
define('_MI_RECETTE_NAME','Recettes');

// A brief description of this module
define('_MI_RECETTE_DESC','Cr&eacute;e une section de recettes, o&ugrave; les utilisateurs peuvent poster des articles/commentaires.');

// Names of blocks for this module (Not all module has blocks)
define('_MI_RECETTE_BNAME1','Type de recette');
define('_MI_RECETTE_BNAME3','Recette du jour');
define('_MI_RECETTE_BNAME4','Top Recettes');
define('_MI_RECETTE_BNAME5','Recettes r&eacute;cents');
define('_MI_RECETTE_BNAME6','Mod&eacute;ration des recettes');
define('_MI_RECETTE_BNAME7','Navigation dans les types de recette');
define('_MI_RECETTE_BNAME8','Recette récents d\'un sujet');
define('_MI_RECETTE_BNAME9','La dernière recettes');

// Sub menus in main menu block
define('_MI_RECETTE_SMNAME1','Proposer une recette');
define('_MI_RECETTE_SMNAME2','Archives');
define('_MI_RECETTE_SMNAME3','Index des ingredients');

// Names of admin menu items
define('_MI_RECETTE_ADMENU2', 'Gestionnaire de types de recette');
define('_MI_RECETTE_ADMENU3', 'Envoyer/Editer des recettes');
define('_MI_RECETTE_GROUPPERMS', 'Permissions des groupes');
define('_MI_RECETTE_FUSION', 'Fusion des ingrédients');
define('_MI_RECETTE_ICONE', 'Gestion des icônes');
define('_MI_RECETTE_LNK','Gestion des liens entre icônes et recette');


// Title of config items
define('_MI_RECETTE_STORYHOME', 'Combien de recette(s) sur la page principale ?');
define('_MI_RECETTE_NOTIFYSUBMIT', 'Notifier par mail d\'une nouvelle proposition ?');
define('_MI_RECETTE_DISPLAYNAV', 'Afficher la bo&icirc;te de navigation en haut de chaque page ?');
define('_MI_RECETTE_ANONPOST','Autoriser les utilisateurs anonymes &agrave; envoyer de nouvelles recettes ?');
define('_MI_RECETTE_AUTOAPPROVE','Approuver automatiquement les nouvelles recettes sans l\'intervention d\'un administrateur ?');
define("_MI_RECETTE_ALLOWEDSUBMITGROUPS", "Groupes pouvant soumettre des recettes");
define("_MI_RECETTE_ALLOWEDAPPROVEGROUPS", "Groupes qui peuvent approuver des recettes");
define("_MI_RECETTE_NEWSDISPLAY", "Mise en page des recettes");
define("_MI_RECETTE_NAMEDISPLAY","Nom d'auteur &agrave; utiliser");
define("_MI_RECETTE_COLUMNMODE","Colonnes");
define("_MI_RECETTE_STORYCOUNTADMIN","Nombre de recettes à afficher dans l'administration : ");
define("_MI_RECETTE_UPLOADFILESIZE", "Taille maximal des envois en Ko (1048576 = 1 Méga)");
define("_MI_RECETTE_UPLOADGROUPS","Groupes autorisés joindre des fichiers aux recettes");

// Description of each config items
define('_MI_RECETTE_STORYHOMEDSC', '');
define('_MI_RECETTE_NOTIFYSUBMITDSC', '');
define('_MI_RECETTE_DISPLAYNAVDSC', '');
define('_MI_RECETTE_AUTOAPPROVEDSC', '');
define("_MI_RECETTE_ALLOWEDSUBMITGROUPSDESC", "Les groupes s&eacute;lectionn&eacute;s seront autoris&eacute;s &agrave; soumettre des recettes");
define("_MI_RECETTE_ALLOWEDAPPROVEGROUPSDESC", "Les groupes s&eacute;lectionn&eacute;s seront autoris&eacute;s &agrave; approuver les nouvelles recettes");
define("_MI_RECETTE_NEWSDISPLAYDESC", "Le mode \"Classique\" affiche tous les nouvelles recettes tri&eacute;s par date de publication. Le mode \"Recettes par type\" groupera les recettes par type avec la derniere recette d&eacute;velopp&eacute; et les autres avec juste le titre");
define('_MI_RECETTE_ADISPLAYNAMEDSC', 'Permet de choisir sous quelle forme le nom de l\'auteur doit être affich&eacute;');
define("_MI_RECETTE_COLUMNMODE_DESC","Choisissez le nombre de colonnes &agrave; utiliser pour afficher les recettes (cette option n'est utilisable qu'avec le mode d'affichage 'classique')");
define("_MI_RECETTE_STORYCOUNTADMIN_DESC","");
define("_MI_RECETTE_UPLOADFILESIZE_DESC","");
define("_MI_RECETTE_UPLOADGROUPS_DESC","Choisissez les groupes qui peuvent télécharger vers le serveur");


// Name of config item values
define("_MI_RECETTE_NEWSCLASSIC", "Classique");
define("_MI_RECETTE_NEWSBYTOPIC", "Recettes par type");
define('_MI_RECETTE_DISPLAYNAME1', 'Pseudo');
define('_MI_RECETTE_DISPLAYNAME2', 'Nom complet');
define('_MI_RECETTE_DISPLAYNAME3', 'Aucun');
define("_MI_RECETTE_UPLOAD_GROUP1","Editeurs et Approbateurs");
define("_MI_RECETTE_UPLOAD_GROUP2","Approbateurs uniquement");
define("_MI_RECETTE_UPLOAD_GROUP3","Téléchargement désactivé");


// Text for notifications

define('_MI_RECETTE_GLOBAL_NOTIFY', 'Globale');
define('_MI_RECETTE_GLOBAL_NOTIFYDSC', 'Options de notification globales des recettes.');

define('_MI_RECETTE_STORY_NOTIFY', 'Recettes');
define('_MI_RECETTE_STORY_NOTIFYDSC', 'Options de notification s\'appliquant &agrave; la recette actuelle.');

define('_MI_RECETTE_GLOBAL_NEWCATEGORY_NOTIFY', 'Nouveau type');
define('_MI_RECETTE_GLOBAL_NEWCATEGORY_NOTIFYCAP', 'Notifiez-moi quand un nouveau type est cr&eacute;&eacute;.');
define('_MI_RECETTE_GLOBAL_NEWCATEGORY_NOTIFYDSC', 'Recevoir une notification quand un nouveau type est cr&eacute;&eacute;.');
define('_MI_RECETTE_GLOBAL_NEWCATEGORY_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} notification automatique : Nouvel Recette');

define('_MI_RECETTE_GLOBAL_STORYSUBMIT_NOTIFY', 'Nouvel recette propos&eacute;');
define('_MI_RECETTE_GLOBAL_STORYSUBMIT_NOTIFYCAP', 'Notifiez-moi lorsqu\'une nouvelle recette est propos&eacute; (attente d\'&ecirc;tre approuv&eacute;).');
define('_MI_RECETTE_GLOBAL_STORYSUBMIT_NOTIFYDSC', 'Recevoir une notification lorsqu\'une nouvelle recette est propos&eacute; (attente d\'&ecirc;tre approuv&eacute;).');
define('_MI_RECETTE_GLOBAL_STORYSUBMIT_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} notification automatique : Nouvelle recette propos&eacute;e');

define('_MI_RECETTE_GLOBAL_NEWSTORY_NOTIFY', 'Nouvel recette');
define('_MI_RECETTE_GLOBAL_NEWSTORY_NOTIFYCAP', 'Notifiez-moi quand une nouvelle recette est post&eacute;e.');
define('_MI_RECETTE_GLOBAL_NEWSTORY_NOTIFYDSC', 'Recevoir une notification quand une nouvelle recette est post&eacute;e.');
define('_MI_RECETTE_GLOBAL_NEWSTORY_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} notification automatique : Nouvelle recette');

define('_MI_RECETTE_STORY_APPROVE_NOTIFY', 'Recette approuv&eacute;');
define('_MI_RECETTE_STORY_APPROVE_NOTIFYCAP', 'Notifiez-moi quand cette recette est approuv&eacute;.');
define('_MI_RECETTE_STORY_APPROVE_NOTIFYDSC', 'Recevoir une notification quand cette recette est approuv&eacute;e.');
define('_MI_RECETTE_STORY_APPROVE_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} notification automatique : Recette approuv&eacute;e');

define('_MI_RECETTE_RESTRICTINDEX', 'Restreindre les sujets sur la page d\'index ?');
define('_MI_RECETTE_RESTRICTINDEXDSC', 'Si l\'option est à Oui, les utilisateurs ne verront que les recettes pour lesquels ils ont les permissions de lecture');
?>
