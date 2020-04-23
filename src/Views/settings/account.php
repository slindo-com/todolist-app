<?php require __DIR__ . "/../layout/header.php";?>

<div class="frame">
	<main class="full">
		<?php $navItemActive = 'account';require __DIR__ . "/../layout/secondary-nav.php";?>


		<div class="header-wrapper">
			<header class="header">
				<div class="inner">
					<h2>
						<a href="/settings/account/">
							<?php i18n('account');?>
						</a>
					</h2>
					<form method="POST" class="button-wrapper">
						<button type="submit" name="a" value="sign-out" class="btn">
							<?php i18n('sign_out');?>
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
					<?php i18n('basic_account_settings');?>
				</small>
			</div>
			<div class="right">



				<div class="box">
					<?php if (!empty($user->pic)): ?>
						<figure class="pic">
							<img src="/pics/<?php e($user->pic);?>" alt="Profile Picture" />
						</figure>
					<?php endif;?>

					<p>
						<strong>
							<?php i18n('email');?> &nbsp;
						</strong>
						<?php e($user->email);?>
					</p>
					<a href="/settings/account/change-email/">
						<?php i18n('change_email');?>
					</a>
					&nbsp;
					<a href="/settings/account/change-password/">
						<?php i18n('change_password');?>
					</a>
					&nbsp;
					<a href="/settings/account/change-pic/">
						<?php i18n('change_picture');?>
					</a>
				</div>



				<form method="POST" class="form shadow">
					<label for="na">
						<?php i18n('your_name');?>
					</label>
					<input placeholder="<?php i18n('type_here');?>" type="text" name="name" id="na" value="<?php e(!empty($user->name) ? $user->name : '');?>">

					<footer>
						<button type="submit" class="btn" name="a" value="save-name">
							<?php i18n('change_name');?>
						</button>
					</footer>
				</form>
			</div>
		</section>



	</main>




<?php require __DIR__ . "/../layout/footer.php";?>
