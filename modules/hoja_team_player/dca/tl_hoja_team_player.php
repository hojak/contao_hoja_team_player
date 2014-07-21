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

 
$GLOBALS['TL_DCA']['tl_hoja_team_player'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
		'ptable'                      => 'tl_hoja_team',
		'switchToEdit'                => true,
		'enableVersioning'            => true,
		'onload_callback' => array
		(
			array('tl_hoja_team_player', 'checkPermission'),
			array('HoJaTeamPlayerBEHelper', 'setFiletreePath')
		),
		'sql' => array ( 'keys' => array ( 'id' => 'primary' )),

	),

	// List
	'list' => array
	(
		'sorting' => array
		(
			'mode'                    => 4,
			'fields'                  => array('type','position','number','name'),
			'panelLayout'             => 'filter,limit;search,sort',
			'headerFields'            => array('name','league','season'),
			'child_record_callback'   => array('tl_hoja_team_player','listPlayers')
		),
		
		'label' => array
		(
			'fields'                  => array('number', 'name', 'prename'),
			'format'                  => '(%s) %s, %s'
		),
		
		
		'global_operations' => array
		(
			'all' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'                => 'act=select',
				'class'               => 'header_edit_all',
				'attributes'          => 'onclick="Backend.getScrollOffset();" accesskey="e"'
			)
		),
		'operations' => array
		(
			'edit' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_hoja_team_player']['edit'],
				'href'                => 'act=edit',
				'icon'                => 'edit.gif',
			),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_hoja_team_player']['copy'],
				'href'                => 'act=paste&amp;mode=copy',
				'icon'                => 'copy.gif',
				'attributes'          => 'onclick="Backend.getScrollOffset();"',
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_hoja_team_player']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"',
			),
			'toggle' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_hoja_team_player']['toggle'],
				'icon'                => 'visible.gif',
				'attributes'          => 'onclick="Backend.getScrollOffset();return AjaxRequest.toggleVisibility(this,%s)"',
				'button_callback'     => array('tl_hoja_team_player', 'toggleIcon')
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_hoja_team_player']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			)
		)
	),

	// Palettes
	'palettes' => array
	(
		/*'__selector__'				  => array('useFacebookImage'),*/
		'__selector__' => array('type'),
		'default'	=> 
			'{team_data_legend},type;'
			.'{name_legend},prename,name,nickname;'
			.'{personal_data_legend},height_cm,birthday,city_of_birth,nationality;'
			.'{contact_legend:hide},email,phone;'
			.'{activities_legend},profession,hobbies;'
			.'{club_data_legend},in_club_since,previous_clubs;'
			.'{team_legend},team_function,comments;'
			.'{image_legend},image;'
			.'{free_text_legend},other_attributes,free_text;'
			.'{status_legend},published'
	),

	
	'subpalettes' => array (
		'type_player' => 'number,position',
		'type_staff' => 'position',
		'type_default' => ''
	),
	/*
	'subpalettes' => array
	(
		'useFacebookImage'			  => 'facebookImage'
	),
	*/

	// Fields
	'fields' => array
	(  
		'id' => array (
			'sql' => 'int(10) unsigned NOT NULL auto_increment',
		),
		'pid' => array (
			'sql' => "int(10) unsigned NOT NULL default '0'",
		),
		'tstamp' => array
		(
			'sql' => "int(10) unsigned NOT NULL default '0'"
		),
		'type' => array
		(
			'label'					=> &$GLOBALS['TL_LANG']['tl_hoja_team_player']['type'],
			'inputType'				=> 'select',
			'options'				=> &$GLOBALS['TL_LANG']['tl_hoja_team_player']['type_options'],
			'exclude'				=> true,
			'eval'					=> array('mandatory'=>true, 'maxlength'=>10, "submitOnChange" => true),
			'sql'					=> "varchar(10) NOT NULL default 'player'",
		),  
		
  		'number' => array
		(
			'label'					=> &$GLOBALS['TL_LANG']['tl_hoja_team_player']['number'],
			'inputType'				=> 'text',
			'exclude'				=> true,
			'search'				=> true,
			'sorting'				=> true,
			'eval'					=> array('maxlength'=>3, 'tl_class' => 'w50'),
			'sql'					=> 'smallint(5) unsigned NULL',
		),  
		'position' => array
		(
			'label'					=> &$GLOBALS['TL_LANG']['tl_hoja_team_player']['position'],
			'inputType'				=> 'text',
			'exclude'				=> true,
			'search'				=> true,
			'sorting'				=> true,
			'flag'					=> 11,
			'eval'					=> array('maxlength'=>255, 'tl_class' => 'w50'),
			'sql'					=> "varchar(255) NOT NULL default ''",
		),
  		'name' => array
		(
			'label'					=> &$GLOBALS['TL_LANG']['tl_hoja_team_player']['name'],
			'inputType'				=> 'text',
			'exclude'				=> true,
			'search'				=> true,
			'eval'					=> array('mandatory'=>true, 'maxlength'=>255, 'tl_class' => "w50"),
			'sql'					=> "varchar(255) NOT NULL default ''",
		),  
  		'prename' => array
		(
			'label'					=> &$GLOBALS['TL_LANG']['tl_hoja_team_player']['prename'],
			'inputType'				=> 'text',
			'exclude'				=> true,
			'search'				=> true,
			'eval'					=> array('mandatory'=>true, 'maxlength'=>255, 'tl_class' => "w50"),
			'sql'					=> "varchar(255) NOT NULL default ''",
		),  
		'nickname' => array
		(
			'label'					=> &$GLOBALS['TL_LANG']['tl_hoja_team_player']['nickname'],
			'inputType'				=> 'text',
			'exclude'				=> true,
			'search'				=> true,
			'eval'					=> array('maxlength'=>255),
			'sql'					=> 'varchar(255) NULL',
		),
		'height_cm' => array
		(
			'label'					=> &$GLOBALS['TL_LANG']['tl_hoja_team_player']['height_cm'],
			'inputType'				=> 'text',
			'exclude'				=> true,
			'search'				=> true,
			'sql'					=> 'smallint(5) unsigned NULL',
		),
		'birthday' => array
		(
			'label'					=> &$GLOBALS['TL_LANG']['tl_hoja_team_player']['birthday'],
			'inputType'				=> 'text',
			'exclude'				=> true,
			'default'				=> time(),
			'eval'					=> array('rgxp'=>'date', 'datepicker'=>true, 'tl_class'=>'w50 wizard'),
			'default'				=> null,
			'sql'					=> 'varchar(10) NULL',
		),
  		'city_of_birth' => array
		(
			'label'					=> &$GLOBALS['TL_LANG']['tl_hoja_team_player']['city_of_birth'],
			'inputType'				=> 'text',
			'exclude'				=> true,
			'search'				=> true,
			'eval'					=> array('maxlength'=>255),
			'sql'					=> 'varchar(255) NULL',
		),
  		'nationality' => array
		(
			'label'					=> &$GLOBALS['TL_LANG']['tl_hoja_team_player']['nationality'],
			'inputType'				=> 'text',
			'exclude'				=> true,
			'search'				=> true,
			'eval'					=> array('maxlength'=>3),
			'sql'					=> 'varchar(3) NULL',
		),
  		'profession' => array
		(
			'label'					=> &$GLOBALS['TL_LANG']['tl_hoja_team_player']['profession'],
			'inputType'				=> 'text',
			'exclude'				=> true,
			'search'				=> true,
			'eval'					=> array('maxlength'=>255, 'tl_class' => 'w50'),
			'sql'					=> 'varchar(255) NULL',
		),
		'in_club_since' => array
		(
			'label'					=> &$GLOBALS['TL_LANG']['tl_hoja_team_player']['in_club_since'],
			'inputType'				=> 'text',
			'exclude'				=> true,
			'search'				=> true,
			'sql'					=> 'int(10) unsigned NULL',
		),
		'previous_clubs' => array
		(
			'label'					=> &$GLOBALS['TL_LANG']['tl_hoja_team_player']['previous_clubs'],
			'inputType'				=> 'text',
			'exclude'				=> true,
			'search'				=> true,
			'eval'					=> array('maxlength'=>255),
			'sql'					=> 'varchar(255) NULL',
		),
		'email' => array
		(
			'label'					=> &$GLOBALS['TL_LANG']['tl_hoja_team_player']['email'],
			'inputType'				=> 'text',
			'exclude'				=> true,
			'search'				=> true,
			'eval'					=> array('maxlength'=>255, 'rgxp' => 'email', 'tl_class' => "w50"),
			'sql'					=> 'varchar(255) NULL',
		),
		'phone' => array
		(
			'label'					=> &$GLOBALS['TL_LANG']['tl_hoja_team_player']['phone'],
			'inputType'				=> 'text',
			'exclude'				=> true,
			'search'				=> true,
			'eval'					=> array('maxlength'=>255, 'tl_class' => "w50"),
			'sql'					=> 'varchar(255) NULL',
		),          
		'hobbies' => array
		(
			'label'					=> &$GLOBALS['TL_LANG']['tl_hoja_team_player']['hobbies'],
			'inputType'				=> 'text',
			'exclude'				=> true,
			'search'				=> true,
			'eval'					=> array('maxlength'=>255, 'tl_class' => 'w50'),
			'sql'					=> 'varchar(255) NULL',
		),
		'comments' => array (
			'label'					=> &$GLOBALS['TL_LANG']['tl_hoja_team_player']['comments'],
			'inputType'				=> 'multiColumnWizard',
			'exclude'				=> true,
			'search'				=> true,
			'eval'					=> array(
				'columnFields' => array 
				(
					'value' => array
					(
						'label'         => &$GLOBALS['TL_LANG']['tl_hoja_team_player']['comments_value'],
						'exclude'       => 'true',
						'inputType'     => 'text',
						'eval'          => array('columnPos' => '1', "style" => "width: 500px;")
					),
				),
			),
			'sql'					=> 'text NULL',
		),
		'team_function' => array (
			'label'					=> &$GLOBALS['TL_LANG']['tl_hoja_team_player']['team_function'],
			'inputType'				=> 'text',
			'exclude'				=> true,
			'search'				=> true,
			'eval'					=> array('maxlength'=>255),
			'sql'					=> 'varchar(255) NULL',
		),
		'other_attributes' => array
		(
			'label'         => &$GLOBALS['TL_LANG']['tl_hoja_team_player']['other_attributes'],
			'inputType'     => 'multiColumnWizard',
			'sql'           => 'text NULL',
			'eval'          => array
			(
				'columnFields' => array 
				(
					'name' => array
					(
						'label'         => &$GLOBALS['TL_LANG']['tl_hoja_team_player']['attr_name'],
						'exclude'       => 'true',
						'inputType'     => 'text',
						'eval'          => array('columnPos' => '1', "style" => "width: 180px")
					),
					'value' => array
					(
						'label'         => &$GLOBALS['TL_LANG']['tl_hoja_team_player']['attr_value'],
						'exclude'       => 'true',
						'inputType'     => 'text',
						'eval'          => array('columnPos' => '2', "style" => "width: 350px")
					),
				),
			),
		),
		'free_text'	=> array 
		(
			'label'					=> &$GLOBALS['TL_LANG']['tl_hoja_team_player']['free_text'],
			'inputType'				=> 'textarea',
			'exclude'				=> true,
			'search'				=> true,
			'eval'					=> array ( 'rte' => 'tinyMCE' ),
			'sql'					=> 'text NOT NULL',
		),
		'published' => array
		(
			'label'					=> &$GLOBALS['TL_LANG']['tl_hoja_team_player']['published'],
			'exclude'				=> true,
			'filter'				=> true,
			'flag'					=> 1,
			'inputType'				=> 'checkbox',
			'eval'					=> array('doNotCopy'=>true),
			'sql'					=> "char(1) NOT NULL default ''",
		),
		'image' => array 
		(
			'label'					=> &$GLOBALS['TL_LANG']['tl_hoja_team_player']['image'],
			'exclude'				=> true,
			'filter'				=> true,
			'inputType'				=> 'fileTree',
			'eval'					=> array('fieldType'=>'radio', 'files'=>'true', 'filesOnly'=>true, 'extensions'=>'jpg,jpeg,gif,png'),
			'sql'					=> 'binary(16) NULL',
		),
	),
);


class tl_hoja_team_player extends Backend
{

	/**
	 * Import the back end user object
	 */
	public function __construct()
	{
		parent::__construct();
		$this->import('BackendUser', 'User');
		$this->import('Database');
	}


	/**
	 * Check permissions to edit table tl_news4ward_article
	 */
	public function checkPermission()
	{
	
		if ($this->User->isAdmin)
		{
			// allow admins
			return;
		}

		// find tl_news4archiv.id
		if(!$this->Input->get('act') || in_array($this->Input->get('act'),array('create','select','editAll','overrideAll')))
		{
			$teamId = $this->Input->get('id');
		}
		else
		{
			$objPlayer = $this->Database->prepare('SELECT pid FROM tl_hoja_team_player WHERE id=?')->execute($this->Input->get('id'));
			$teamId = $objPlayer->pid;
		}

		if(is_array($this->User->hoja_teams) && count($this->User->hoja_teams) > 0 && in_array($teamId,$this->User->hoja_teams)) return;

		$this->log('Not enough permissions to '.$this->Input->get('act').' hoja team ID "'.$teamId.'"', 'tl_hoja_team_player checkPermission', TL_ERROR);
		$this->redirect('contao/main.php?act=error_3');
	}
	
	
	public function toggleIcon($row, $href, $label, $title, $icon, $attributes)
	{
		if (strlen($this->Input->get('tid')))
		{
			$this->toggleVisibility($this->Input->get('tid'), ($this->Input->get('state') == 1));
			$this->redirect($this->getReferer());
		}

		// Check permissions AFTER checking the tid, so hacking attempts are logged
		if (!$this->User->isAdmin && !$this->User->hasAccess('tl_hoja_team_player::published', 'alexf'))
		{
			return '';
		}

		$href .= '&amp;tid='.$row['id'].'&amp;state='.($row['published'] ? '' : 1);

		if (!$row['published'])
		{
			$icon = 'invisible.gif';
		}               

		return '<a href="'.$this->addToUrl($href).'" title="'.specialchars($title).'"'.$attributes.'>'.$this->generateImage($icon, $label).'</a> ';
	}

	
	
	
	public function listPlayers($arrRow)
	{
		$time = time();
		$key = ( $arrRow['published'] ) ? 'published' : 'unpublished';

		if ( $arrRow['type'] == "trainer" ) 
			$type = "T";
		elseif ( $arrRow ['type'] == "co-trainer" )
			$type = "C";
		else
			$type = $arrRow ['number'];
		
		return '<div class="cte_type ' . $key . '"><strong>(' . $arrRow['number'] .") ". $arrRow['name'] . '</strong>, ' . $arrRow['prename'] . '</div>'."\n";
	}

	
	public function toggleVisibility($intId, $blnVisible)
	{
		// Check permissions to edit
		$this->Input->setGet('id', $intId);
		$this->Input->setGet('act', 'toggle');
		$this->checkPermission();

		// Check permissions to publish
		if (!$this->User->isAdmin && !$this->User->hasAccess('tl_hoja_team_player::published', 'alexf'))
		{
			$this->log('Not enough permissions to publish/unpublish HoJa Team Player ID "'.$intId.'"', 'tl_hoja_team_player toggleVisibility', TL_ERROR);
			$this->redirect('contao/main.php?act=error_4');
		}

		$this->createInitialVersion('tl_hoja_team_player', $intId);

		// Trigger the save_callback
		if (is_array($GLOBALS['TL_DCA']['tl_hoja_team_player']['fields']['published']['save_callback']))
		{
			foreach ($GLOBALS['TL_DCA']['tl_hoja_team_player']['fields']['published']['save_callback'] as $callback)
			{
					$this->import($callback[0]);
					$blnVisible = $this->$callback[0]->$callback[1]($blnVisible, $this);
			}
		}

		// Update the database
		$this->Database->prepare("UPDATE tl_hoja_team_player SET tstamp=". time() .", published='" . ($blnVisible ? 1 : '') . "' WHERE id=?")
									->execute($intId);

		$this->createNewVersion('tl_hoja_team_player', $intId);
	}

	
	
	
}

?>
