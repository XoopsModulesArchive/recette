<?php
function adminmenu($currentoption=0)
{
    global $xoopsModule, $xoopsConfig;
    $tblColors=Array();
    $tblColors[0]=$tblColors[1]=$tblColors[2]=$tblColors[3]=$tblColors[4]=$tblColors[5]=$tblColors[6]=$tblColors[7]=$tblColors[8]='#DDE';
    $tblColors[$currentoption]='white';
    if (file_exists(XOOPS_ROOT_PATH.'/modules/'.$xoopsModule->getVar('dirname').'/language/'.$xoopsConfig['language'].'/modinfo.php')) {
        include_once '../language/'.$xoopsConfig['language'].'/modinfo.php';
    }
    else {
        include_once '../language/english/modinfo.php';
    }
	echo "<div id=\"navcontainer\"><ul style=\"padding: 3px 0; margin-left: 0; font: bold 12px Verdana, sans-serif; \">";
	echo "<li style=\"list-style: none; margin: 0; display: inline; \"><a href=\"index.php?op=topicsmanager\" style=\"padding: 3px 0.5em; margin-left: 3px; border: 1px solid #778; background: ".$tblColors[0]."; text-decoration: none; \">"._MI_RECETTE_ADMENU2."</a></li>";
	echo "<li style=\"list-style: none; margin: 0; display: inline; \"><a href=\"index.php?op=newarticle\" style=\"padding: 3px 0.5em; margin-left: 3px; border: 1px solid #778; background: ".$tblColors[1]."; text-decoration: none; \">"._MI_RECETTE_ADMENU3."</a></li>";
	echo "<li style=\"list-style: none; margin: 0; display: inline; \"><a href=\"groupperms.php\" style=\"padding: 3px 0.5em; margin-left: 3px; border: 1px solid #778; background: ".$tblColors[2]."; text-decoration: none; \">"._MI_RECETTE_GROUPPERMS."</a></li><br><br><br>";
	echo "<li style=\"list-style: none; margin: 0; display: inline; \"><a href=\"../../system/admin.php?fct=preferences&amp;op=showmod&amp;mod=".$xoopsModule -> getVar( 'mid' )."\" style=\"padding: 3px 0.5em; margin-left: 3px; border: 1px solid #778; background: ".$tblColors[3]."; text-decoration: none; \">"._PREFERENCES."</a></li>";
	if ($xoopsModule->getVar('version') != 121) {
	    echo "<li style=\"list-style: none; margin: 0; display: inline; \"><a href=\"upgrade.php\" style=\"padding: 3px 0.5em; margin-left: 3px; border: 1px solid #778; background: ".$tblColors[4]."; text-decoration: none; \">"._AM_RECETTE_UPGRADE."</a></li>";
	}
	echo "<li style=\"list-style: none; margin: 0; display: inline; \"><a href=\"index.php?op=fusion\" style=\"padding: 3px 0.5em; margin-left: 3px; border: 1px solid #778; background: ".$tblColors[5]."; text-decoration: none; \">"._MI_RECETTE_FUSION."</a></li>";		
	echo "<li style=\"list-style: none; margin: 0; display: inline; \"><a href=\"index.php?op=gestCat\" style=\"padding: 3px 0.5em; margin-left: 3px; border: 1px solid #778; background: ".$tblColors[6]."; text-decoration: none; \">"._MI_RECETTE_ICONE."</a></li>";
	echo "<li style=\"list-style: none; margin: 0; display: inline; \"><a href=\"index.php?op=gestCatLnk\" style=\"padding: 3px 0.5em; margin-left: 3px; border: 1px solid #778; background: ".$tblColors[7]."; text-decoration: none; \">"._MI_RECETTE_LNK."</a></li>";		
	echo "</div></ul>";
}
?>
