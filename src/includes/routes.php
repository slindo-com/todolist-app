<?php
$routes = [ 
	'/settings/account/change-email/:token/' => 'settings/change_email_token',
	'/settings/account/change-password/' => 'settings/change_password',
	'/settings/teams/:team/edit-title/' => 'settings/team_change_title',
	'/settings/account/change-email/' => 'settings/change_email',
	'/settings/account/change-pic/' => 'settings/change_pic',
	'/settings/teams/:team/invite/' => 'settings/invite',
	'/:team/:list/show-done/' => 'lists/list_show_done',
	'/settings/teams/:team/' => 'settings/team',
	'/new-password/:token/' => 'auth/new_password',
	'/new-account/:token/' => 'auth/new_account',
	'/:team/:listId/edit/' => 'lists/edit',
	'/unsubscribe/:token/' => 'system/unsubscribe',
	'/:team/:list/:task/' => 'lists/todo',
	'/settings/account/' => 'settings/account',
	'/checkmark/:task/' => 'lists/checkmark',
	'/settings/teams/' => 'settings/teams',
	'/new-password/' => 'auth/new_password',
	'/new-account/' => 'auth/new_account',
	'/:team/:list/' => 'lists/list',
	'/settings/' => 'settings/general',
	'/sign-in/' => 'auth/sign_in',
	'/:team/' => 'lists/all',
];