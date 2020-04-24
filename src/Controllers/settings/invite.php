<?php // ROUTE: /settings/teams/:team/invite/

F::verifyAuth();

$teamSlug = $attributes[0];
$team = F::dbFindOne(M::TEAMS(), ['slug' => $teamSlug]);

if (F::actionEquals('send-invitation')) {
	$token = bin2hex(random_bytes(50));

	$success = F::dbNew(M::INVITES(), [
		'token' => $token,
		'team' => $team->id,
		'email' => $_POST['email'],
		'name' => $_POST['name'],
		'created_by' => $_SESSION['auth'],
	]);

	if ($success) {

		$user = F::dbFindOne(M::USERS(), ['email' => strtolower($_POST['email'])]);

		if (!$user) {

			$emailTemplate = MAIL::INVITE(CONFIG()['title'], CONFIG()['url'], $token);

			F::sendMail([
				'to' => $_POST['email'],
				'subject' => $emailTemplate['subject'],
				'message' => $emailTemplate['message'],
			]);
		}

		header("Location: /settings/teams/" . $team->slug . "/");
	}
}

F::render("settings/invite-team-member", [
	'team' => $team,
]);
