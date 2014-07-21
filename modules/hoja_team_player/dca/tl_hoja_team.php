<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');

/**
 * HoJa Team Players
 *
 * @author Holger Janßen <contao@holgerjanssen.de>
 * @copyright Holger Janßen <http://www.holgerjanssen.de>
 * @package hoja_team
 * @filesource
 * @licence LGPL
 */


$GLOBALS['TL_DCA']['tl_hoja_team']['ctable'][] = 'tl_hoja_team_player';
$GLOBALS['TL_DCA']['tl_hoja_team']['switchToEdit'] = true;

$GLOBALS['TL_DCA']['tl_hoja_team']['list']['operations']['edit_players'] = array (
	'label'               => &$GLOBALS['TL_LANG']['tl_hoja_team']['edit_players'],
	'href'                => 'table=tl_hoja_team_player',
	'icon'                => 'group.gif',
);
