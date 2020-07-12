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

$myts =& MyTextSanitizer::getInstance();
// set comment mode if not set


$list = Ingredient::getAllIngredients();

$gperm_handler =& xoops_gethandler('groupperm');
if (is_object($xoopsUser)) {
    $groups = $xoopsUser->getGroups();
} else {
	$groups = XOOPS_GROUP_ANONYMOUS;
}
if (!$gperm_handler->checkRight("recette_view", '', $groups, $xoopsModule->getVar('mid'))) {
	redirect_header('index.php', 3, _NOPERM);
	exit();
}


$xoopsOption['template_main'] = 'recette_listeing.html';

include_once XOOPS_ROOT_PATH.'/header.php';

$xoopsTpl->assign('listeing',$list);
$xoopsTpl->assign('ingredienttitle', _NW_INGTITLE);

include XOOPS_ROOT_PATH.'/footer.php';
?>
