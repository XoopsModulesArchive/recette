<?php
// $Id: recette_top.php,v 1.8 2004/05/21 14:34:54 hthouzard Exp $
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

function b_recette_top_show($options) {
    global $xoopsDB;
    $myts =& MyTextSanitizer::getInstance();
    $block = array();
    $options_new = array_slice ( $options, 3 );
    $topicpick = '('.implode ( ',', $options_new ).')';
    if ( $options[3] == 0 ) {
        $sql = "SELECT storyid, title, published, expired, counter FROM
		      ".$xoopsDB->prefix("recette")." WHERE published < ".time()."
		      AND published > 0 AND (expired = 0 OR expired > ".time().") ORDER BY
		      ".$options[0]." DESC";
    }
    else {
        $sql = "SELECT storyid, title, published, expired, counter FROM
			       ".$xoopsDB->prefix("recette")." WHERE published < ".time()."
			       AND published > 0 AND (expired = 0 OR expired > ".time().") AND topicid in
                   ".$topicpick." ORDER BY ".$options[0]." DESC";
    }	$result = $xoopsDB->query($sql,$options[1],0);
    while ( $myrow = $xoopsDB->fetchArray($result) ) {
        $news = array();
        $title = $myts->makeTboxData4Show($myrow["title"]);
		if (strlen($title) > $options[2]) {
			$title = xoops_substr($title,0,$options[2]+3);
		}

        $news['title'] = $title;
        $news['id'] = $myrow['storyid'];
        if ( $options[0] == "published" ) {
            $news['hits'] = formatTimestamp($myrow['published'],"s");
            $news['date'] = formatTimestamp($myrow['published'],"s");
        } elseif ( $options[0] == "counter" ) {
            $news['hits'] = $myrow['counter'];
            $news['date'] = $myrow['counter'];
        }
        $block['stories'][] = $news;
    }
    return $block;
}

function b_recette_top_edit($options) {
    global $xoopsDB;
    $form = ""._MB_recette_ORDER."&nbsp;<select name='options[]'>";
    $form .= "<option value='published'";
    if ( $options[0] == "published" ) {
        $form .= " selected='selected'";
    }
    $form .= ">"._MB_recette_DATE."</option>\n";
    $form .= "<option value='counter'";
    if($options[0] == "counter"){
        $form .= " selected='selected'";
    }
    $form .= ">"._MB_recette_HITS."</option>\n";
    $form .= "</select>\n";
    $form .= "&nbsp;"._MB_recette_DISP."&nbsp;<input type='text' name='options[]' value='".$options[1]."'/>&nbsp;"._MB_recette_ARTCLS."";
    $form .= "&nbsp;<br />"._MB_recette_CHARS."&nbsp;<input type='text' name='options[]' value='".$options[2]."'/>&nbsp;"._MB_recette_LENGTH."";
    $form .= "<br /><br /><br /><select id='options[]' name='options[]' multiple='multiple'>";
    include_once XOOPS_ROOT_PATH."/class/xoopsstory.php";
    $xt = new XoopsTopic($xoopsDB->prefix("recette_topics"));
    $alltopics = $xt->getTopicsList();
    $alltopics[0]['title'] = "All topics";
    ksort($alltopics);
    $size = count($options);
    foreach ($alltopics as $topicid => $topic) {
        $sel = "";
        for ( $i = 2; $i < $size; $i++ ) {
            if ($options[$i] == $topicid) {
                $sel = " selected='selected'";
            }
        }
        $form .= "<option value='$topicid'$sel>".$topic['title']."</option>";
    }
    $form .= "</select>";
    return $form;
}
?>