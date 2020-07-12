<?php
// $Id: recette_moderate.php,v 1.4 2004/04/10 16:04:12 hthouzard Exp $
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

function b_recette_topics_moderate() {
	include_once XOOPS_ROOT_PATH."/class/xoopstopic.php";
	include_once XOOPS_ROOT_PATH . "/modules/recette/class/class.newsstory.php";
	$block = array();

    $storyarray = NewsStory :: getAllSubmitted();
    if ( count( $storyarray ) > 0 )
    {
		$block['lang_story_title'] = _MB_TITLE;
		$block['lang_story_date'] = _MB_POSTED;
		$block['lang_story_author'] =_MB_POSTER;
		$block['lang_story_action'] =_MB_ACTION;
		$block['lang_story_topic'] =_MB_TOPIC;

        foreach( $storyarray as $newstory )
        {
            $title = $newstory -> title();
            if ( !isset( $title ) || ( $title == "" ) ) {
                $linktitle = "<a href='" . XOOPS_URL . "/modules/recette/index.php?op=edit&amp;storyid=" . $newstory -> storyid() . "' target='_blank'>" . _AD_NOSUBJECT . "</a>";
            } else {
                $linktitle = "<a href='" . XOOPS_URL . "/modules/recette/submit.php?op=edit&amp;storyid=" . $newstory -> storyid() . "' target='_blank'>" . $title . "</a>";
            }
            $story=array();
            $story['title'] = $linktitle;
            $story['date'] = formatTimestamp( $newstory -> created());
            $story['author'] = "<a href='" . XOOPS_URL . "/userinfo.php?uid=" . $newstory -> uid() . "'>" . $newstory -> uname() . "</a>";
            $story['action'] = "<a href='" . XOOPS_URL . "/modules/recette/admin/index.php?op=delete&amp;storyid=" . $newstory -> storyid() . "'>" . _MB_DELETE . "</a>";
            $story['topic_title'] = $newstory -> topic_title();
            $block['stories'][] =& $story;
            unset($story);
        }
    }
	return $block;
}
?>