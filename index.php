<?php
// $Id: index.php,v 1.15 2004/05/25 10:53:08 mithyt2 Exp $
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
include '../../mainfile.php';

include_once XOOPS_ROOT_PATH.'/modules/recette/class/class.newsstory.php';

if (isset($_GET['storytopic'])) {
    $groups = $xoopsUser ? $xoopsUser->getGroups() : XOOPS_GROUP_ANONYMOUS;
    $gperm_handler =& xoops_gethandler('groupperm');
    if (!$gperm_handler->checkRight('recette_view', $_GET['storytopic'], $groups, $xoopsModule->getVar('mid'))) {
        redirect_header('index.php', 3, _NOPERM);
        exit();
    }
	$xoopsOption['storytopic'] = intval($_GET['storytopic']);
} else {
	$xoopsOption['storytopic'] = 0;
}
if ( isset($_GET['storynum']) ) {
	$xoopsOption['storynum'] = intval($_GET['storynum']);
	if ($xoopsOption['storynum'] > 30) {
		$xoopsOption['storynum'] = $xoopsModuleConfig['storyhome'];
	}
} else {
	$xoopsOption['storynum'] = $xoopsModuleConfig['storyhome'];
}

if ( isset($_GET['start']) ) {
	$start = intval($_GET['start']);
} else {
	$start = 0;
}
if (empty($xoopsModuleConfig['newsdisplay']) || $xoopsModuleConfig['newsdisplay'] == 'Classic' || $xoopsOption['storytopic'] > 0) {
    $showclassic = 1;
}
else {
    $showclassic = 0;
}
$firsttitle='';
$myts =& MyTextSanitizer::getInstance();

$column_count = $xoopsModuleConfig['columnmode'];
if ($showclassic && !isset($_GET['ingid']) ) {
    $xoopsOption['template_main'] = 'recette_index.html';
	include XOOPS_ROOT_PATH.'/header.php';
    $xoopsTpl->assign('columnwidth', intval(1/$column_count*100));
	if ($xoopsModuleConfig['displaynav'] == 1 ) {
        $xoopsTpl->assign('displaynav', true);
        $xt = new XoopsTopic($xoopsDB->prefix('recette_topics'));
        ob_start();
        $xt->makeTopicSelBox(1, $xoopsOption['storytopic'], 'storytopic');
        $topic_select = ob_get_contents();
        ob_end_clean();
        $xoopsTpl->assign('topic_select', $topic_select);
        $storynum_options = '';
        for ( $i = 5; $i <= 30; $i = $i + 5 ) {
            $sel = '';
            if ($i == $xoopsOption['storynum']) {
                $sel = ' selected="selected"';
            }
            $storynum_options .= '<option value="'.$i.'"'.$sel.'>'.$i.'</option>';
        }
        $xoopsTpl->assign('storynum_options', $storynum_options);
    }
    else {
        $xoopsTpl->assign('displaynav', false);
    }
	$sarray = NewsStory::getAllPublished($xoopsOption['storynum'], $start, $xoopsModuleConfig['restrictindex'], $xoopsOption['storytopic']);

    $scount = count($sarray);
    $xoopsTpl->assign('story_count', $scount);
    $k = 0;
    $columns = array();
    foreach ($sarray as $storyid => $thisstory) {
        $story = $thisstory->prepare2show();
        // The line below can be used to display a Permanent Link image
        // $story['title'] .= "&nbsp;&nbsp;<a href='".XOOPS_URL."/modules/recette/article.php?storyid=".$sarray[$i]->storyid()."'><img src='".XOOPS_URL."/modules/recette/images/x.gif' alt='Permanent Link' /></a>";
       	if($firsttitle=='')
       	{
       		$firsttitle=$myts->makeTboxData4Show($thisstory->topic_title()) . ' - ' .  $myts->makeTboxData4Show($thisstory->title());
       	}
        $story['title'] = $thisstory->textlink().'&nbsp;:&nbsp;'.$story['title'];
        $columns[$k][] = $story;
        $k++;
        if ($k == $column_count) {
            $k = 0;
        }
	}
	$xoopsTpl->assign('columns', $columns);
	unset($story);

	$totalcount = NewsStory::countPublishedByTopic($xoopsOption['storytopic'], $xoopsModuleConfig['restrictindex']);
    if ( $totalcount > $scount ) {
        include_once XOOPS_ROOT_PATH.'/class/pagenav.php';
        $pagenav = new XoopsPageNav($totalcount, $xoopsOption['storynum'], $start, 'start', 'storytopic='.$xoopsOption['storytopic']);
        $xoopsTpl->assign('pagenav', $pagenav->renderNav());
    }
    else {
        $xoopsTpl->assign('pagenav', '');
    }
}
else {
    $xoopsOption['template_main'] = 'recette_by_topic.html';
    include XOOPS_ROOT_PATH.'/header.php';
    $xoopsTpl->assign('columnwidth', intval(1/$column_count*100));
	$xt = new XoopsTopic($xoopsDB->prefix("recette_topics"));
    $alltopics =& $xt->getTopicsList();
    $smarty_topics = array();
	$allstories = array();
	if ( isset($_GET['ingid']) )
	{
	    $allstories = NewsStory::getAllByIng( $_GET['ingid'],0, 0, $xoopsModuleConfig['restrictindex'] );	
	}
	else
	{
	    $allstories = NewsStory::getAllPublished(0, 0, $xoopsModuleConfig['restrictindex']);
	}
    $topicstories = array();
    foreach ($allstories as $thisstory) {
        if (!isset($topicstories[$thisstory->topicid()]) || count($topicstories[$thisstory->topicid()]) < $xoopsModuleConfig['storyhome']) {
            $topicstories[$thisstory->topicid()][] = $thisstory->prepare2show();
        }
    }
    foreach ($alltopics as $topicid => $topic) {
        if (isset($topicstories[$topicid])) {
        	if($firsttitle=='')
        	{
        		$firsttitle=$myts->makeTboxData4Show($topic['title']);
        	}
            $smarty_topics[$topicstories[$topicid][0]['posttimestamp']] = array('title' => $topic['title'], 'stories' => $topicstories[$topicid], 'id' => $topicid);
        }
    }
    krsort($smarty_topics);
    $columns = array();
    $i = 0;
    foreach ($smarty_topics as $thistopictimestamp => $thistopic) {
        $columns[$i][] = $thistopic;
        $i++;
        if ($i == $column_count) {
            $i = 0;
        }
    }
    //$xoopsTpl->assign('topics', $smarty_topics);
    $xoopsTpl->assign('columns', $columns);
}
if($firsttitle!='') {
	$xoopsTpl->assign('xoops_pagetitle', $myts->makeTboxData4Show($xoopsModule->name()) . ' - ' . $myts->makeTboxData4Show($firsttitle));
}
$xoopsTpl->assign('lang_go', _GO);
$xoopsTpl->assign('lang_on', _ON);
$xoopsTpl->assign('lang_printerpage', _NW_PRINTERFRIENDLY);
$xoopsTpl->assign('lang_sendstory', _NW_SENDSTORY);
$xoopsTpl->assign('lang_postedby', _POSTEDBY);
$xoopsTpl->assign('lang_reads', _READS);
$xoopsTpl->assign('lang_morereleases', _NW_MORERELEASES);
include_once XOOPS_ROOT_PATH.'/footer.php';
?>
