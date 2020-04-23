<?php

//
function TEAM_MEMBERS() {
	return [
		'table' => 'team_members',
		'asset' => 'TeamMembersAsset',
	];
}

//
class TeamMembersAsset extends AbstractAsset {
	public $user;
	public $team;
	public $role;
}