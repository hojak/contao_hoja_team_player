<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

$GLOBALS['TL_DCA']['tl_content']['palettes']['hoja_team_playerlist_ce']                       
        = '{type_legend},type,headline;{hoja_team_playerlist_legend},hoja_team_id;{hoja_size_legend},size;{hoja_detail_size_legend},hoja_detail_size;{expert_legend:hide},cssID,cssClass';

        
$GLOBALS['TL_DCA']['tl_content']['fields']['hoja_detail_size'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['size'],
	'exclude'                 => true,
	'inputType'               => 'imageSize',
	'options'                 => $GLOBALS['TL_CROP'],
	'reference'               => &$GLOBALS['TL_LANG']['MSC'],
	'eval'                    => array('rgxp'=>'digit', 'nospace'=>true, 'helpwizard'=>true),
	'sql'                     => "varchar(64) NOT NULL default ''"

);