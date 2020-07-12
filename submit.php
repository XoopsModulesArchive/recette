<?php
// $Id: submit.php,v 1.12 2004/05/27 14:16:45 mithyt2 Exp $
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
include_once '../../mainfile.php';
include_once 'class/class.newsstory.php';
include_once 'class/class.sfiles.php';
include_once 'class/class.ingredient.php';
include_once XOOPS_ROOT_PATH.'/class/uploader.php';
include_once XOOPS_ROOT_PATH.'/header.php';

if (file_exists(XOOPS_ROOT_PATH.'/modules/'.$xoopsModule->getVar('dirname').'/language/'.$xoopsConfig['language'].'/admin.php')) {
    include_once 'language/'.$xoopsConfig['language'].'/admin.php';
} else {
    include_once 'language/english/admin.php';
}

$module_id = $xoopsModule->getVar('mid');

if (is_object($xoopsUser)) {
    $groups = $xoopsUser->getGroups();
} else {
	$groups = XOOPS_GROUP_ANONYMOUS;
}

$gperm_handler =& xoops_gethandler('groupperm');

if (isset($_POST['topic_id'])) {
    $perm_itemid = intval($_POST['topic_id']);
} else {
    $perm_itemid = 0;
}
//If no access
if (!$gperm_handler->checkRight("recette_submit", $perm_itemid, $groups, $module_id)) {
    redirect_header('index.php', 3, _NOPERM);
}
$op = 'form';
foreach ( $_POST as $k => $v ) {
	${$k} = $v;
}

//If approve privileges
$approveprivilege = 0;
if ($gperm_handler->checkRight("recette_approve", $perm_itemid, $groups, $module_id)) {
    $approveprivilege = 1;
}

if ( isset($_POST['preview'] )) {
	$op = 'preview';
} elseif ( isset($_POST['addIng']) ) {
	$op = 'preview';
	$nbingredient = $nbingredient+1;
}
elseif ( isset($_POST['post']) ) {
	$op = 'post';
}
elseif ( isset($_GET['op']) && isset($_GET['storyid'])) {
    if ($approveprivilege && $_GET['op'] == 'edit') {
        $op = 'edit';
        $storyid = $_GET['storyid'];
    }
    elseif ($approveprivilege && $_GET['op'] == 'delete') {
        $op = 'delete';
        $storyid = $_GET['storyid'];
    }
    else {
        redirect_header("index.php", 0, _NOPERM);
    }
}

switch ($op)
{
    case 'edit':
        if (!$approveprivilege) {
            redirect_header('index.php', 0, _NOPERM);
            break;
        }
        $story = new NewsStory($storyid);
        if (!$gperm_handler->checkRight("recette_view", $story->topicid(), $groups, $module_id)) {
            redirect_header('index.php', 0, _NOPERM);
            break;
        }

        echo"<table width='100%' border='0' cellspacing='1' class='outer'><tr><td class=\"odd\">";
        echo "<h4>" . _AM_EDITARTICLE . "</h4>";

        $title = $story->title("Edit");
		$Lingredients = $story->getIngredients();
		$nbingredient = count($Lingredients)+1;
		$quantite = array();
		$ingredient = array();
		for($ii=0;$ii<count($Lingredients);$ii++ )
		{
		    $quantite[]  = $Lingredients[$ii]->getQuantite("Edit");
			$ingredient[] = $Lingredients[$ii]->getIngredient("Edit");
		}





        $hometext = $story->hometext("Edit");
        $bodytext = $story->bodytext("Edit");
		$image = $story->image("Edit");
		$nbpers = $story->nbpers("Edit");
		$tpspreparation = $story->tpspreparation("Edit");
		$tpscuisson = $story->tpscuisson("Edit");
		$tpsrepos = $story->tpsrepos("Edit");
		
        $nohtml = $story ->nohtml();
        $nosmiley = $story->nosmiley();
        $ihome = $story->ihome();
        $notifypub = 0;
        $topicid = $story->topicid();
        $approve = 0;
        $published = $story->published();
        if (isset($published) && $published > 0) {
            $approve = 1;
        }
        if ($story -> published() != 0) {
            $published = $story -> published();
        }
		if ( $story -> expired() != 0) {
            $expired = $story -> expired();
        } else {
            $expired = 0;
        }
		$type = $story -> type();
        $topicdisplay = $story -> topicdisplay();
        $topicalign = $story -> topicalign( false );
        include_once XOOPS_ROOT_PATH."/modules/recette/include/storyform.inc.php";
        echo"</td></tr></table>";
        break;

	case 'preview':
		$xt = new XoopsTopic($xoopsDB->prefix("recette_topics"), intval($_POST['topic_id']));
		if ( isset( $storyid ) ) {
	    	$story = new NewsStory( $storyid );
	    	$published = $story -> published();
	    	$expired = $story -> expired();
		}
		else {
		    $story = new NewsStory();
	    	$published = 0;
	    	$expired = 0;
		}
		$topicid = $topic_id;
		$story->setTitle($title);
		$story->setHometext('');
		$story->setNbIngredient($nbingredient+1);
		$story->emptyIngredients();
		$story->setImage($image);
		$story->setNbpers($nbpers);
		$story->setTpspreparation($tpspreparation);
		$story->setTpscuisson($tpscuisson);
		$story->setTpsrepos($tpsrepos);	
					
		$quantite=array();
		$ingredient=array();

		for ( $ii=1; $ii<=$nbingredient ; $ii++ )
		{		
			$myts =& MyTextSanitizer::getInstance();
			
			$qt = ${'qt'.$ii};
			$ige = ${'ing'.$ii};			
			
			$qt =$myts->censorString($qt);			
			$ige =$myts->censorString($ige);					
			$qt = $myts->makeTboxData4PreviewInForm($qt);
			$ige = $myts->makeTboxData4PreviewInForm($ige);
			
			$inge = new Ingredient($qt,$ige);
			$story->addIngredient($inge);
			$quantite[]=$qt;
			$ingredient[]=$ige;
		}		
		if ($approveprivilege) {
		    $story->setTopicdisplay($topicdisplay);
	    	$story->setTopicalign($topicalign);
		} else {
	    	$noname = isset($noname) ? intval($noname) : 0;
		}
		$story->setBodytext($bodytext);
		$notifypub = isset($notifypub) ? intval($notifypub) : 0;

		if ( isset( $nosmiley ) && ( $nosmiley == 0 || $nosmiley == 1 ) ) {
		    $story -> setNosmiley( $nosmiley );
		} else {
	    	$nosmiley = 0;
		}
		if ($approveprivilege) {
		    $nohtml = isset($nohtml) ? intval($nohtml) : 0;
			$story->setNohtml($nohtml);
			if (!isset($approve)) {
			    $approve = 0;
			}
		} else {
			$story->setNohtml = 1;
		}

		$title = $story->title("InForm");
	  	$hometext = $story->hometext("InForm");
		$image = $story->image("InForm");
		$nbpers = $story->nbpers("InForm");
		$tpspreparation = $story->tpspreparation("InForm");
		$tpscuisson = $story->tpscuisson("InForm");
		$tpsrepos = $story->tpsrepos("InForm");		
	  	if ($approveprivilege) {  	    	
  	    	$ihome = $story -> ihome();
  		}
		$bodytext = $story->bodytext("InForm");

		//Display post preview
		$p_title = $story->title("Preview");
		$p_hometext = $story->hometext("Preview");
		if ($approveprivilege) {		    
	    	$p_hometext .= $p_bodytext;
		}
		$p_bodytext = $story->bodytext("Preview");
		$topicalign = isset($story->topicalign) ? 'align="'.$story->topicalign().'"' : "";
		$p_hometext = (($xt->topic_imgurl() != '') && $topicdisplay) ? '<img src="images/topics/'.$xt->topic_imgurl().'" '.$topicalign.' alt="" />'.$p_hometext : $p_hometext;
		themecenterposts($p_title, $p_hometext);

		//Display post edit form
		include_once 'include/storyform.inc.php';
		break;

	case 'post':
		$nohtml_db = 1;
		if ( is_object($xoopsUser) ) {
			$uid = $xoopsUser->getVar('uid');
			if ( $approveprivilege ) {
			    $nohtml_db = empty($nohtml) ? 0 : 1;
			}
		} else {
	    	$uid = 0;
		}
		if ( empty( $storyid ) ) {
		    $story = new NewsStory();
	    	$story -> setUid( $uid );
		} else {
	    	$story = new NewsStory( $storyid );
		}
		$story->setTitle($title);
		$story->setHometext('');
		$story->setImage($image);
		$story->setNbpers($nbpers);
		$story->setTpspreparation($tpspreparation);
		$story->setTpscuisson($tpscuisson);
		$story->setTpsrepos($tpsrepos);					
		$story->setUid($uid);
		$story->setTopicId($topic_id);
		$story->setHostname(xoops_getenv('REMOTE_ADDR'));
		$story->setNohtml($nohtml_db);
		$nosmiley = isset($nosmiley) ? intval($nosmiley) : 0;
		$notifypub = isset($notifypub) ? intval($notifypub) : 0;
		$story->setNosmiley($nosmiley);
		$story->setNotifyPub($notifypub);
		$story->setType($type);
			
		$story->setNbIngredient($nbingredient);
		$story->emptyIngredients();
		$quantite=array();
		$ingredient=array();

		for ( $ii=1; $ii<=$nbingredient ; $ii++ )
		{					
			$myts =& MyTextSanitizer::getInstance();
			
			$qt = ${'qt'.$ii};
			$ige = ${'ing'.$ii};			
			
			$qt =$myts->censorString($qt);			
			$ige =$myts->censorString($ige);					
			$qt = $myts->makeTboxData4Save($qt);
			$ige = $myts->makeTboxData4Save($ige);			

			if( $qt=='' )
			{
				$qt=' ';
			}
			
			if ( $ige!='' )
			{
				$inge = new Ingredient($qt,$ige);
				$story->addIngredient($inge);
				$quantite[]=$qt;
				$ingredient[]=$ige;
			}
		}		

		if ( !empty( $autodate ) && $approveprivilege) {
		    //TODO: Change to fit XoopsFormDateTime result
	    	$pubdate = strtotime($publish_date['date']) + $publish_date['time'];
	    	$offset = $xoopsUser -> timezone() - $xoopsConfig['server_TZ'];
	    	$pubdate = $pubdate - ( $offset * 3600 );
	    	$story -> setPublished( $pubdate );
		}
		if ( !empty( $autoexpdate ) && $approveprivilege) {
		    $expiry_date = strtotime($expiry_date['date']) + $expiry_date['time'];
	    	$offset = $xoopsUser -> timezone() - $xoopsConfig['server_TZ'];
	    	$expiry_date = $expiry_date - ( $offset * 3600 );
	    	$story -> setExpired( $expiry_date );
		} else {
	    	$story -> setExpired( 0 );
		}
		if ($bodytext) {
		        $story->setBodytext($bodytext);
	    } else {
		        $story->setBodytext(' ');
	    }		
		if ($approveprivilege) {
		    $story->setTopicdisplay($topicdisplay);	// Display Topic Image ? (Yes or No)
	    	$story->setTopicalign($topicalign);		// Topic Align, 'Right' or 'Left'
   			$story->setIhome($ihome);				// Publish in home ? (Yes or No)	    	
	    	$approve = isset($approve) ? intval($approve) : 0;

	    	if (!$story->published() && $approve) {
		        $story->setPublished(time());
	    	}
	    	if (!$story->expired()) {
		        $story->setExpired(0);
	    	}

	    	if(!$approve) {
		    	$story->setPublished(0);
	    	}
		}
    	elseif ( $xoopsModuleConfig['autoapprove'] == 1 && !$approveprivilege) {
    		if (empty($storyid)) {
				$approve = 1;
			} else {
				$approve = isset($approve) ? intval($approve) : 0;
			}
			if($approve) {
	    		$story->setPublished(time());
    		} else {
				$story->setPublished(0);
			}
    		$story->setExpired(0);
			$story->setTopicalign('R');
		} else {
	    	$approve = 0;
		}
		$story->setApproved($approve);
		
		// lire les attributs
		if ( $ing1 != '' )
		{
			$ingredient  = new Ingredient($qt1,$ing1);
		}

		$result = $story->store();
		if ($result) {
			// Notification
			$notification_handler =& xoops_gethandler('notification');
			$tags = array();
			$tags['STORY_NAME'] = $title;
			$tags['STORY_URL'] = XOOPS_URL . '/modules/' . $xoopsModule->getVar('dirname') . '/article.php?storyid=' . $story->storyid();
			if ( $approve == 1) {
				$notification_handler->triggerEvent('global', 0, 'new_story', $tags);
			} else {
				$tags['WAITINGSTORIES_URL'] = XOOPS_URL . '/modules/' . $xoopsModule->getVar('dirname') . '/admin/index.php?op=newarticle';
				$notification_handler->triggerEvent('global', 0, 'story_submit', $tags);
			}
			// If notify checkbox is set, add subscription for approve
			if ($notifypub) {
				include_once XOOPS_ROOT_PATH . '/include/notification_constants.php';
				$notification_handler->subscribe('story', $story->storyid(), 'approve', XOOPS_NOTIFICATION_MODE_SENDONCETHENDELETE);
			}

			$allowupload = false;
			switch ($xoopsModuleConfig['uploadgroups'])
			{
				case 1: //Submitters and Approvers
					$allowupload = true;
					break;
				case 2: //Approvers only
					$allowupload = $approveprivilege ? true : false;
					break;
				case 3: //Upload Disabled
					$allowupload = false;
					break;
			}

			if($allowupload)
			{
				// Manage upload(s)
				if(isset($_POST['delupload']) && count($_POST['delupload'])>0) {
					foreach ($_POST['delupload'] as $onefile) {
						$sfiles = new sFiles($onefile);
						$sfiles->delete();
					}
				}

				if(isset($_POST['xoops_upload_file'])) {
					$fldname = $HTTP_POST_FILES[$_POST['xoops_upload_file'][0]];
					$fldname = (get_magic_quotes_gpc()) ? stripslashes($fldname['name']) : $fldname['name'];
					if(trim($fldname!='')) {
						$sfiles = new sFiles();
						$destname=$sfiles->createUploadName(XOOPS_UPLOAD_PATH,$fldname);
						// Actually : Web pictures (png, gif, jpeg), zip, pdf, gtar, tar
						$permittedtypes=array('image/gif', 'image/jpeg', 'image/pjpeg', 'image/x-png', 'image/png' ,'application/x-zip-compressed', 'application/pdf', 'application/x-gtar', 'application/x-tar');
						$uploader = new XoopsMediaUploader( XOOPS_UPLOAD_PATH, $permittedtypes, $xoopsModuleConfig['maxuploadsize']);
						$uploader->setTargetFileName($destname);
						if ($uploader->fetchMedia($_POST['xoops_upload_file'][0])) {
							if ($uploader->upload()) {
								$sfiles->setFileRealName($uploader->getMediaName());
								$sfiles->setStoryid($story->storyid());
								$sfiles->setMimetype($sfiles->giveMimetype(XOOPS_UPLOAD_PATH.'/'.$uploader->getMediaName()));
								$sfiles->setDownloadname($destname);
								if(!$sfiles->store()) {
									echo _AM_UPLOAD_DBERROR_SAVE;
								}
							} else {
								echo _AM_UPLOAD_ERROR;
							}
						} else {
							echo $uploader->getErrors();
						}
					}
				}
			}
		} else {
			echo _ERRORS;
		}
		redirect_header("index.php",2,_NW_THANKS);
		break;

	case 'form':
	default:
		$xt = new XoopsTopic($xoopsDB->prefix("recette_topics"));
		$title = '';
		$nbingredient=10;
		$quantite=array();
		$ingredient=array();
		$hometext = '';
		$noname = 0;
		$nohtml = 0;
		$nosmiley = 0;
		$notifypub = 1;
		$topicid = 0;
		if ($approveprivilege) {
		    $topicdisplay = 0;
	    	$topicalign = 'R';
	    	$ihome = 0;
	    	$bodytext = '';
	    	$approve = 0;
	    	$autodate = '';
	    	$expired = 0;
	    	$published = 0;
		}
		if($xoopsModuleConfig['autoapprove'] == 1) {
			$approve=1;
		}
		include_once 'include/storyform.inc.php';
		break;
}
include XOOPS_ROOT_PATH.'/footer.php';
?>
