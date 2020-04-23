<?php // ROUTE: /settings/account/change-email/:token/

$token = $attributes[0];
$tokenAsset = pdoFindByAttribute(M::EMAIL_TOKENS(), 'token', $token);

if ($tokenAsset) {
	F::dbUpdate(M::USERS(), $tokenAsset->created_by, ['email' => strtolower($tokenAsset->email)]);
	F::dbDelete(M::EMAIL_TOKENS(), $tokenAsset->id);
	header('Location: /settings/account/?success=change-email-success');
} else {
	header('Location: /sign-in/');
}
