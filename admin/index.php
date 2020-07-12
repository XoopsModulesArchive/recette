<?php
// $Id: index.php,v 1.12 2004/05/25 10:53:08 mithyt2 Exp $
// ------------------------------------------------------------------------ //
// XOOPS - PHP Content Management System                      //
// Copyright (c) 2000 XOOPS.org                           //
// <http://www.xoops.org/>                             //
// ------------------------------------------------------------------------ //
// This program is free software; you can redistribute it and/or modify     //
// it under the terms of the GNU General Public License as published by     //
// the Free Software Foundation; either version 2 of the License, or        //
// (at your option) any later version.                                      //
// //
// You may not change or alter any portion of this comment or credits       //
// of supporting developers from this source code or any supporting         //
// source code which is considered copyrighted (c) material of the          //
// original comment or credit authors.                                      //
// //
// This program is distributed in the hope that it will be useful,          //
// but WITHOUT ANY WARRANTY; without even the implied warranty of           //
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            //
// GNU General Public License for more details.                             //
// //
// You should have received a copy of the GNU General Public License        //
// along with this program; if not, write to the Free Software              //
// Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA //
// ------------------------------------------------------------------------ //
include_once '../../../include/cp_header.php';
include_once XOOPS_ROOT_PATH . "/class/xoopstopic.php";
include_once XOOPS_ROOT_PATH . "/class/xoopslists.php";
include_once XOOPS_ROOT_PATH . "/modules/recette/class/class.newsstory.php";
include_once XOOPS_ROOT_PATH . "/modules/recette/class/class.sfiles.php";
include_once XOOPS_ROOT_PATH . "/modules/recette/class/class.ingredient.php";
include_once XOOPS_ROOT_PATH . "/modules/recette/class/class.categorie.php";
include_once XOOPS_ROOT_PATH . '/class/uploader.php';
include_once XOOPS_ROOT_PATH . "/modules/recette/admin/functions.php";
$op = 'default';
if ( isset( $_POST ) )
{
    foreach ( $_POST as $k => $v )
    {
        ${$k} = $v;
    }
}

if ( isset( $_GET['op'] ) )
{
    $op = $_GET['op'];
    if ( isset( $_GET['storyid'] ) )
    {
        $storyid = intval( $_GET['storyid'] );
    }
}


/*
 * Show new submissions
 */
function newSubmissions()
{
    $storyarray = NewsStory :: getAllSubmitted();
    if ( count( $storyarray ) > 0 )
    {
        echo"<table width='100%' border='0' cellspacing='1'><tr><td class=\"odd\">";
        echo "<div style='text-align: center;'><b>" . _AM_NEWSUB . "</b><br /><table width='100%' border='1' class='outer'><tr class='bg3'><td align='center'>" . _AM_TITLE . "</td><td align='center'>" . _AM_POSTED . "</td><td align='center'>" . _AM_POSTER . "</td><td align='center'>" . _AM_ACTION . "</td></tr>\n";
        foreach( $storyarray as $newstory )
        {
            echo "<tr><td align='left'>\n";
            $title = $newstory->title();
            if ( !isset( $title ) || ( $title == "" ) )
            {
                echo "<a href='index.php?op=edit&amp;storyid=" . $newstory -> storyid() . "'>" . _AD_NOSUBJECT . "</a>\n";
            }
            else
            {
                echo "&nbsp;<a href='../submit.php?op=edit&amp;storyid=" . $newstory -> storyid() . "'>" . $title . "</a>\n";
            }
            echo "</td><td align='center' class='nw'>" . formatTimestamp( $newstory -> created() ) . "</td><td align='center'><a href='" . XOOPS_URL . "/userinfo.php?uid=" . $newstory -> uid() . "'>" . $newstory -> uname() . "</a></td><td align='right'><a href='index.php?op=delete&amp;storyid=" . $newstory -> storyid() . "'>" . _AM_DELETE . "</a></td></tr>\n";
        }
        echo "</table></div>\n";
        echo"</td></tr></table>";
        echo "<br />";
    }
}

/*
 * Shows automated stories
 */
function autoStories()
{
    global $xoopsModule;
    $storyarray = NewsStory :: getAllAutoStory();
    if ( count( $storyarray ) > 0 )
    {
        echo"<table width='100%' border='0' cellspacing='1' class='outer'><tr><td class=\"odd\">";
        echo "<div style='text-align: center;'><b>" . _AM_AUTOARTICLES . "</b><br />\n";
        echo "<table border='1' width='100%'><tr class='bg2'><td align='center'>" . _AM_STORYID . "</td><td align='center'>" . _AM_TITLE . "</td><td align='center'>" . _AM_TOPIC . "</td><td align='center'>" . _AM_POSTER . "</td><td align='center' class='nw'>" . _AM_PROGRAMMED . "</td><td align='center' class='nw'>" . _AM_EXPIRED . "</td><td align='center'>" . _AM_ACTION . "</td></tr>";
        foreach( $storyarray as $autostory )
        {
            $topic = $autostory -> topic();
            $expire = ( $autostory -> expired() > 0 ) ? formatTimestamp( $autostory -> expired() ) : '';
            echo "
        		<tr><td align='center'><b>" . $autostory -> storyid() . "</b>
        		</td><td align='left'><a href='" . XOOPS_URL . "/modules/" . $xoopsModule -> dirname() . "/article.php?storyid=" . $autostory -> storyid() . "'>" . $autostory -> title() . "</a>
        		</td><td align='center'>" . $topic -> topic_title() . "
        		</td><td align='center'><a href='" . XOOPS_URL . "/userinfo.php?uid=" . $autostory -> uid() . "'>" . $autostory -> uname() . "</a></td><td align='center' class='nw'>" . formatTimestamp( $autostory -> published() ) . "</td><td align='center'>" . $expire . "</td><td align='center'><a href='../submit.php?op=edit&amp;storyid=" . $autostory -> storyid() . "'>" . _AM_EDIT . "</a>-<a href='index.php?op=delete&amp;storyid=" . $autostory -> storyid() . "'>" . _AM_DELETE . "</a>";
            echo "</td></tr>\n";
        }
        echo "</table>";
        echo "</div>";
        echo"</td></tr></table>";
        echo "<br />";
    }
}

/*
 * Shows last 10 published stories
 */
function lastStories()
{
    global $xoopsModule, $xoopsModuleConfig;
    echo"<table width='100%' border='0' cellspacing='1' class='outer'><tr><td class=\"odd\">";
    echo "<div style='text-align: center;'><b>" . sprintf(_AM_LAST10ARTS,$xoopsModuleConfig['storycountadmin']) . "</b><br />";
    $storyarray = NewsStory :: getAllPublished($xoopsModuleConfig['storycountadmin'], 0, false, 0, 1 );
    echo "<table border='1' width='100%'><tr class='bg3'><td align='center'>" . _AM_STORYID . "</td><td align='center'>" . _AM_TITLE . "</td><td align='center'>" . _AM_TOPIC . "</td><td align='center'>" . _AM_POSTER . "</td><td align='center' class='nw'>" . _AM_PUBLISHED . "</td><td align='center' class='nw'>" . _AM_EXPIRED . "</td><td align='center'>" . _AM_ACTION . "</td></tr>";
    foreach( $storyarray as $eachstory )
    {
        $published = formatTimestamp( $eachstory -> published() );
        $expired = ( $eachstory -> expired() > 0 ) ? formatTimestamp( $eachstory -> expired() ) : '---';
        $topic = $eachstory -> topic();
        echo "
        	<tr><td align='center'><b>" . $eachstory -> storyid() . "</b>
        	</td><td align='left'><a href='" . XOOPS_URL . "/modules/" . $xoopsModule -> dirname() . "/article.php?storyid=" . $eachstory -> storyid() . "'>" . $eachstory -> title() . "</a>
        	</td><td align='center'>" . $topic -> topic_title() . "
        	</td><td align='center'><a href='" . XOOPS_URL . "/userinfo.php?uid=" . $eachstory -> uid() . "'>" . $eachstory -> uname() . "</a></td><td align='center' class='nw'>" . $published . "</td><td align='center'>" . $expired . "</td><td align='center'><a href='../submit.php?op=edit&amp;storyid=" . $eachstory -> storyid() . "'>" . _AM_EDIT . "</a>-<a href='index.php?op=delete&amp;storyid=" . $eachstory -> storyid() . "'>" . _AM_DELETE . "</a>";
        echo "</td></tr>\n";
    }
    echo "</table><br />";
    echo "<form action='index.php' method='post'>" . _AM_STORYID . " <input type='text' name='storyid' size='10' />
    	<select name='op'>
    	<option value='edit' selected='selected'>" . _AM_EDIT . "</option>
    	<option value='delete'>" . _AM_DELETE . "</option>
    	</select>
    	<input type='submit' value='" . _AM_GO . "' />
    	</form>
	</div>";
    echo"</td></tr></table>";
}
// Added function to display expired stories
function expStories()
{
    global $xoopsModule;
    echo"<table width='100%' border='0' cellspacing='1' class='outer'><tr><td class=\"odd\">";
    echo "<div style='text-align: center;'><b>" . _AM_EXPARTS . "</b><br />";
    $storyarray = NewsStory :: getAllExpired( 10, 0, 0, 1 );
    echo "<table border='1' width='100%'><tr class='bg3'><td align='center'>" . _AM_STORYID . "</td><td align='center'>" . _AM_TITLE . "</td><td align='center'>" . _AM_TOPIC . "</td><td align='center'>" . _AM_POSTER . "</td><td align='center' class='nw'>" . _AM_PUBLISHED . "</td><td align='center' class='nw'>" . _AM_EXPIRED . "</td><td align='center'>" . _AM_ACTION . "</td></tr>";
    foreach( $storyarray as $eachstory )
    {
        $published = formatTimestamp( $eachstory -> published() );
        $expired = formatTimestamp( $eachstory -> expired() );
        $topic = $eachstory -> topic();
        // added exired value field to table
        echo "
        	<tr><td align='center'><b>" . $eachstory -> storyid() . "</b>
        	</td><td align='left'><a href='" . XOOPS_URL . "/modules/" . $xoopsModule -> dirname() . "/article.php?storyid=" . $eachstory -> storyid() . "'>" . $eachstory -> title() . "</a>
        	</td><td align='center'>" . $topic -> topic_title() . "
        	</td><td align='center'><a href='" . XOOPS_URL . "/userinfo.php?uid=" . $eachstory -> uid() . "'>" . $eachstory -> uname() . "</a></td><td align='center' class='nw'>" . $published . "</td><td align='center' class='nw'>" . $expired . "</td><td align='center'><a href='../submit.php?op=edit&amp;storyid=" . $eachstory -> storyid() . "'>" . _AM_EDIT . "</a>-<a href='index.php?op=delete&amp;storyid=" . $eachstory -> storyid() . "'>" . _AM_DELETE . "</a>";
        echo "</td></tr>\n";
    }
    echo "</table><br />";
    echo "<form action='index.php' method='post'>
    	" . _AM_STORYID . " <input type='text' name='storyid' size='10' />
    	<select name='op'>
    	<option value='edit' selected='selected'>" . _AM_EDIT . "</option>
    	<option value='delete'>" . _AM_DELETE . "</option>
    	</select>
    	<input type='submit' value='" . _AM_GO . "' />
    	</form>
	</div>
    	";
    echo"</td></tr></table>";
}

function topicsmanager()
{
    global $xoopsDB, $xoopsModule, $xoopsModuleConfig;
    xoops_cp_header();
    adminmenu(0);
    $uploadfolder=sprintf(_AM_UPLOAD_WARNING,XOOPS_URL . "/modules/" . $xoopsModule -> dirname().'/images/topics');
    echo "<h4>" . _AM_CONFIG . "</h4>";
    $xt = new XoopsTopic( $xoopsDB -> prefix( "recette_topics" ) );
    $topics_array = XoopsLists :: getImgListAsArray( XOOPS_ROOT_PATH . "/modules/recette/images/topics/" );
    // $xoopsModule->printAdminMenu();
    // echo "<br />";
    // Add a New Main Topic
    echo"<table width='100%' border='0' cellspacing='1' class='outer'><tr><td class=\"odd\">";
    echo "<form method='post' action='index.php' enctype='multipart/form-data'>\n";
    echo "<h4>" . _AM_ADDMTOPIC . "</h4><br />";
    echo "<b>" . _AM_TOPICNAME . "</b> " . _AM_MAX40CHAR . "<br /><input type='text' name='topic_title' size='30' maxlength='40' /><br />";
    echo "<b>" . _AM_TOPICIMG . "</b> (" . sprintf( _AM_IMGNAEXLOC, "modules/" . $xoopsModule -> dirname() . "/images/topics/" ) . ")<br />" . _AM_FEXAMPLE . "<br />";
    echo "<select size='1' name='topic_imgurl'>";
    echo "<option value=' '>------</option>";
    foreach( $topics_array as $image )
    {
        echo "<option value='" . $image . "'>" . $image . "</option>";
    }
    echo "</select><br />";
    echo "<b>" . _AM_TOPIC_PICTURE . "</b> <input type='hidden' name='MAX_FILE_SIZE' value='".$xoopsModuleConfig['maxuploadsize']."' />";
    echo "<input type='file' name='attachedfile' id='attachedfile' /><input type='hidden' name='xoops_upload_file[]' id='xoops_upload_file[]' value='attachedfile' /><br /> $uploadfolder";
    echo "<br /><br />";
    echo "<input type='hidden' name='topic_pid' value='0' />\n";
    echo "<input type='hidden' name='op' value='addTopic' />";
    echo "<input type='submit' value='" . _AM_ADD . "' /><br /></form>";
    echo"</td></tr></table>";
    echo "<br />";
    // Add a New Sub-Topic
    $result = $xoopsDB -> query( "select count(*) from " . $xoopsDB -> prefix( "recette_topics" ) . "" );
    list( $numrows ) = $xoopsDB -> fetchRow( $result );
    if ( $numrows > 0 )
    {
        echo"<table width='100%' border='0' cellspacing='1' class='outer'><tr><td class=\"odd\">";
        echo "<form method='post' action='index.php' enctype='multipart/form-data'>";
        echo "<h4>" . _AM_ADDSUBTOPIC . "</h4><br />";
        echo "<b>" . _AM_TOPICNAME . "</b> " . _AM_MAX40CHAR . "<br /><input type='text' name='topic_title' size='30' maxlength='40' />&nbsp;" . _AM_IN . "&nbsp;";
        $xt -> makeTopicSelBox( 0, 0, "topic_pid" );
        echo "<br />";
        echo "<b>" . _AM_TOPICIMG . "</b> (" . sprintf( _AM_IMGNAEXLOC, "modules/" . $xoopsModule -> dirname() . "/images/topics/" ) . ")<br />" . _AM_FEXAMPLE . "<br />";
        echo "<select size='1' name='topic_imgurl'>";
        echo "<option value=' '>------</option>";
        foreach( $topics_array as $image )
        {
            echo "<option value='" . $image . "'>" . $image . "</option>";
        }
        echo "</select><br />";
	    echo "<b>" . _AM_TOPIC_PICTURE . "</b> <input type='hidden' name='MAX_FILE_SIZE' value='".$xoopsModuleConfig['maxuploadsize']."' />";
    	echo "<input type='file' name='attachedfile' id='attachedfile' /><input type='hidden' name='xoops_upload_file[]' id='xoops_upload_file[]' value='attachedfile' /><br /> $uploadfolder";
        echo "<br /><br />";
        echo "<input type='hidden' name='op' value='addTopic' />";
        echo "<input type='submit' value='" . _AM_ADD . "' /><br /></form>";
        echo"</td></tr></table>";
        echo "<br />";
        // Modify Topic
        echo"<table width='100%' border='0' cellspacing='1' class='outer'><tr><td class=\"odd\">";
        echo "
    		<form method='post' action='index.php'>
    		<h4>" . _AM_MODIFYTOPIC . "</h4><br />";
        echo "<b>" . _AM_TOPIC . "</b><br />";
        $xt -> makeTopicSelBox();
        echo "<br /><br />\n";
        echo "<input type='hidden' name='op' value='modTopic' />\n";
        echo "<input type='submit' value='" . _AM_MODIFY . "' />\n";
        echo "</form>";
        echo"</td></tr></table>";
    }
}

function fusionMod()
{
    global $xoopsDB;
    global $xoopsModule;
	$pb = true;
	$lut = (!empty($_POST['lut'])) ? htmlspecialchars($_POST['lut']) : "off";
	if ( $lut == "on" )
	{
		$fusionKeep = (!empty($_POST['fusionKeep'])) ? htmlspecialchars($_POST['fusionKeep']) : -1;
		$fusionChanged = (!empty($_POST['fusionChanged'])) ? htmlspecialchars($_POST['fusionChanged']) : -1;
		if ( $fusionKeep!=-1 && $fusionChanged!=-1 )
		{
			if ( Ingredient::changeThidIdByThisOne($fusionChanged,$fusionKeep) )
			{
				$pb = false;
			}
		}
	}
	
	if ( $pb )
	{
		redirect_header( "index.php?op=fusion", 2, _AM_FUSION_PB );
	}
	else
	{
		redirect_header( "index.php?op=fusion", 2, _AM_FUSION_OK );	
	}
}

function fusionShow()
{
    global $xoopsDB;
    global $xoopsModule;
    xoops_cp_header();
	adminmenu(5);	
	
	$list = Ingredient::getAllIngredients();
	
    echo "<h4>" . _AM_FUSION_TITLE . "</h4>";

    echo "<table width='100%' border='0' cellspacing='1' class='outer'><tr><td class=\"odd\">";
    echo "<h3>" . _AM_FUSION_SELECT . "</h3><br />";
    echo "<form action='index.php' method='post'>";
	echo _AM_FUSION_KEEP."<br />";
	echo "<input type='hidden' value='fusionTodo' name='op' />";
    echo "<select size='1' name='fusionKeep'>";
    foreach( $list as $ing )
    {
        echo "<option value='" . $ing['id'] . "' >" . $ing['name'] . "(" . $ing['nb'] . ")</option>";
    }
    echo "</select><br /><br />";
	echo _AM_FUSION_CHANGED."<br />";
    echo "<select size='1' name='fusionChanged'>";
    foreach( $list as $ing )
    {
        echo "<option value='" . $ing['id'] . "' >" . $ing['name'] . "(" . $ing['nb'] . ")</option>";
    }
    echo "</select><br /><br />";	
	echo "<input type='checkbox' name='lut'>&nbsp;";
	echo _AM_FUSION_ALERTE;
	echo "<br /><br /><input type='submit' value='"._AM_FUSION_SUBMIT."'>";
    echo "</form>";
    echo"</td></tr></table>";
}


function gestCat()
{
    global $xoopsDB;
    global $xoopsModule;
    xoops_cp_header();
	adminmenu(6);	
	
	$list = Categorie::getAllCategories();
	
    echo "<h4>" . _AM_ICON_TITLE . "</h4>";
	
	echo "<form action='index.php' method='post'>";
	echo "<input type='hidden' value='gestCatAdd' name='op' />";
    echo "<table width='100%' border='0' cellspacing='1' class='outer'><tr>";
	echo "<td class=\"odd\">"._AM_ICON_CAT."</td>";
	echo "<td class=\"odd\">"._AM_ICON_DESCR."</td>";
	echo "<td class=\"odd\">"._AM_ICON_IMG."</td><td class=\"odd\">&nbsp;</td></tr>";
    foreach( $list as $cat )
    {
        echo "<tr>";
		echo "<td class=\"even\">".$cat->categorie."</td>";
		echo "<td class=\"even\">".$cat->description."</td>";
		echo "<td class=\"even\"><img src='".XOOPS_URL . "/modules/recette/images/cats/".$cat->image."' /></td>";
		echo "<td class=\"even\"><input type='button' value='effacer' onclick='document.location=\"index.php?op=gestCatDel&id=".$cat->id."\"'></td></tr>";
    }
	$topics_array = XoopsLists :: getImgListAsArray( XOOPS_ROOT_PATH . "/modules/recette/images/cats/" );
	echo "<tr>";
	echo "<td class=\"even\"><input type='text' name='pcategorie' value='' /></td>";
	echo "<td class=\"even\"><input type='text' name='pdescription' value='' /></td>";
	echo "<td class=\"even\">";
	echo "<select size='1' name='pimage'>";
    foreach( $topics_array as $image )
    {
        echo "<option value='" . $image . "' >" . $image . "</option>";
    }
    echo "</select>";
	echo "<td class=\"even\"><input type='submit' value='ajouter'></td>";
	echo "</tr>";	
	
    echo"</table>";
}

function gestCatDel()
{
    global $xoopsDB;
    global $xoopsModule;
	
	$id = (!empty($_GET['id'])) ? htmlspecialchars($_GET['id']) : "err";

	if ( $id!="err" )
	{	
		if ( Categorie::delete($id) )
		{
			redirect_header( "index.php?op=gestCat", 2, _AM_DEL_OK );
			return true;
		}
	}
	redirect_header( "index.php?op=gestCat", 2, _AM_DEL_KO );
}

function gestCatAdd()
{
    global $xoopsDB;
    global $xoopsModule;
	
	$categorie = (!empty($_POST['pcategorie'])) ? htmlspecialchars($_POST['pcategorie']) : "err";
	$description = (!empty($_POST['pdescription'])) ? htmlspecialchars($_POST['pdescription']) : "err";
	$image = (!empty($_POST['pimage'])) ? htmlspecialchars($_POST['pimage']) : "err";
	if ( $categorie!="err" && $description!="err" && $image!="err" )
	{	
		$cat = new Categorie($categorie,$description,$image);		
		if ( $cat->store() )
		{
			redirect_header( "index.php?op=gestCat", 2, _AM_ADD_OK );
			return true;
		}
	}
	redirect_header( "index.php?op=gestCat", 2, _AM_ADD_KO );
}


function gestCatLnkUpdate()
{
    global $xoopsDB;
    global $xoopsModule;
	
	$storyarray = NewsStory :: getAllPublished();
	$listTypes = Categorie::getCategoriesTypes();
	// recup de toutes les types de cat et de tous les recettes
	// boucle sur recette
	foreach ( $storyarray as $story )
	{
		// boucle sur type
		if( !Categorie::clearForRecette($story->storyid()) )
		{
			redirect_header( "index.php?op=gestCatLnk", 2, _AM_GEST_LNKCAT_TXTREDERR );	
			return false;	
		}
		
		foreach ( $listTypes as $type )		
		{
			// vérifier exitence champs
			$champ = (!empty($_POST[$story->storyid()."_".$type])) ? htmlspecialchars($_POST[$story->storyid()."_".$type]) : "err";
			// mêttre a jour ce champ
			if ( $champ!="err" )
			{
				if ( $champ!="-" )
				{
					if ( !Categorie::updateLnk($story->storyid(),$champ) )
					{
						redirect_header( "index.php?op=gestCatLnk", 2, _AM_GEST_LNKCAT_TXTREDERR );	
						return false;				
					}
				}
				else
				{
					if ( !Categorie::clearForRecetteForType($story->storyid(),$type) )
					{
						redirect_header( "index.php?op=gestCatLnk", 2, _AM_GEST_LNKCAT_TXTREDERR );	
						return false;				
					}
					
				}
			}
		}
	}

	redirect_header( "index.php?op=gestCatLnk", 2, _AM_GEST_LNKCAT_TXTRED );	
	return true;					
}

function gestCatLnk()
{
    global $xoopsModule;
	xoops_cp_header();
	adminmenu(7);
    $storyarray = NewsStory :: getAllPublished();
    if ( count( $storyarray ) > 0 )
    {
	 	echo "<form action='index.php' method='post'>";
		echo "<input type='hidden' value='gestCatLnkUpdate' name='op' />";
        echo"<table width='100%' border='0' cellspacing='1' class='outer'><tr><td class=\"odd\">";
        echo "<div style='text-align: center;'><b>" . _AM_GEST_LNKCAT . "</b><br />\n";
        echo "<table border='1' width='100%'><tr class='bg2'><td align='center'>" . _AM_TITLE . "</td>";
		$listTypes = Categorie::getCategoriesTypes();
		$listCatByType;
		foreach( $listTypes as $nomType )
		{
			echo "<td>";
			echo $nomType;
			echo "</td>";
			$listCatByType[$nomType] = Categorie::getAllCategoriesForType($nomType);
		}
		echo "</tr>";
        foreach( $storyarray as $autostory )
        {
            $topic = $autostory -> topic();
            $expire = ( $autostory -> expired() > 0 ) ? formatTimestamp( $autostory -> expired() ) : '';
            echo "
        		</td><td align='left'><a href='" . XOOPS_URL . "/modules/" . $xoopsModule -> dirname() . 
				"/article.php?storyid=" . $autostory -> storyid() . "'>" . $autostory -> title() . "</a></td>";
            echo "</td>";
			$listCatOfRecipe = Categorie::getAllCategoriesForRecipe($autostory->storyid());
			foreach( $listTypes as $nomType )
			{
				echo "<td>";
				echo "<select name='".$autostory->storyid()."_".$nomType."' >";
				echo "<option value='-'>------</option>";							
				foreach( $listCatByType[$nomType] as $cat )
				{
					$selectedis = "";
					if ( in_array($cat->id, $listCatOfRecipe) )
					{
						$selectedis = " selected ";
					}
					echo "<option ".$selectedis." value='".$cat->id."'>".$cat->description."</option>";
				}
				echo "</select></td>";
			}
			echo "</tr>\n";
        }
        echo "</table>";
        echo "</div>";
        echo"</td></tr></table>";
        echo "<br /><center>";
		echo "<input type='submit' value='"._AM_GEST_LNKCAT_SUBMIT."'></center>";
		echo "</form>";
    }
}

function modTopic()
{
    global $xoopsDB;
    global $xoopsModule;
    $xt = new XoopsTopic( $xoopsDB -> prefix( "recette_topics" ), $_POST['topic_id'] );
    $topics_array = XoopsLists :: getImgListAsArray( XOOPS_ROOT_PATH . "/modules/recette/images/topics/" );
    xoops_cp_header();
    echo "<h4>" . _AM_CONFIG . "</h4>";
    // $xoopsModule->printAdminMenu();
    // echo "<br />";
    echo "<table width='100%' border='0' cellspacing='1' class='outer'><tr><td class=\"odd\">";
    echo "<h4>" . _AM_MODIFYTOPIC . "</h4><br />";
    if ( $xt -> topic_imgurl() )
    {
        echo "<div style='text-align: right;'><img src='" . XOOPS_URL . "/modules/" . $xoopsModule -> dirname() . "/images/topics/" . $xt -> topic_imgurl() . "'></div>";
    }
    echo "<form action='index.php' method='post'>";
    echo "<b>" . _AM_TOPICNAME . "</b>&nbsp;" . _AM_MAX40CHAR . "<br /><input type='text' name='topic_title' size='20' maxlength='40' value='" . $xt -> topic_title('E') . "' /><br />";
    echo "<b>" . _AM_TOPICIMG . "</b>&nbsp;(" . sprintf( _AM_IMGNAEXLOC, "modules/" . $xoopsModule -> dirname() . "/images/topics/" ) . ")<br />" . _AM_FEXAMPLE . "<br />";
    // echo "<input type='text' name='topic_imgurl' size='20' maxlength='20' value='".$xt->topic_imgurl()."' /><br />\n";
    echo "<select size='1' name='topic_imgurl'>";
    echo "<option value=' '>------</option>";
    foreach( $topics_array as $image )
    {
        if ( $image == $xt -> topic_imgurl() )
        {
            $opt_selected = "selected='selected'";
        }
        else
        {
            $opt_selected = "";
        }
        echo "<option value='" . $image . "' $opt_selected>" . $image . "</option>";
    }
    echo "</select><br />";
    echo "<b>" . _AM_PARENTTOPIC . "<b><br />\n";
    $xt -> makeTopicSelBox( 1, $xt -> topic_pid(), "topic_pid" );
    echo "\n<br /><br />";

    echo "<input type='hidden' name='topic_id' value='" . $xt -> topic_id() . "' />\n";
    echo "<input type='hidden' name='op' value='modTopicS' />";
    echo "<input type='submit' value='" . _AM_SAVECHANGE . "' />&nbsp;<input type='button' value='" . _AM_DEL . "' onclick='location=\"index.php?topic_pid=" . $xt -> topic_pid() . "&amp;topic_id=" . $xt -> topic_id() . "&amp;op=delTopic\"' />\n";
    echo "&nbsp;<input type='button' value='" . _AM_CANCEL . "' onclick='javascript:history.go(-1)' />\n";
    echo "</form>";
    echo"</td></tr></table>";
}
function modTopicS()
{
    global $xoopsDB;
    $xt = new XoopsTopic( $xoopsDB -> prefix( "recette_topics" ), $_POST['topic_id'] );
    if ( $_POST['topic_pid'] == $_POST['topic_id'] )
    {
        echo "ERROR: Cannot select this topic for parent topic!";
        exit();
    }
    $xt -> setTopicPid( $_POST['topic_pid'] );
    if ( empty( $_POST['topic_title'] ) )
    {
        redirect_header( "index.php?op=topicsmanager", 2, _AM_ERRORTOPICNAME );
    }
    $xt -> setTopicTitle( $_POST['topic_title'] );
    if ( isset( $_POST['topic_imgurl'] ) && $_POST['topic_imgurl'] != "" )
    {
        $xt -> setTopicImgurl( $_POST['topic_imgurl'] );
    }
    $xt -> store();
    redirect_header( 'index.php?op=topicsmanager', 1, _AM_DBUPDATED );
    exit();
}
function delTopic()
{
    global $xoopsDB, $xoopsModule;
    if ( $_POST['ok'] != 1 )
    {
        xoops_cp_header();
        echo "<h4>" . _AM_CONFIG . "</h4>";
        xoops_confirm( array( 'op' => 'delTopic', 'topic_id' => intval( $_GET['topic_id'] ), 'ok' => 1 ), 'index.php', _AM_WAYSYWTDTTAL );
    }
    else
    {
        $xt = new XoopsTopic( $xoopsDB -> prefix( "recette_topics" ), $_POST['topic_id'] );
        // get all subtopics under the specified topic
        $topic_arr = $xt -> getAllChildTopics();
        array_push( $topic_arr, $xt );
        foreach( $topic_arr as $eachtopic )
        {
            // get all stories in each topic
            $story_arr = NewsStory :: getByTopic( $eachtopic -> topic_id() );
            foreach( $story_arr as $eachstory )
            {
                if ( false != $eachstory -> delete() )
                {
                    xoops_comment_delete( $xoopsModule -> getVar( 'mid' ), $eachstory -> storyid() );
                    xoops_notification_deletebyitem( $xoopsModule -> getVar( 'mid' ), 'story', $eachstory -> storyid() );
                }
            }
            // all stories for each topic is deleted, now delete the topic data
            $eachtopic -> delete();
            xoops_notification_deletebyitem( $xoopsModule -> getVar( 'mid' ), 'category', $eachtopic -> topic_id );
        }
        redirect_header( 'index.php?op=topicsmanager', 1, _AM_DBUPDATED );
        exit();
    }
}

function addTopic()
{
    global $xoopsDB, $xoopsModule, $HTTP_POST_FILES, $xoopsModuleConfig;
    $topicpid = isset($_POST['topic_pid']) ? intval($_POST['topic_pid']) : 0;
    $xt = new XoopsTopic( $xoopsDB -> prefix( "recette_topics" ) );
    if ( !$xt -> topicExists( $topicpid, $_POST['topic_title'] ) )
    {
        $xt -> setTopicPid($topicpid);
        if ( empty( $_POST['topic_title']) || trim($_POST['topic_title'])=='' )
        {
            redirect_header( "index.php?op=topicsmanager", 2, _AM_ERRORTOPICNAME );
        }
        $xt -> setTopicTitle( $_POST['topic_title'] );
        if ( isset( $_POST['topic_imgurl'] ) && $_POST['topic_imgurl'] != "" )
        {
            $xt -> setTopicImgurl( $_POST['topic_imgurl'] );
        }

		if(isset($_POST['xoops_upload_file'])) {
			$fldname = $HTTP_POST_FILES[$_POST['xoops_upload_file'][0]];
			$fldname = (get_magic_quotes_gpc()) ? stripslashes($fldname['name']) : $fldname['name'];
			if(trim($fldname!=''))
			{
				$sfiles = new sFiles();
				$dstpath = XOOPS_ROOT_PATH . "/modules/" . $xoopsModule -> dirname() . '/images/topics';
				$destname=$sfiles->createUploadName($dstpath ,$fldname, true);
				$permittedtypes=array('image/gif', 'image/jpeg', 'image/pjpeg', 'image/x-png', 'image/png');
				$uploader = new XoopsMediaUploader($dstpath, $permittedtypes, $xoopsModuleConfig['maxuploadsize']);
				$uploader->setTargetFileName($destname);
				if ($uploader->fetchMedia($_POST['xoops_upload_file'][0]))
				{
					if ($uploader->upload()) {
						$xt->setTopicImgurl(basename($destname));
					} else {
						echo _AM_UPLOAD_ERROR;
					}
				} else {
					echo $uploader->getErrors();
				}
			}
		}
		$xt -> store();
        $notification_handler = & xoops_gethandler( 'notification' );
        $tags = array();
        $tags['TOPIC_NAME'] = $_POST['topic_title'];
        $notification_handler -> triggerEvent( 'global', 0, 'new_category', $tags );
        redirect_header( 'index.php?op=topicsmanager', 1, _AM_DBUPDATED );
    }
    else
    {
        redirect_header( 'index.php?op=topicsmanager',2,"Topic exists!");
    }
    exit();
}

switch ($op)
{
    case "newarticle":
        xoops_cp_header();
        adminmenu(1);
        echo "<h4>" . _AM_CONFIG . "</h4>";
        include_once XOOPS_ROOT_PATH . "/class/module.textsanitizer.php";
        // $xoopsModule->printAdminMenu();
        // echo "<br />";
        newSubmissions();
        autoStories();
        lastStories();
        expStories();
        echo "<br />";
        //echo"<table width='100%' border='0' cellspacing='1' class='outer'><tr><td class=\"odd\">";
        //echo "<h4>" . _AM_POSTNEWARTICLE . "</h4>";
        $type = "admin";
        $title = "";
        $topicdisplay = 0;
        $topicalign = 'R';
        $ihome = 1;
        $hometext = '';
        $bodytext = '';
        $notifypub = 1;
        $nohtml = 0;
        $approve = 0;
        $nosmiley = 0;
	    $autodate = '';
	    $expired = '';
	    $topicid = 0;
	    $published = time();
        if (file_exists(XOOPS_ROOT_PATH.'/modules/'.$xoopsModule->getVar('dirname').'/language/'.$xoopsConfig['language'].'/main.php')) {
            include_once '../language/'.$xoopsConfig['language'].'/main.php';
        }
        else {
            include_once '../language/english/main.php';
        }
        $approveprivilege = 1;
        //include_once "../include/storyform.inc.php";
        //echo"</td></tr></table>";
        break;

    case "edit":
    	xoops_cp_header();
        if (file_exists(XOOPS_ROOT_PATH.'/modules/'.$xoopsModule->getVar('dirname').'/language/'.$xoopsConfig['language'].'/main.php')) {
            include_once '../language/'.$xoopsConfig['language'].'/main.php';
        }
        else {
            include_once '../language/english/main.php';
        }
        $approveprivilege = 1;
        $story = new NewsStory($_POST['storyid']);
        $title = $story->title("Edit");
        $hometext = $story->hometext("Edit");
        $bodytext = $story->bodytext("Edit");
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
    	include_once "../include/storyform.inc.php";
    	break;

    case "delete":
        if (!empty($ok))
        {
            if (empty($storyid))
            {
                redirect_header( 'index.php?op=newarticle', 2, _AM_EMPTYNODELETE );
                exit();
            }
            $story = new NewsStory( $storyid );
			$story -> deleteLnk();
            $story -> delete();
			$sfiles = new sFiles();
			$filesarr=Array();
			$filesarr=$sfiles->getAllbyStory($storyid);
			if(count($filesarr)>0)
			{
				foreach ($filesarr as $onefile)
				{
					$onefile->delete();
				}
			}
            xoops_comment_delete( $xoopsModule -> getVar( 'mid' ), $storyid );
            xoops_notification_deletebyitem( $xoopsModule -> getVar( 'mid' ), 'story', $storyid );
            redirect_header( 'index.php?op=newarticle', 1, _AM_DBUPDATED );
            exit();
        }
        else
        {
            xoops_cp_header();
            echo "<h4>" . _AM_CONFIG . "</h4>";
            xoops_confirm( array( 'op' => 'delete', 'storyid' => $storyid, 'ok' => 1 ), 'index.php', _AM_RUSUREDEL );
        }
        break;
    case "topicsmanager":
        topicsmanager();
        break;

    case "addTopic":
        addTopic();
        break;

    case "delTopic":
        delTopic();
        break;
    case "modTopic":
        modTopic();
        break;
    case "modTopicS":
        modTopicS();
        break;
	case "fusion":
		fusionShow();
		break;
	case "fusionTodo":
		fusionMod();
		break;		
	case "gestCat":
		gestCat();
		break;
	case "gestCatAdd":
		gestCatAdd();
		break;		
	case "gestCatDel":
		gestCatDel();
		break;
	case "gestCatLnk":
		gestCatLnk();
		break;
	case "gestCatLnkUpdate":
		gestCatLnkUpdate();
		break;

    case "default":
    default:
        xoops_cp_header();
        adminmenu(0);
        echo "<h4>" . _AM_CONFIG . "</h4>";
        echo"<table width='100%' border='0' cellspacing='1' class='outer'><tr><td class=\"odd\">";
        echo " - <b><a href='index.php?op=topicsmanager'>" . _AM_TOPICSMNGR . "</a></b>";
        echo "<br /><br />\n";
        echo " - <b><a href='index.php?op=newarticle'>" . _AM_PEARTICLES . "</a></b>\n";
        echo "<br /><br />\n";
        echo " - <b><a href='index.php?op=fusion'>" . _MI_RECETTE_FUSION . "</a></b>\n";
        echo "<br /><br />\n";		
        echo " - <b><a href='index.php?op=gestCat'>" . _MI_RECETTE_ICONE . "</a></b>\n";
        echo "<br /><br />\n";				
        echo " - <b><a href='groupperms.php'>" . _AM_GROUPPERM . "</a></b>\n";
        echo "<br /><br />\n";
        echo " - <b><a href='" . XOOPS_URL . '/modules/system/admin.php?fct=preferences&amp;op=showmod&amp;mod=' . $xoopsModule -> getVar( 'mid' ) . "'>" . _AM_GENERALCONF . "</a></b>";
        echo"</td></tr></table>";
        break;
}

xoops_cp_footer();

?>