<?php require __DIR__ . "/../layout/header.php";?>

<main class="full">
	<?php $navItemActive = 'account';require __DIR__ . "/../layout/secondary-nav.php";?>


	<div class="header-wrapper">
		<header class="header">
			<div class="inner">
				<h2>
					[[account]]
				</h2>
				<form method="POST" class="button-wrapper">
					<button type="submit" name="a" value="sign-out" class="btn">
						[[sign_out]]
					</button>
				</form>
			</div>
		</header>
	</div>



	<?php if ($success): ?>
		<section class="container">
			<div class="message">
				<?php
switch ($success) {
case 'change-name':i18n('name_updated_successfully');
	break;
case 'change-email':i18n('please_confirm_email');
	break;
case 'change-email-success':i18n('email_updated_successfully');
	break;
case 'change-name':i18n('password_updated_successfully');
	break;
case 'change-pic':i18n('picture_updated_successfully');
	break;
}
?>
			</div>
		</section>
	<?php endif?>



	<section class="container flex">
		<div class="left">
			<small>
				[[basic_account_settings]]
			</small>
		</div>
		<div class="right">



			<div class="box">
				<?php if (!empty($user->pic)): ?>
					<figure class="pic">
						<img src="/pics/{{$user->pic}}" alt="Profile Picture" />
					</figure>
				<?php endif;?>

				<p>
					<strong>
						[[email]] &nbsp;
					</strong>
					{{$user->email}}
				</p>
				<div class="link-wrapper">
					<a href="/settings/account/change-email/">
						[[change_email]]
					</a>
					<a href="/settings/account/change-password/">
						[[change_password]]
					</a>
					<a href="/settings/account/change-pic/">
						[[change_picture]]
					</a>
				</div>
			</div>



			<form method="POST" class="form shadow">
				<label for="na">
					[[your_name]]
				</label>
				<input placeholder="[[type_here]]" type="text" name="name" id="na" value="{{!empty($user->name) ? $user->name : ''}}">

				<footer>
					<button type="submit" class="btn" name="a" value="save-name">
						[[change_name]]
					</button>
				</footer>
			</form>
		</div>
	</section>



	</main>




<?php require __DIR__ . "/../layout/footer.php";?>
