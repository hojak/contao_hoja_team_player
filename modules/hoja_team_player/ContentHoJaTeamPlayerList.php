<?php

class ContentHoJaTeamPlayerList extends ContentElement
{

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'ce_hoja_team_playerlist';

	
	/**
	 * Import the back end user object
	 */
	public function __construct( $param )
	{
			parent::__construct( $param );
			$this->import('Database');
	}
	
        
        
	public function generate()
	{
		if ( TL_MODE == "BE") return "Spielerliste mit Detailansicht für Team: " . $this->hoja_team_id;
		
		// Set the item from the auto_item parameter
		// for fetching parameters to the content element
		if (!isset($_GET['items']) && $GLOBALS['TL_CONFIG']['useAutoItem'] && isset($_GET['auto_item']))
		{
			\Input::setGet('items', \Input::get('auto_item'));
		}
		
		return parent::generate();
	}
	
        
	protected function loadTeam ( $id ) 
	{
		$objTeam = $this->Database->prepare("SELECT * from tl_hoja_team WHERE id=?")->execute( $id );

		if ( $objTeam->numRows >= 1 ) {
			//$objTeam->next();
			return $objTeam->row();
		} else 
			return null;
	}
	
	protected function loadTeamMembers ( $id ) 
	{
		$players = $trainers = $cos = $staff = array ();
		
		$objPlayers = $this->Database->prepare(
			"SELECT * FROM tl_hoja_team_player "
			."WHERE pid=? AND published=1 "
			."ORDER BY type,cast(number as unsigned),number,name,prename")->execute( $id );

		if ( $objPlayers->numRows > 0 ) {
			while ( $objPlayers->next() ) {
				if ( $objPlayers->type == 'player' )
					array_push ( $players, $objPlayers->row() );
				elseif ( $objPlayers->type == 'trainer' )
					array_push ( $trainers, $objPlayers->row() );
				elseif ( $objPlayers->type == 'co-trainer' )
					array_push ( $cos, $objPlayers->row() );
				elseif ( $objPlayers->type == 'staff' )
					array_push ( $staff, $objPlayers->row() );
				else
					$this->log('Unknown player type: ' . $objPlayers->type, 'ContentHoJaTeamPlayerList loadTeamPlayers', TL_WARNING);                             
			}
		}
		
		return array ( "players" => $players, "trainers" => $trainers, "cos" => $cos, "staff" => $staff );
	}
	
        
        
	protected function loadPlayerDetails () {
		if (TL_MODE == 'BE') return null;
		
		global $objPage;
		
		$base = \Controller::generateFrontendUrl ( $objPage->row() );
		$current = $this->Environment->request;	
		
		$base = preg_replace ( "#\\.html$#","",  $base);
		$current = preg_replace ( "#\\.html$#", "", $current);
		
		if ( strlen ( $base ) < strlen ( $current )) {
			$player = explode ( "_", preg_replace ( "#^$base/#", "", $current) );
					
			$objPlayer = $this->Database->prepare("SELECT * FROM tl_hoja_team_player WHERE id=? AND published=1")->execute( $player[0] );

			if ( $objPlayer->numRows >= 1 ) {
				return $objPlayer->next();
			} else {
				throw new Exception ( "Player not found!");
			}
		}
		
		return null;
	}
        
        
	
	/**
	 * Generate the content element
	 */
	protected function compile()
	{
		//if ( TL_MODE == "BE") return "<h1>Spielerliste für das Team: " . "</h1>";
	
		$this->Template->team_id = $this->hoja_team_id;
		
		$this->Template->team = $this->loadTeam ( $this->hoja_team_id );
		$this->Template->team_list = $this->loadTeamMembers ( $this->hoja_team_id );
		
		try {
			$this->Template->player_details = $this->loadPlayerDetails ();
		} catch ( Exception $e ) {
			// player not found!
			global $objPage;
			$objPage->noSearch = 1;
			$objPage->cache = 0;

			// Send a 404 header
			header('HTTP/1.1 404 Not Found');
			
			\System::log('Player not found', __METHOD__, TL_ERROR);
			
			$this->Template->not_found = true;
			
			return;		
		}
		
	
		if ( $this->Template->team == null ) {
			// fehler: team existiert nicht!
			$this->log('Content Element access to non existent HoJa Team ' . $this->hoja_team_id, 'ContentHoJaTeamPlayerList compile', TL_ERROR);
			return;
		}
	}

}
