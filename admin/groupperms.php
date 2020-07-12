<?php
// $Id: groupperms.php,v 1.5 2004/04/25 15:26:56 hthouzard Exp $
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
include '../../../include/cp_header.php';
include_once XOOPS_ROOT_PATH . "/class/xoopstopic.php";
include_once XOOPS_ROOT_PATH . "/class/xoopslists.php";
include_once XOOPS_ROOT_PATH.'/class/xoopsform/grouppermform.php';
include_once "functions.php";

xoops_cp_header();

adminmenu(2);

//Approver Form
$title_of_form = _AM_APPROVEFORM;
$perm_name = "recette_approve";
$perm_desc = _AM_APPROVEFORM_DESC;

$module_id = $xoopsModule->getVar('mid');
$approveform = new XoopsGroupPermForm($title_of_form, $module_id, $perm_name, $perm_desc);

$xt = new XoopsTopic( $xoopsDB -> prefix( "recette_topics" ) );
$alltopics =& $xt->getTopicsList();

foreach ($alltopics as $topic_id => $topic) {
    $approveform->addItem($topic_id, $topic['title'], $topic['pid']);
}

echo $approveform->render();
unset ($approveform);

//Submitter Form
$title_of_form = _AM_SUBMITFORM;
$perm_name = "recette_submit";
$perm_desc = _AM_SUBMITFORM_DESC;

$module_id = $xoopsModule->getVar('mid');
$submitform = new XoopsGroupPermForm($title_of_form, $module_id, $perm_name, $perm_desc);

$xt = new XoopsTopic( $xoopsDB -> prefix( "recette_topics" ) );
$alltopics =& $xt->getTopicsList();

foreach ($alltopics as $topic_id => $topic) {
    $submitform->addItem($topic_id, $topic['title'], $topic['pid']);
}

echo $submitform->render();
unset ($submitform);

//Viewer Form
$title_of_form = _AM_VIEWFORM;
$perm_name = "recette_view";
$perm_desc = _AM_VIEWFORM_DESC;

$module_id = $xoopsModule->getVar('mid');
$viewform = new XoopsGroupPermForm($title_of_form, $module_id, $perm_name, $perm_desc);

$xt = new XoopsTopic( $xoopsDB -> prefix( "recette_topics" ) );
$alltopics =& $xt->getTopicsList();

foreach ($alltopics as $topic_id => $topic) {
    $viewform->addItem($topic_id, $topic['title'], $topic['pid']);
}

echo $viewform->render();
unset ($viewform);

xoops_cp_footer();
?>