<?php
include '../../../include/cp_header.php';

xoops_cp_header();

if (is_object($xoopsUser) && $xoopsUser->isAdmin($xoopsModule->mid()))
{
	$sql=sprintf("SHOW TABLES LIKE '%s'",$xoopsDB->prefix('recette_cat'));
	$result=$xoopsDB->queryF($sql);
	if($xoopsDB->getRowsNum($result)==0)
	{
		$sql = "CREATE TABLE ".$xoopsDB->prefix('recette_cat')." (
		  id smallint(4) unsigned NOT NULL auto_increment,
		  categorie varchar(50) NOT NULL default '',
		  description varchar(50) NOT NULL default '',
		  image varchar(100) NOT NULL,
		  PRIMARY KEY (id)
		) TYPE=MyISAM;";

		$sql2 = "CREATE TABLE ".$xoopsDB->prefix('recette_lnk_cat')." (
		  id smallint(4) unsigned NOT NULL auto_increment,
		  categorie smallint(4) unsigned NOT NULL,
		  recette int(8) unsigned NOT NULL,
		  PRIMARY KEY (id)
		) TYPE=MyISAM;";
		if ($xoopsDB->queryF($sql) && $xoopsDB->queryF($sql2)) {
		    echo _AM_RECETTE_UPGRADECOMPLETE." - <a href='".XOOPS_URL."/modules/system/admin.php?fct=modulesadmin&op=update&module=recette'>"._AM_UPDATEMODULE."</a>";
		}
		else {
	    	echo _AM_recette_UPGRADEFAILED;
		}
	} else {
		redirect_header('index.php', 3, _AM_RECETTE_UPGRADECOMPLETE);
	}
} else {
	printf("<H2>Error, to use the upgrade script, you must be an admin on this module</H2>\n");
}
xoops_cp_footer();
?>
