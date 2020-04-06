<?php

namespace App\Settings;

use App\Core\AbstractController;
use App\Auth\AuthService;
use App\Common\MailService;

use App\Models\TeamsModel;
use App\Models\TeamMembersModel;
use App\Models\UsersModel;
use App\Models\InvitesModel;

class SettingsController extends AbstractController {

	public function __construct(
		TeamsModel $teamsModel,
		TeamMembersModel $teamMembersModel,
		UsersModel $usersModel,
		InvitesModel $invitesModel,
		AuthService $authService,
		MailService $mailService
	) {
		$this->teamsModel = $teamsModel;
		$this->teamMembersModel = $teamMembersModel;
		$this->usersModel = $usersModel;
		$this->invitesModel = $invitesModel;
		$this->authService = $authService;
		$this->mailService = $mailService;
	}

	public function index() {
		$this->authService->verifyAuth();
		$this->render("settings/index", []);
	}

	public function teams() {
		$this->authService->verifyAuth();

		if(!empty($_POST['a']) && $_POST['a'] == 'new-team') {
			$this->teamsModel->new($_SESSION['auth']);
		} else if(!empty($_POST['a']) && $_POST['a'] == 'join-team') {
			$invite = $this->invitesModel->find($_POST['inviteId']);
			$user = $this->usersModel->find($_SESSION['auth']);

			if($invite->email == $user->email) {
				$this->teamMembersModel->new($user->id, $invite->team);
				$this->invitesModel->delete($invite->id);
			}		
		} else if(!empty($_POST['a']) && $_POST['a'] == 'decline-invitation') {
			$invite = $this->invitesModel->find($_POST['inviteId']);
			$user = $this->usersModel->find($_SESSION['auth']);

			if($invite->email == $user->email) {
				$this->invitesModel->delete($invite->id);
			}
		}

		$teams = $this->teamsModel->getTeams($_SESSION['auth']);
		$user = $this->usersModel->find($_SESSION['auth']);
		$invite = $this->invitesModel->findByAttribute('email', $user->email);

		if($invite) {
			$invitingTeam = $this->teamsModel->find($invite->team);
		}

		$memberCounts = [];
		foreach ($teams as $team) {
			$memberCounts[$team->id] = $this->teamsModel->getMemberCount($team->id);
		}

		$this->render("settings/teams", [
			'teams' => $teams,
			'memberCounts' => $memberCounts,
			'invite' => $invite,
			'invitingTeam' => $invitingTeam
		]);
	}

	public function team($attributes) {
		$this->authService->verifyAuth();

		$teamSlug = $attributes[0];

		$team = $this->teamsModel->findByAttribute('slug', $teamSlug);
		$members = $this->usersModel->getTeamMembers($team->id);
		$invites = $this->invitesModel->getTeamInvites($team->id);

		$this->render("settings/team", [
			'team' => $team,
			'members' => $members,
			'invites' => $invites
		]);
	}


	public function editTeamTitle($attributes) {
		$this->authService->verifyAuth();

		$teamSlug = $attributes[0];
		$team = $this->teamsModel->findByAttribute('slug', $teamSlug);

		if(!empty($_POST['a']) && $_POST['a'] == 'edit-title') {
			$success = $this->teamsModel->updateTitle($team->id, $_POST['title']);

			if($success) {
				$team = $this->teamsModel->find($team->id);
				header("Location: /settings/teams/". $team->slug ."/");
			}
		}

		$this->render("settings/edit-team-title", [
			'team' => $team
		]);
	}


	public function inviteTeamMember($attributes) {
		$this->authService->verifyAuth();

		$teamSlug = $attributes[0];
		$team = $this->teamsModel->findByAttribute('slug', $teamSlug);

		if(!empty($_POST['a']) && $_POST['a'] == 'send-invitation') {
			$token = bin2hex(random_bytes(50));
			$success = $this->invitesModel->new($team->id, $_POST['email'], $_POST['name'], $token);

			if($success) {

				$user = $this->usersModel->findByAttribute('email', strtolower($_POST['email']));

				if(!$user) {
					$this->mailService->send([
						'to' => $_POST['email'],
						'subject' => 'Invite to Team on Todolist One',
						'message' => 'Invite to Team on Todolist One: '. $token
					]);
				}

				header("Location: /settings/teams/". $team->slug ."/");
			}
		}

		$this->render("settings/invite-team-member", [
			'team' => $team
		]);
	}


	public function account() {
		$this->authService->verifyAuth();
		
		if(!empty($_POST['a']) && $_POST['a'] == 'sign-out') {
			$this->authService->signOut();
		}
		$this->render("settings/account", []);
	}

	public function changeEmail() {
		echo 'TODO: SETTINGS: CHANGE EMAIL';
	}

	public function changePassword() {
		echo 'TODO: SETTINGS: CHANGE PASSWORD';
	}
}

 ?>
