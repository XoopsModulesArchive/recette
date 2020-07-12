<?php
// $Id: class.newsstory.php,v 1.17 2004/05/25 10:53:08 mithyt2 Exp $
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
// ------------------------------------------------------------------------- //

include_once XOOPS_ROOT_PATH."/class/xoopsstory.php";
include_once XOOPS_ROOT_PATH.'/include/comment_constants.php';
include_once XOOPS_ROOT_PATH.'/modules/recette/class/class.ingredient.php';

class NewsStory extends XoopsStory
{
	var $newstopic;   // XoopsTopic object
	var $ingredients;
	var $nbingredient;
	var $image;
	var $nbpers;
	var $tpspreparation;
	var $tpscuisson;
	var $tpsrepos;

	function NewsStory($storyid=-1)
	{
		$this->ingredients = array();
		$this->nbingredient = 1;
		$this->db =& Database::getInstance();
		$this->table = $this->db->prefix("recette");
		$this->topicstable = $this->db->prefix("recette_topics");
		if (is_array($storyid)) {
			$this->makeStory($storyid);
			$this->newstopic = $this->topic();
		} elseif($storyid != -1) {
			$this->getStory(intval($storyid));
			$this->newstopic = $this->topic();
			$this->loadIngredients($storyid);
		}
	}
	
	function setNbIngredient($p)
	{
		$nbingredient = $p;
	}
	
	function getNbIngredient()
	{
		return $nbingredient;
	}
	
	function loadIngredients($storyid)
	{
		$sql = "SELECT A.quantite as A, B.name as B, B.id as indg FROM ".$this->db->prefix('recette_lnk_ingredient_recette  ')." A, ".$this->db->prefix('recette_ingredient')." B WHERE A.recette=".$storyid." AND A.ingredient=B.id";
		$result = $this->db->query($sql);
       	while( $myrow = $this->db->fetchArray($result)) 
		{
			$ing = new Ingredient('','');
			$ing->setQuantite( $myrow['A'] );
			$ing->setIngredient( $myrow['B'] );		
			$ing->setId	( $myrow['indg'] );
			$index = count($this->ingredients);
			$this->ingredients[$index] = $ing;
        }	
	}
	
	function loadIcone($storyid)
	{
		$sql = "SELECT B.image as img,B.description as descr, B.categorie as cat FROM ".$this->db->prefix('recette_lnk_cat')." A, ".$this->db->prefix('recette_cat')." B WHERE A.recette=".$storyid." AND A.categorie=B.id order by A.categorie";
		$result = $this->db->query($sql);
       	while( $myrow = $this->db->fetchArray($result)) 
		{
			$liste[] = Array('img'=>$myrow['img'],'descr'=>$myrow['descr'],'cat'=>$myrow['cat']);
        }	
		return $liste;
	}
	
	function emptyIngredients()
	{
		$this->ingredients = array();
	}
	
	function getIngredients()
	{
		return $this->ingredients;
	}	
	
	function addIngredient( $ing )
	{
		$index = count($this->ingredients);
		$this->ingredients[$index] = $ing;
	}

	function getAllPublished($limit=0, $start=0, $checkRight = false, $topic=0, $ihome=0, $asobject=true)
	{
		$db =& Database::getInstance();
		$myts =& MyTextSanitizer::getInstance();
		$ret = array();
		$sql = "SELECT * FROM ".$db->prefix("recette")." WHERE published > 0 AND published <= ".time()." AND (expired = 0 OR expired > ".time().")";
		if ( !empty($topic) ) {
			$sql .= " AND topicid=".intval($topic)." AND (ihome=1 OR ihome=0)";
		} else {
		    if ($checkRight) {
		        global $xoopsUser;
		        $module_handler =& xoops_gethandler('module');
		        $newsModule =& $module_handler->getByDirname('news');
		        $groups = is_object($xoopsUser) ? $xoopsUser->getGroups() : XOOPS_GROUP_ANONYMOUS;
		        $gperm_handler =& xoops_gethandler('groupperm');
		        $topics = $gperm_handler->getItemIds('recette_view', $groups, $newsModule->getVar('mid'));
		        $topics = implode(',', $topics);
		        $sql .= " AND topicid IN (".$topics.")";
		    }
			if (intval($ihome)==0) {
				$sql .= " AND ihome=0";
			}
		}
 		$sql .= " ORDER BY published DESC";
		$result = $db->query($sql,intval($limit),intval($start));
		while ($myrow = $db->fetchArray($result)) {
			if ( $asobject ) {
				$ret[] = new NewsStory($myrow);
			} else {
				$ret[$myrow['storyid']] = $myts->makeTboxData4Show($myrow['title']);
			}
		}
		return $ret;
	}
	
	
	function getAllByIng($ingind,$limit=0, $start=0, $checkRight = false, $topic=0, $ihome=0, $asobject=true)
	{
		$db =& Database::getInstance();
		$myts =& MyTextSanitizer::getInstance();
		$ret = array();
		$sql = "SELECT * FROM ".$db->prefix("recette").", ".$db->prefix("recette_lnk_ingredient_recette")." WHERE published > 0 AND published <= ".time()." AND (expired = 0 OR expired > ".time().")";
			$sql .= " AND storyid = recette and ingredient=".$ingind." ";
		    if ($checkRight) {
		        global $xoopsUser;
		        $module_handler =& xoops_gethandler('module');
		        $newsModule =& $module_handler->getByDirname('news');
		        $groups = is_object($xoopsUser) ? $xoopsUser->getGroups() : XOOPS_GROUP_ANONYMOUS;
		        $gperm_handler =& xoops_gethandler('groupperm');
		        $topics = $gperm_handler->getItemIds('recette_view', $groups, $newsModule->getVar('mid'));
		        $topics = implode(',', $topics);
		        $sql .= " AND topicid IN (".$topics.")";
		    }
			if (intval($ihome)==0) {
				$sql .= " AND ihome=0";
			}

 		$sql .= " group by recette ORDER BY published DESC";
		$result = $db->query($sql,intval($limit),intval($start));
		while ($myrow = $db->fetchArray($result)) {
			if ( $asobject ) {
				$ret[] = new NewsStory($myrow);
			} else {
				$ret[$myrow['storyid']] = $myts->makeTboxData4Show($myrow['title']);
			}
		}
		return $ret;
	}
	
	

	// added new function to get all expired stories
	function getAllExpired($limit=0, $start=0, $topic=0, $ihome=0, $asobject=true)
	{
		$db =& Database::getInstance();
		$myts =& MyTextSanitizer::getInstance();
		$ret = array();
		$sql = "SELECT * FROM ".$db->prefix("recette")." WHERE expired <= ".time()." AND expired > 0";
		if ( !empty($topic) ) {
			$sql .= " AND topicid=".intval($topic)." AND (ihome=1 OR ihome=0)";
		} else {
			if ( intval($ihome) == 0 ) {
				$sql .= " AND ihome=0";
			}
		}
 		$sql .= " ORDER BY expired DESC";
		$result = $db->query($sql,intval($limit),intval($start));
		while ($myrow=$db->fetchArray($result)) {
			if ( $asobject ) {
				$ret[] = new NewsStory($myrow);
			} else {
				$ret[$myrow['storyid']] = $myts->makeTboxData4Show($myrow['title']);
			}
		}
		return $ret;
	}

	function getAllAutoStory($limit=0, $asobject=true)
	{
		$db =& Database::getInstance();
		$myts =& MyTextSanitizer::getInstance();
		$ret = array();
		$sql = "SELECT * FROM ".$db->prefix("recette")." WHERE published > ".time()." ORDER BY published ASC";
		$result = $db->query($sql,intval($limit),0);
		while ($myrow=$db->fetchArray($result)) {
			if ($asobject) {
				$ret[] = new NewsStory($myrow);
			} else {
				$ret[$myrow['storyid']] = $myts->makeTboxData4Show($myrow['title']);
			}
		}
		return $ret;
	}

	/*
	* Get all submitted stories awaiting approval
	*
	* @param int $limit Denotes where to start the query
	* @param boolean $asobject true will return the stories as an array of objects, false will return storyid => title
	* @param boolean $checkRight whether to check the user's rights to topics
	*/
	function getAllSubmitted($limit=0, $asobject=true, $checkRight = false)
	{
		$db =& Database::getInstance();
		$myts =& MyTextSanitizer::getInstance();
		$ret = array();
		$criteria = new CriteriaCompo(new Criteria('published', 0));
		if ($checkRight) {
		    global $xoopsUser;
		    if (!is_object($xoopsUser)) {
		        return $ret;
		    }
		    $groups = $xoopsUser->getGroups();
		    $gperm_handler =& xoops_gethandler('groupperm');
		    $module_handler =& xoops_gethandler('module');
		    $newsmodule =& $module_handler->getByDirname('news');
		    $allowedtopics = $gperm_handler->getItemIds('recette_approve', $groups, $newsmodule->getVar('mid'));
		    $criteria2 = new CriteriaCompo();
		    foreach ($allowedtopics as $key => $topicid) {
		        $criteria2->add(new Criteria('topicid', $topicid), 'OR');
		    }
		    $criteria->add($criteria2);
		}
		$sql = "SELECT * FROM ".$db->prefix("recette");
		$sql .= ' '.$criteria->renderWhere(). ' ORDER BY created DESC';
		$result = $db->query($sql,intval($limit),0);
		while ($myrow=$db->fetchArray($result)) {
			if ($asobject) {
				$ret[] = new NewsStory($myrow);
			} else {
				$ret[$myrow['storyid']] = $myts->makeTboxData4Show($myrow['title']);
			}
		}
		return $ret;
	}

	function getByTopic($topicid, $limit=0)
	{
		$ret = array();
		$db =& Database::getInstance();
		$sql = "SELECT * FROM ".$db->prefix("recette")." WHERE topicid=".intval($topicid)." AND published > 0 AND published <= ".time()." AND (expired=0 OR expired > ".time().") ORDER BY published DESC";
		$result = $db->query($sql, intval($limit), 0);
		while( $myrow = $db->fetchArray($result) ){
			$ret[] = new NewsStory($myrow);
		}
		return $ret;
	}

	function countByTopic($topicid=0)
	{
		$db =& Database::getInstance();
		$sql = "SELECT COUNT(*) FROM ".$db->prefix("recette")."WHERE expired >= ".time();
		if (intval($topicid) != 0 ) {
			$sql .= " AND  topicid=".intval($topicid);
		}
		$result = $db->query($sql);
		list($count) = $db->fetchRow($result);
		return $count;
	}

	function countPublishedByTopic($topicid=0, $checkRight = false)
	{
		$db =& Database::getInstance();
		$sql = "SELECT COUNT(*) FROM ".$db->prefix("recette")." WHERE published > 0 AND published <= ".time()." AND (expired = 0 OR expired > ".time().")";
		if ( !empty($topicid) ) {
			$sql .= " AND topicid=".intval($topicid);
		} else {
			$sql .= " AND ihome=0";
			if ($checkRight) {
		        global $xoopsUser, $xoopsModule;
		        $groups = is_object($xoopsUser) ? $xoopsUser->getGroups() : XOOPS_GROUP_ANONYMOUS;
		        $gperm_handler =& xoops_gethandler('groupperm');
		        $topics = $gperm_handler->getItemIds('recette_view', $groups, $xoopsModule->getVar('mid'));
		        $topics = implode(',', $topics);
		        $sql .= " AND topicid IN (".$topics.")";
		    }
		}
		$result = $db->query($sql);
		list($count) = $db->fetchRow($result);
		return $count;
	}


	function topic_title()
	{
		return $this->newstopic->topic_title();
	}

	function adminlink()
	{
		$ret = "&nbsp;[ <a href='".XOOPS_URL."/modules/recette/submit.php?op=edit&amp;storyid=".$this->storyid()."'>"._EDIT."</a> | <a href='".XOOPS_URL."/modules/recette/admin/index.php?op=delete&amp;storyid=".$this->storyid()."'>"._DELETE."</a> ]&nbsp;";
		return $ret;
	}

	function imglink()
	{
		$ret = '';
		if ($this->newstopic->topic_imgurl() != '' && file_exists(XOOPS_ROOT_PATH."/modules/recette/images/topics/".$this->newstopic->topic_imgurl())) {
			$ret = "<a href='".XOOPS_URL."/modules/recette/index.php?storytopic=".$this->topicid()."'><img src='".XOOPS_URL."/modules/recette/images/topics/".$this->newstopic->topic_imgurl()."' alt='".$this->newstopic->topic_title()."' width=21 height=21 align='absmiddle' /></a>";
		}
		return $ret;
	}

	function textlink()
	{
		$ret = "<a href='".XOOPS_URL."/modules/recette/index.php?storytopic=".$this->topicid()."'>".$this->newstopic->topic_title()."</a>";
		return $ret;
	}

	function prepare2show()
	{
	    global $xoopsUser, $xoopsConfig, $xoopsModule, $xoopsModuleConfig;
	    $story = array();
	    $story['id'] = $this->storyid();
	    $story['poster'] = $this->uname();
	    if ( $story['poster'] != false ) {
	        $story['poster'] = "<a href='".XOOPS_URL."/userinfo.php?uid=".$this->uid()."'>".$story['poster']."</a>";
	    }
	    else {
			if($xoopsModuleConfig['displayname']!=3) {
				$story['poster'] = $xoopsConfig['anonymous'];
			}
	    }
	    $story['posttimestamp'] = $this->published();
	    $story['posttime'] = formatTimestamp($story['posttimestamp']);
	    $story['text'] = '';
	    $introcount = strlen($story['text']);
	    $fullcount = strlen($this->bodytext());
	    $totalcount = $introcount + $fullcount;

	    $morelink = '';
	    if ( $fullcount > 1 ) {
	        $morelink .= '<a href="'.XOOPS_URL.'/modules/recette/article.php?storyid='.$this->storyid().'';
	        $morelink .= '">'._NW_READMORE.'</a> ';
	        //$morelink .= sprintf(_NW_BYTESMORE,$totalcount);
	        if (XOOPS_COMMENT_APPROVENONE != $xoopsModuleConfig['com_rule']) {
	            $morelink .= ' | ';
	        }
	    }
	    if (XOOPS_COMMENT_APPROVENONE != $xoopsModuleConfig['com_rule']) {
	        $ccount = $this->comments();
	        $morelink .= '<a href="'.XOOPS_URL.'/modules/recette/article.php?storyid='.$this->storyid().'';
	        $morelink2 = '<a href="'.XOOPS_URL.'/modules/recette/article.php?storyid='.$this->storyid().'';
	        if ( $ccount == 0 ) {
	            $morelink .= '">'._NW_COMMENTS.'</a>';
	        }
	        else {
	            if ( $fullcount < 1 ) {
	                if ( $ccount == 1 ) {
	                    $morelink .= '">'._NW_READMORE.'</a> | '.$morelink2.'">'._NW_ONECOMMENT.'</a>';
	                }
	                else {
	                    $morelink .= '">'._NW_READMORE.'</a> | '.$morelink2.'">';
	                    $morelink .= sprintf(_NW_NUMCOMMENTS, $ccount);
	                    $morelink .= '</a>';
	                }
	            }
	            else {
	                if ( $ccount == 1 ) {
	                    $morelink .= $morelink2.'">'._NW_ONECOMMENT.'</a>';
	                }
	                else {
	                    $morelink .= '">';
	                    $morelink .= sprintf(_NW_NUMCOMMENTS, $ccount);
	                    $morelink .= '</a>';
	                }
	            }
	        }
	    }
	    $story['morelink'] = $morelink;
	    $story['adminlink'] = '';

	    $approveprivilege = 0;
	    $gperm_handler =& xoops_gethandler('groupperm');
	    if (is_object($xoopsUser)) {
	        $groups = $xoopsUser->getGroups();
	    } else {
	        $groups = XOOPS_GROUP_ANONYMOUS;
	    }
	    if ($gperm_handler->checkRight("recette_approve", $this->topicid(), $groups, $xoopsModule->getVar('mid'))) {
	        $approveprivilege = 1;
	    }
	    if ($approveprivilege) {
	        $story['adminlink'] = $this->adminlink();
	    }
	    $story['mail_link'] = 'mailto:?subject='.sprintf(_NW_INTARTICLE,$xoopsConfig['sitename']).'&amp;body='.sprintf(_NW_INTARTFOUND, $xoopsConfig['sitename']).':  '.XOOPS_URL.'/modules/recette/article.php?storyid='.$this->storyid();
	    $story['imglink'] = '';
	    $story['align'] = '';
	    if ( $this->topicdisplay()) {
	        $story['imglink'] = $this->imglink();
	        $story['align'] = $this->topicalign();
	    }
	    $story['title'] = "<a href='".XOOPS_URL."/modules/recette/article.php?storyid=".$this->storyid()."'>".$this->title()."</a>";
	    $story['hits'] = $this->counter();
	    return $story;
	}

	function uname()
	{
		$module_handler =& xoops_gethandler('module');
		$module =& $module_handler->getByDirname("news");
		$config_handler =& xoops_gethandler('config');
		if ($module) {
		    $moduleConfig =& $config_handler->getConfigsByCat(0, $module->getVar('mid'));
		    $option= $moduleConfig['displayname'];
		} else {
		    $option= 1;
		}

		switch($option) {
			case 1:		// Username
				return XoopsUser::getUnameFromId($this->uid());
			case 2:		// Display full name (if it is not empty)
			     $thisuser = new XoopsUser($this->uid());
			     $return = $thisuser->getVar('name');
			     if ($return == "") {
			         $return = $thisuser->getVar('uname');
			     }
				 return $return;
			case 3:		// Nothing
				return '';
		}
	}


	function store($approved=false)
	{
		$myts =& MyTextSanitizer::getInstance();
		$title =$myts->censorString($this->title);
		$title = $myts->makeTboxData4Save($title);
		$hostname=$myts->makeTboxData4Save($this->hostname);
		$type=$myts->makeTboxData4Save($this->type);
		$hometext =$myts->censorString($this->hometext);
		$hometext = $myts->makeTareaData4Save($hometext);
		$bodytext =$myts->censorString($this->bodytext);
		$bodytext = $myts->makeTareaData4Save($bodytext);
		if ( !isset($this->nohtml) || $this->nohtml != 1 ) {
			$this->nohtml = 0;
		}
		if ( !isset($this->nosmiley) || $this->nosmiley != 1 ) {
			$this->nosmiley = 0;
		}
		if ( !isset($this->notifypub) || $this->notifypub != 1 ) {
			$this->notifypub = 0;
		}
		if( !isset($this->topicdisplay) || $this->topicdisplay != 0 ) {
			$this->topicdisplay = 1;
		}
		$expired = !empty($this->expired) ? $this->expired : 0;
		if ( !isset($this->storyid) ) {
			//$newpost = 1;
			$newstoryid = $this->db->genId($this->table."_storyid_seq");
			$created = time();
			$published = ( $this->approved ) ? intval($this->published) : 0;
			$published=intval($published);
			$sql = sprintf("INSERT INTO %s (storyid, uid, title, created, published, expired, hostname, nohtml, nosmiley, hometext, bodytext, counter, topicid, ihome, notifypub, story_type, topicdisplay, topicalign, comments, image, nbpers, tpspreparation , tpscuisson ,tpsrepos ) VALUES (%u, %u, '%s', %u, %u, %u, '%s', %u, %u, '%s', '%s', %u, %u, %u, %u, '%s', %u, '%s', %u, '%s', %u , '%s', '%s', '%s')", $this->table, $newstoryid, intval($this->uid()), $title, $created, $published, $expired, $hostname, intval($this->nohtml()), intval($this->nosmiley()), $hometext, $bodytext, 0, intval($this->topicid()), intval($this->ihome()), intval($this->notifypub()), $type, intval($this->topicdisplay()), $this->topicalign, intval($this->comments()),$this->image,$this->nbpers,$this->tpspreparation,$this->tpscuisson,$this->tpsrepos);
		} else {
			if ( $this->approved ) {
				$sql = sprintf("UPDATE %s SET title = '%s', published = %u, expired = %u, nohtml = %u, nosmiley = %u, hometext = '%s', bodytext = '%s', topicid = %u, ihome = %u, topicdisplay = %u, topicalign = '%s', comments = %u, image='%s' , nbpers=%u , tpspreparation='%s' , tpscuisson='%s' ,tpsrepos='%s' WHERE storyid = %u", $this->table, $title, intval($this->published()), $expired, intval($this->nohtml()), intval($this->nosmiley()), $hometext, $bodytext, intval($this->topicid()), intval($this->ihome()), intval($this->topicdisplay()), $this->topicalign, intval($this->comments()),$this->image,$this->nbpers,$this->tpspreparation,$this->tpscuisson,$this->tpsrepos, intval($this->storyid()));
			} else {
				$sql = sprintf("UPDATE %s SET title = '%s', published = %u, expired = %u, nohtml = %u, nosmiley = %u, hometext = '%s', bodytext = '%s', topicid = %u, ihome = %u, topicdisplay = %u, topicalign = '%s', comments = %u, image='%s' , nbpers=%u , tpspreparation='%s' , tpscuisson='%s' ,tpsrepos='%s' WHERE storyid = %u", $this->table, $title, intval($this->published()), $expired, intval($this->nohtml()), intval($this->nosmiley()), $hometext, $bodytext, intval($this->topicid()), intval($this->ihome()), intval($this->topicdisplay()), $this->topicalign, intval($this->comments()),$this->image,$this->nbpers,$this->tpspreparation,$this->tpscuisson,$this->tpsrepos, intval($this->storyid()));
			}
			$newstoryid = intval($this->storyid());
		}
		if (!$result = $this->db->query($sql)) {
			return false;
		}
		if ( empty($newstoryid) ) {
			$newstoryid = $this->db->getInsertId();
			$this->storyid = $newstoryid;
		}
		
		//Sauvegarde des ingrédients
		$sql = sprintf("DELETE FROM ".$this->db->prefix('recette_lnk_ingredient_recette')." where recette=%u", $newstoryid );
		if (!$result = $this->db->query($sql)) 
		{
				return false;
		}		
		
		for($i=0;$i<count($this->ingredients);$i++)
		{
				$this->ingredients[$i]->store($newstoryid);
		}

		
		return $newstoryid;
	}
	
	
	function image($format="X")
	{
		return $this->image;
	}
	
	function deleteLnk()
	{
		$sql = sprintf("DELETE FROM %s WHERE recette = %u", $this->db->prefix('recette_lnk_ingredient_recette'), $this->storyid);
		if( !$result = $this->db->query($sql) ) {
			return false;
		}
		$sql = sprintf("DELETE FROM %s WHERE recette = %u", $this->db->prefix('recette_lnk_cat'), $this->storyid);
		if( !$result = $this->db->query($sql) ) {
			return false;
		}		
		return true;
	}	
	
	function tpsrepos($format="Show")
	{
		$myts =& MyTextSanitizer::getInstance();
		switch ( $format ) {
		case "Show":
			$tpsrepos = $myts->makeTboxData4Show($this->tpsrepos,0);
			break;
		case "Edit":
			$tpsrepos = $myts->makeTboxData4Edit($this->tpsrepos);
			break;
		case "Preview":
			$tpsrepos = $myts->makeTboxData4Preview($this->tpsrepos,0);
			break;
		case "InForm":
			$tpsrepos = $myts->makeTboxData4PreviewInForm($this->tpsrepos);
			break;
		}
		return $tpsrepos;
	}			
	
	function tpscuisson($format="Show")
	{
		$myts =& MyTextSanitizer::getInstance();
		switch ( $format ) {
		case "Show":
			$tpscuisson = $myts->makeTboxData4Show($this->tpscuisson,0);
			break;
		case "Edit":
			$tpscuisson = $myts->makeTboxData4Edit($this->tpscuisson);
			break;
		case "Preview":
			$tpscuisson = $myts->makeTboxData4Preview($this->tpscuisson,0);
			break;
		case "InForm":
			$tpscuisson = $myts->makeTboxData4PreviewInForm($this->tpscuisson);
			break;
		}
		return $tpscuisson;
	}		
	
	function tpspreparation($format="Show")
	{
		$myts =& MyTextSanitizer::getInstance();
		switch ( $format ) {
		case "Show":
			$tpspreparation = $myts->makeTboxData4Show($this->tpspreparation,0);
			break;
		case "Edit":
			$tpspreparation = $myts->makeTboxData4Edit($this->tpspreparation);
			break;
		case "Preview":
			$tpspreparation = $myts->makeTboxData4Preview($this->tpspreparation,0);
			break;
		case "InForm":
			$tpspreparation = $myts->makeTboxData4PreviewInForm($this->tpspreparation);
			break;
		}
		return $tpspreparation;
	}	
	
	function nbpers($format="Show")
	{
		$myts =& MyTextSanitizer::getInstance();
		switch ( $format ) {
		case "Show":
			$nbpers = $myts->makeTboxData4Show($this->nbpers,0);
			break;
		case "Edit":
			$nbpers = $myts->makeTboxData4Edit($this->nbpers);
			break;
		case "Preview":
			$nbpers = $myts->makeTboxData4Preview($this->nbpers,0);
			break;
		case "InForm":
			$nbpers = $myts->makeTboxData4PreviewInForm($this->nbpers);
			break;
		}
		return $nbpers;
	}
	
	function setImage($p)
	{
		$this->image=$p;
	}
	function setNbpers($p)
	{
		$this->nbpers=$p;
	}
	function setTpspreparation($p)
	{
		$this->tpspreparation=$p;
	}
	function setTpscuisson($p)
	{
		$this->tpscuisson=$p;
	}
	function setTpsrepos($p)
	{
		$this->tpsrepos=$p;
	}
	
	
}
?>