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

function b_last_recette_full_show($options) {
    global $xoopsDB,$xoopsConfig;
	include_once XOOPS_ROOT_PATH . "/modules/recette/class/class.newsstory.php";
	include_once XOOPS_ROOT_PATH . "/modules/recette/language/".$xoopsConfig['language']."/main.php";
	
    $myts =& MyTextSanitizer::getInstance();
    $block = array();
    $sql = "SELECT storyid, title, published, expired, counter FROM
		      ".$xoopsDB->prefix("recette")." WHERE published < ".time()."
		      AND published > 0 AND (expired = 0 OR expired > ".time().") ORDER BY
		      published DESC";
			  
	$result = $xoopsDB->query($sql,1);
	
    if ( $myrow = $xoopsDB->fetchArray($result) ) 
	{
		$storyid = $myrow["storyid"];
        $storyObj = new NewsStory($storyid);
		$story['id'] = $storyid;
		$story['posttime'] = formatTimestamp($storyObj->published());
		$story['titlecategorie'] = $storyObj->textlink();
		$story['title'] = $storyObj->title();
		$block['cattitle'] = _NW_CATTITLE;
		$story['text'] = $storyObj->bodytext();
		$story['image']=$urlimg;
		$story['nbpers']=$storyObj->nbpers();
		$block['nbpers'] = _NW_NBPERSO;
		$story['tpsprep']=$storyObj->tpspreparation();
		$block['tpsprep'] = _NW_TPSPREP;
		$story['tpscuisson']=$storyObj->tpscuisson();
		$block['tpscuis'] = _NW_TPSCUIS;
		$story['tpsrepo']=$storyObj->tpsrepos();
		$block['tpsrepo'] = _NW_TPSREPO;
		$bodytext = '';
		$ingredient = array();
		$listing=$storyObj->getIngredients();
		for ($i=0 ; $i<count($listing) ; $i++)
		{
			$ingredient[] = Array('id'=>$listing[$i]->getId(),'quant'=>$listing[$i]->getQuantite("Show"),'text'=>$listing[$i]->getIngredient("Show") );
		}
		$block['categories'] = $storyObj->loadIcone($storyid);
		// manage news fields
		$urlimg ='';
		if ( $storyObj->image()!='' )
		{
			if ( strrpos($storyObj->image(), '[img') )
			{
				$index1 = strpos($storyObj->image(), ']');
				$urlimg = substr($storyObj->image(),$index1+1,strlen($storyObj->image())-6-$index1-1);
			}
			else
			{
				$urlimg =  $storyObj->image();
			}
			$urlimg='<img border="0" align="absmidle" src="'.$urlimg.'" />';
		}
		$story['image']=$urlimg;		
		
		$block['ingredients'] = $ingredient;
		$story['poster'] = $storyObj->uname();
		if ( $story['poster'] ) {
		    $story['posterid'] = $storyObj->uid();
		    $story['poster'] = '<a href="'.XOOPS_URL.'/userinfo.php?uid='.$story['posterid'].'">'.$story['poster'].'</a>';
		} else {
		    $story['poster'] = '';
		    $story['posterid'] = 0;
		    $story['poster'] = $xoopsConfig['anonymous'];
		}
		$story['morelink'] = '';
		$story['adminlink'] = '';
		$story['topicid'] = $storyObj->topicid();
		$story['imglink'] = '';
		$story['align'] = '';
		if ( $storyObj->topicdisplay() ) {
		    $story['imglink'] = $storyObj->imglink();
		    $story['align'] = $storyObj->topicalign();
		}
		
		$story['hits'] = $storyObj->counter();
		$story['mail_link'] = 'mailto:?subject='.sprintf(_NW_INTARTICLE,$xoopsConfig['sitename']).'&amp;body='.sprintf(_NW_INTARTFOUND, $xoopsConfig['sitename']).':  '.XOOPS_URL.'/modules/recette/article.php?storyid='.$storyObj->storyid();
		
		$block['story'] = $story;
		$block['lang_printerpage'] = _NW_PRINTERFRIENDLY;
		$block['lang_sendstory'] = _NW_SENDSTORY;
		$block['lang_on'] = _ON;
		$block['lang_postedby'] =  _POSTEDBY;
		$block['lang_reads'] =  _READS;
		$block['ingredienttitle'] =  _NW_INGTITLE;
		$block['recettetitle'] =  _NW_RECTITLE;
		$block['mail_link'] = 'mailto:?subject='.sprintf(_NW_INTARTICLE,$xoopsConfig['sitename']).'&amp;body='.sprintf(_NW_INTARTFOUND, $xoopsConfig['sitename']).':  '.XOOPS_URL.'/modules/recette/article.php?storyid='.$storyObj->storyid();
	}
    return $block;
}
?>