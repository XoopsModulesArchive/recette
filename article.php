<?php
// $Id: article.php,v 1.6 2004/04/25 15:26:56 hthouzard Exp $
//  ------------------------------------------------------------------------ //
//                XOOPS - PHP Content Management System                      //
//                    Copyright (c) 2000 XOOPS.org                           //
//                       <http://www.xoops.org/>                             //
//  ------------------------------------------------------------------------ //
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

include "../../mainfile.php";
include_once "class/class.newsstory.php";
include_once 'class/class.sfiles.php';
foreach ($_POST as $k => $v) {
    ${$k} = $v;
}

$storyid = (isset($_GET['storyid'])) ? intval($_GET['storyid']) : 0;
if (empty($storyid)) {
    redirect_header("index.php",2,_NW_NOSTORY);
    exit();
}

$myts =& MyTextSanitizer::getInstance();
// set comment mode if not set

$article = new NewsStory($storyid);
if ( $article->published() == 0 || $article->published() > time() ) {
    redirect_header('index.php', 2, _NW_NOSTORY);
    exit();
}
$gperm_handler =& xoops_gethandler('groupperm');
if (is_object($xoopsUser)) {
    $groups = $xoopsUser->getGroups();
} else {
	$groups = XOOPS_GROUP_ANONYMOUS;
}
if (!$gperm_handler->checkRight("recette_view", $article->topicid(), $groups, $xoopsModule->getVar('mid'))) {
	redirect_header('index.php', 3, _NOPERM);
	exit();
}

$storypage = isset($_GET['page']) ? intval($_GET['page']) : 0;
// update counter only when viewing top page
if (empty($_GET['com_id']) && $storypage == 0) {
    $article->updateCounter();
}
$xoopsOption['template_main'] = 'recette_article.html';
include_once XOOPS_ROOT_PATH.'/header.php';
$story['id'] = $storyid;
$story['posttime'] = formatTimestamp($article->published());
$story['titlecategorie'] = $article->textlink();
$story['title'] = $article->title();
$story['text'] = $article->bodytext();
$bodytext = '';

$ingredient = array();
$listing=$article->getIngredients();
for ($i=0 ; $i<count($listing) ; $i++)
{
	$ingredient[] = Array('id'=>$listing[$i]->getId(),'quant'=>$listing[$i]->getQuantite("Show"),'text'=>$listing[$i]->getIngredient("Show") );
}
$xoopsTpl->assign('ingredients',$ingredient);

$xoopsTpl->assign('categories',$article->loadIcone($storyid) );

if ( trim($bodytext) != '' ) {
    $articletext = explode("[pagebreak]", $bodytext);
    $story_pages = count($articletext);

    if ($story_pages > 1) {
        include_once XOOPS_ROOT_PATH.'/class/pagenav.php';
        $pagenav = new XoopsPageNav($story_pages, 1, $storypage, 'page', 'storyid='.$storyid);
        $xoopsTpl->assign('pagenav', $pagenav->renderNav());
        //$xoopsTpl->assign('pagenav', $pagenav->renderImageNav());

        if ($storypage == 0) {
            $story['text'] = $story['text'].'<br /><br />'.$articletext[$storypage];
        } else {
            $story['text'] = $articletext[$storypage];
        }
    } else {
		//Do nothing Now !
        //$story['text'] = $story['text'].'<br /><br />'.$bodytext;
    }
}

// manage news fields
$urlimg ='';
if ( $article->image()!='' )
{
	if ( strrpos($article->image(), '[img') )
	{
		$index1 = strpos($article->image(), ']');
		$urlimg = substr($article->image(),$index1+1,strlen($article->image())-6-$index1-1);
	}
	else
	{
		$urlimg =  $article->image();
	}
	$urlimg='<img border="0" align="absmidle" src="'.$urlimg.'" />';
}
$story['image']=$urlimg;
$story['nbpers']=$article->nbpers();
$xoopsTpl->assign('nbpers',_NW_NBPERSO);
$story['tpsprep']=$article->tpspreparation();
$xoopsTpl->assign('tpsprep',_NW_TPSPREP);
$story['tpscuisson']=$article->tpscuisson();
$xoopsTpl->assign('tpscuis',_NW_TPSCUIS);
$story['tpsrepo']=$article->tpsrepos();
$xoopsTpl->assign('tpsrepo',_NW_TPSREPO);
$xoopsTpl->assign('cattitle',_NW_CATTITLE);


$story['poster'] = $article->uname();
if ( $story['poster'] ) {
    $story['posterid'] = $article->uid();
    $story['poster'] = '<a href="'.XOOPS_URL.'/userinfo.php?uid='.$story['posterid'].'">'.$story['poster'].'</a>';
} else {
    $story['poster'] = '';
    $story['posterid'] = 0;
    $story['poster'] = $xoopsConfig['anonymous'];
}
$story['morelink'] = '';
$story['adminlink'] = '';
unset($isadmin);
if (is_object($xoopsUser) && $xoopsUser->isAdmin($xoopsModule->getVar('mid')) ) {
    $isadmin = true;
    $story['adminlink'] = $article->adminlink();
}
$story['topicid'] = $article->topicid();
$story['imglink'] = '';
$story['align'] = '';
if ( $article->topicdisplay() ) {
    $story['imglink'] = $article->imglink();
    $story['align'] = $article->topicalign();
}
$story['hits'] = $article->counter();
$story['mail_link'] = 'mailto:?subject='.sprintf(_NW_INTARTICLE,$xoopsConfig['sitename']).'&amp;body='.sprintf(_NW_INTARTFOUND, $xoopsConfig['sitename']).':  '.XOOPS_URL.'/modules/recette/article.php?storyid='.$article->storyid();
$xoopsTpl->assign('story', $story);
$xoopsTpl->assign('lang_printerpage', _NW_PRINTERFRIENDLY);
$xoopsTpl->assign('lang_sendstory', _NW_SENDSTORY);
$xoopsTpl->assign('lang_on', _ON);
$xoopsTpl->assign('lang_postedby', _POSTEDBY);
$xoopsTpl->assign('lang_reads', _READS);
$xoopsTpl->assign('ingredienttitle', _NW_INGTITLE);
$xoopsTpl->assign('recettetitle', _NW_RECTITLE);
$xoopsTpl->assign('mail_link', 'mailto:?subject='.sprintf(_NW_INTARTICLE,$xoopsConfig['sitename']).'&amp;body='.sprintf(_NW_INTARTFOUND, $xoopsConfig['sitename']).':  '.XOOPS_URL.'/modules/recette/article.php?storyid='.$article->storyid());

$xoopsTpl->assign('lang_attached_files',_NW_ATTACHEDFILES);
$sfiles = new sFiles();
$filesarr=Array();
$newsfiles=Array();
$filesarr=$sfiles->getAllbyStory($storyid);
$filescount=count($filesarr);
$xoopsTpl->assign('attached_files_count',$filescount);
if($filescount>0) {
	foreach ($filesarr as $onefile) {
		$newsfiles[]=Array('file_id'=>$onefile->getFileid(), 'visitlink' => XOOPS_URL.'/modules/recette/visit.php?fileid='.$onefile->getFileid(),'file_realname'=>$onefile->getFileRealName(), 'file_attacheddate'=>formatTimestamp($onefile->getDate()), 'file_mimetype'=>$onefile->getMimetype(), 'file_downloadname'=>XOOPS_UPLOAD_URL.'/'.$onefile->getDownloadname());
	}
	$xoopsTpl->assign('attached_files',$newsfiles);
}
$xoopsTpl->assign('xoops_pagetitle', $myts->makeTboxData4Show($xoopsModule->name()) . ' - ' . $myts->makeTboxData4Show($article->topic_title()) . ' - ' . $myts->makeTboxData4Show($article->title()));
include XOOPS_ROOT_PATH.'/include/comment_view.php';

include XOOPS_ROOT_PATH.'/footer.php';
?>
