<?php

class HoJaTeamPlayerBEHelper extends Backend {


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
	 * Restrict the path for all fileTree fields when the archive has a filePath restriction
	 * this method gets call through DC-onload_callback
	 *
	 * @param DataContainer $dc
	 */
	public function setFiletreePath($dc)
	{
		$dbRes = $this->Database->prepare('SELECT t.useFilePath, t.filePath FROM tl_hoja_team_player p LEFT JOIN tl_hoja_team t ON t.id = p.pid WHERE p.id=?')->execute($dc->id);
		
		if ( ! $dbRes || $dbRes ->numRows <= 0 || $dbRes->useFilePath != '1' ) 
			return;
		
		$directory = \FilesModel::findById($dbRes->filePath);
		
		foreach($GLOBALS['TL_DCA'][$dc->table]['fields'] as $fld => $data)
		{
			if($data['inputType']!='fileTree') continue;
			$GLOBALS['TL_DCA'][$dc->table]['fields'][$fld]['eval']['path'] = $directory->path;
		}
	}
	
}
