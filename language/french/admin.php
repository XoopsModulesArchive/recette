<?php
// $Id: admin.php,v 1.8 2003/04/01 09:07:28 mvandam Exp $
// Support Francophone de Xoops (www.frxoops.org)
//%%%%%%        Admin Module Name  Articles         %%%%%
define("_AM_GEST_LNKCAT_TXTREDERR","Il y a eu un problème.");
define("_AM_GEST_LNKCAT_TXTRED","Les données ont été mis à jours");
define("_AM_GEST_LNKCAT_SUBMIT","Tout mêttre à jour.");
define("_AM_GEST_LNKCAT","Liaison des icônes avec les articles");
define("_AM_ICON_TITLE","Gestion des icônes");
define("_AM_ICON_CAT","Catégorie");
define("_AM_ICON_DESCR","Description");
define("_AM_ICON_IMG","Image");
define("_AM_ADD_OK","Ajout de l'icone ok");
define("_AM_ADD_KO","Ajout de l'icone ko");
define("_AM_DEL_OK","Suppression de l'icone ok");
define("_AM_DEL_KO","Suppression de l'icone ko");

define("_AM_FUSION_TITLE","Fusion d'ingrédient");
define("_AM_FUSION_SELECT","Sélectionner vos ingrédient");
define("_AM_FUSION_KEEP","Ingrédient conservé");
define("_AM_FUSION_CHANGED","Ingrédient changé");
define("_AM_FUSION_SUBMIT","modifier");
define("_AM_FUSION_PB","La fusion a produit des erreurs. Vérifier si vous avez coché l'alerte mise dans la page précédente.");
define("_AM_FUSION_OK","La fusion s'est bien passée.");
define("_AM_FUSION_ALERTE","Par la présente case à cocher, je prend note que les modifications engendrées par le bouton modifier seront irréversibles. Elle provoque le remplacement du deuxieme ingrédient par le premier.");

define("_AM_DBUPDATED","Base de donn&eacute;es mise &agrave; jour avec succ&egrave;s !");
define("_AM_CONFIG","Configuration des articles");
define("_AM_AUTOARTICLES","Articles automatis&eacute;s");
define("_AM_STORYID","ID de l'article");
define("_AM_TITLE","Titre");
define("_AM_TOPIC","Sujet");
define("_AM_POSTER","Exp&eacute;diteur");
define("_AM_PROGRAMMED","Date/Heure programm&eacute;es");
define("_AM_ACTION","Action");
define("_AM_EDIT","Editer");
define("_AM_DELETE","Effacer");
define("_AM_LAST10ARTS","Les %d derniers articles");
define("_AM_PUBLISHED","Publi&eacute; le"); // Published Date
define("_AM_GO","Ok");
define("_AM_EDITARTICLE","Editer l'article");
define("_AM_POSTNEWARTICLE","Poster un nouvel article");
define("_AM_ARTPUBLISHED","Votre article a &eacute;t&eacute; publi&eacute; !"); // mail
define("_AM_HELLO","Bonjour %s,"); // mail
define("_AM_YOURARTPUB","Votre article soumis sur notre site a &eacute;t&eacute; publi&eacute;."); // mail
define("_AM_TITLEC","Titre : "); // mail
define("_AM_URLC","URL : "); // mail
define("_AM_PUBLISHEDC","Publi&eacute; le : "); // mail
define("_AM_RUSUREDEL","Etes-vous s&ucirc;r de vouloir supprimer cet article et tous ses commentaires ?");
define("_AM_YES","Oui");
define("_AM_NO","Non");
define("_AM_INTROTEXT","Texte de l'introduction");
define("_AM_EXTEXT","La recette ");
define("_AM_ALLOWEDHTML","HTML autoris&eacute; :");
define("_AM_DISAMILEY","D&eacute;sactiver les &eacute;motic&ocirc;nes");
define("_AM_DISHTML","D&eacute;sactiver le HTML");
define("_AM_APPROVE","Approuver");
define("_AM_MOVETOTOP","D&eacute;placer cet article au Top");
define("_AM_CHANGEDATETIME","Changer la date/heure de publication");
define("_AM_NOWSETTIME","C'est maintenant mis sur : %s"); // %s is datetime of publish
define("_AM_CURRENTTIME","Actuellement il est : %s");  // %s is the current datetime
define("_AM_SETDATETIME","Param&eacute;trer la date/heure de publication");
define("_AM_MONTHC","Mois :");
define("_AM_DAYC","Jour :");
define("_AM_YEARC","Ann&eacute;e :");
define("_AM_TIMEC","Heure :");
define("_AM_PREVIEW","Pr&eacute;visualiser");
define("_AM_SAVE","Sauvegarder");
define("_AM_PUBINHOME","Publier en page d'accueil ?");
define("_AM_ADD","Ajouter");

//%%%%%%        Admin Module Name  Topics         %%%%%

define("_AM_ADDMTOPIC","Ajouter un sujet PRINCIPAL");
define("_AM_TOPICNAME","Nom du sujet");
define("_AM_MAX40CHAR","(maxi : 40 caract&egrave;res)");
define("_AM_TOPICIMG","Image du sujet");
define("_AM_IMGNAEXLOC","nom de l'image + extension plac&eacute; dans %s");
define("_AM_FEXAMPLE","par exemple : games.gif");
define("_AM_ADDSUBTOPIC","Ajouter un sous-sujet");
define("_AM_IN","dans");
define("_AM_MODIFYTOPIC","Modifier le sujet");
define("_AM_MODIFY","Modifier");
define("_AM_PARENTTOPIC","Sujet parent");
define("_AM_SAVECHANGE","Sauvegarder les changements");
define("_AM_DEL","Effacer");
define("_AM_CANCEL","Annuler");
define("_AM_WAYSYWTDTTAL","ATTENTION : Etes-vous s&ucirc;r de vouloir supprimer ce Sujet et TOUS ses Articles et Commentaires ?");


// Added in Beta6
define("_AM_TOPICSMNGR","Gestionnaire de sujets");
define("_AM_PEARTICLES","Envoyer/Editer des articles");
define("_AM_NEWSUB","Nouvelles propositions");
define("_AM_POSTED","Post&eacute; le");
define("_AM_GENERALCONF","Configuration g&eacute;n&eacute;rale");
define("_AM_CATEGPERMS","Permissions des catégories");

// Added in RC2
define("_AM_TOPICDISPLAY","Afficher l'image du sujet ?");
define("_AM_TOPICALIGN","Position");
define("_AM_RIGHT","Droite");
define("_AM_LEFT","Gauche");

define("_AM_EXPARTS","Articles expir&eacute;");
define("_AM_EXPIRED","Expir&eacute;");
define("_AM_CHANGEEXPDATETIME","Changer la date/heure d'expiration");
define("_AM_SETEXPDATETIME","Param&eacute;ter la date/heure d'expiration");
define("_AM_NOWSETEXPTIME","C'est maintenant mis sur : %s");

// Added in RC3
define("_AM_ERRORTOPICNAME", "Vous devez entrer un nom de sujet !");
define("_AM_EMPTYNODELETE", "Rien &agrave; supprimer !");

// Added 240304 (Mithrandir)
define("_AM_GROUPPERM", "Permissions des groupes");
define('_AM_SELFILE','S&eacute;lectionnez un fichier');

// Added by Hervé
define('_AM_UPLOAD_DBERROR_SAVE','Erreur pendant le rattachement d\'un fichier à un article');
define('_AM_UPLOAD_ERROR','Erreur pendant le téléchargement du fichier vers le serveur');
define('_AM_UPLOAD_ATTACHFILE','Fichier(s) attaché(s)');
define('_AM_APPROVEFORM', 'Permission d\'approuver');
define('_AM_SUBMITFORM', 'Permissions de soumettre');
define('_AM_VIEWFORM', 'Permissions de consulter');
define('_AM_APPROVEFORM_DESC', 'Choisissez qui peut approuver les articles');
define('_AM_SUBMITFORM_DESC', 'Choisissez qui peut soumettre des articles');
define('_AM_VIEWFORM_DESC', 'Choisissez qui peut voir quels sujets');
define('_AM_DELETE_SELFILES', 'Supprimer les fichiers sélectionnés');
define('_AM_TOPIC_PICTURE', 'Télécharger l\'image du sujet');
define('_AM_UPLOAD_WARNING', '<B>Attention, n\'oubliez pas d\'appliquer les permissions d\'écriture au répertoire suivant : %s </B>');
define('_AM_ADD_TOPIC', 'Ajouter un sujet');

define('_AM_RECETTE_UPGRADE', 'Mise à jour');
define('_AM_RECETTE_UPGRADECOMPLETE', 'Mise à jour terminée');
define('_AM_RECETTE_UPGRADEFAILED', 'La mise à jour à échouée');
define('_AM_UPDATEMODULE', 'Veuillez mettre à jour les templates et les blocs du module');

?>