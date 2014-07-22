<?php

$GLOBALS['TL_LANG']['tl_hoja_team_player'] = array
(
	'type'				=> array ('type', "Is the member a player, trainer or staff?"),
	'type_options' 		=> array ('player' => "player", 'trainer' => "trainer", 'co-trainer' => "co-trainer", 'staff' => "staff"),
	
	'number' 			=> array ('number','(optional) (unique) number of the player'),
	'position' 			=> array ('position', 'field position / function of the player'),
	'name' 				=> array ('name', 'name'),
	'prename' 			=> array ('prename', 'prename'),
	'nickname'	 		=> array ('nick', 'nickname'),
	'height_cm' 		=> array ('size', 'size in cm'),
	'birthday'	 		=> array ('birthday', 'birthday'),
	'city_of_birth' 	=> array ('city of birth', 'city of birth'),
	'nationality' 		=> array ('nationality', 'nationality'),
	'profession'	 	=> array ('profession', 'profession'),
	'hobbies'	 		=> array ('hobbies', 'additional hobbies'),
	'in_club_since'		=> array ('accession', 'Since when is this player member of the club?'),
	'previous_clubs'	=> array ('previous clubs', 'previous clubs or teams of this player'),
	'email' 			=> array ('email', 'email address'),
	'phone' 			=> array ('phone', 'phone'),
	'free_text' 		=> array ('free text', 'free text for the detail view'),
	'published' 		=> array ('published?', 'is this player plublically accessibla (via the team list)?'),
	'image' 			=> array ('picture', 'portrait or other picture of the player'),
	'team_function'		=> array ('function', 'function within the team (besides game position)'),
	'comments' 			=> array ("comments", "comments of team members"),
	'other_attributes'	=> array ("additional attributes", "random pairs of name / value for the detail page"),
	'attr_name'			=> array ("attribute", "name of the attribute"),
	'attr_value'		=> array ("value", "value"),

	'team_data_legend' 		=> 'player in the team',
	'name_legend'			=> 'name',
	'personal_data_legend'	=> 'personal data',
	'club_data_legend' 		=> 'club data',
	'contact_legend' 		=> 'contact data',
	'image_legend' 			=> 'picture',
	'free_text_legend' 		=> 'free description',
	'status_legend' 		=> 'publishing status',
	'team_legend'			=> 'player and the team',
	'activities_legend'		=> 'activities outside the team',
	
	// actions
	'new' => array ( "new player", "a a new player"),
	'edit' => array ( "edit", "edit player width ID %s"),
	'copy' => array ( "copy", "copy player with ID %s" ),
	'delete' => array ( "delete", "delte player with ID %s" )
);