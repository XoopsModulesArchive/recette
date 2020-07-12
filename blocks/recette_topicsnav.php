<?php
// $Id: recette_topicsnav.php,v 1.3 2004/05/25 08:19:59 hthouzard Exp $
//  ------------------------------------------------------------------------ //
//                XOOPS - PHP Content Management System                      //
//                    Copyright (c) 2000 XOOPS.org                           //
//                       <http://www.xoops.org/>                             //
// ------------------------------------------------------------------------- //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
//                                                                           //
//  You may not change or alter any portion of this comment or credits       //
//  of supporting developers from this source code or any supporting         //
//  source code which is considered copyrighted (c) material of the          //
//  original comment or credit authors.                                      //
//                                                                           //
//  This program is distributed in the hope that it will be useful,          //
//  but WITHOUT ANY WARRANTY; without even the implied warranty of           //
//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            //
//  GNU General Public License for more details.                             //
//                                                                           //
//  You should have received a copy of the GNU General Public License        //
//  along with this program; if not, write to the Free Software              //
//  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA //
//  ------------------------------------------------------------------------ //

function b_recette_topicsnav_show($options) {
	global $xoopsDB, $xoopsUser;
	$myts =& MyTextSanitizer::getInstance();
	$block = array();
	$topicclause = "";
	if ($options[0] == 'restrict') {
	    $groups = $xoopsUser ? $xoopsUser->getGroups() : XOOPS_GROUP_ANONYMOUS;
	    $gperm_handler =& xoops_gethandler('groupperm');
	    $module_handler =& xoops_gethandler('module');
	    $newsmodule =& $module_handler->getByDirname("news");
	    $topics = $gperm_handler->getItemIds('recette_view', $groups, $newsmodule->getVar('mid'));
		if(count($topics)>0) {
	    	$topicclause = "AND topic_id IN (".implode(',', $topics).")";
		}
	}
	$sql = "SELECT topic_id, topic_title FROM ".$xoopsDB->prefix("recette_topics")." WHERE topic_pid=0 $topicclause ORDER BY topic_title";
	$result = $xoopsDB->query($sql);
	while ($topic = $xoopsDB->fetchArray($result)) {
	    $block['topics'][] = array('id' => $topic['topic_id'], 'title' => $myts->makeTboxData4Show($topic['topic_title']));
	}
	return $block;
}

function b_recette_topicsnav_edit($options) {
    $form = ""._MB_recette_RESTRICTTOPICS."&nbsp;<select name='options[]'>";
	$form .= "<option value='restrict'";
	if ( $options[0] == 'restrict' ) {
		$form .= " selected='selected'";
	}
	$form .= ">"._YES."</option>\n";
	$form .= "<option value='norestrict'";
	if($options[0] == 'norestrict'){
		$form .= " selected='selected'";
	}
	$form .= ">"._NO."</option>\n";
	$form .= "</select>\n";
	return $form;
}
?>