<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2014 Leo Feyer
 *
 * @package Hoja_team_player
 * @link    https://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	'ContentHoJaTeamPlayerList' => 'system/modules/hoja_team_player/ContentHoJaTeamPlayerList.php',
	'HoJaTeamPlayerBEHelper'    => 'system/modules/hoja_team_player/HoJaTeamPlayerBEHelper.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'ce_hoja_team_playerlist' => 'system/modules/hoja_team_player/templates',
));
