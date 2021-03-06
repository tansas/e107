<?php 
/*
 * e107 website system
 *
 * Copyright (C) 2008-2009 e107 Inc (e107.org)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 * Comment menu
 *
 * $Source: /cvs_backup/e107_0.8/e107_plugins/comment_menu/comment_menu.php,v $
 * $Revision$
 * $Date$
 * $Author$
*/

if (!defined('e107_INIT'))
{
	exit;
}

require_once (e_PLUGIN."comment_menu/comment_menu_shortcodes.php");

$cobj = e107::getObject('comment');
//require_once (e_HANDLER."comment_class.php");
//$cobj = new comment;

if (file_exists(THEME."comment_menu_template.php"))
{
	require_once (THEME."comment_menu_template.php");
}
else
{
	require_once (e_PLUGIN."comment_menu/comment_menu_template.php");
}

$data = $cobj->getCommentData(intval($menu_pref['comment_display']));

$text = '';
// no posts yet ..
if (empty($data) || !is_array($data))
{
	$text = CM_L1;
}

foreach ($data as $row)
{
	e107::setRegistry('plugin/comment_menu/current', $row);
	$text .= $tp->parseTemplate($COMMENT_MENU_TEMPLATE, true, $comment_menu_shortcodes);
}
e107::setRegistry('plugin/comment_menu/current', null);

$title = e107::getConfig('menu')->get('comment_caption');
e107::getRender()->tablerender(defset($title, $title), $text, 'comment_menu');
?>