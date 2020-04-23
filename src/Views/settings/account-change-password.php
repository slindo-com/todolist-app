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
						→
						<?php i18n('change_password');?>
					</h2>
					<form method="POST" action="/account/" class="button-wrapper">
						<button type="submit" name="a" value="sign-out" class="btn">
							<?php i18n('sign_out');?>
						</button>
					</form>
				</div>
			</header>
		</section>


		<?php if ($error): ?>
			<section class="container">
				<div class="message error">
					<?php e($error);?>
				</div>
			</section>
		<?php endif?>


		<section class="container flex">
			<div class="left">
				<small>
					<?php i18n('change_password_description');?>
				</small>
			</div>
			<div class="right">

				<form method="POST" class="form shadow">
					<label for="op">
						<?php i18n('old_password');?>
					</label>
					<input placeholder="<?php i18n('type_here');?>" type="password" name="old-password" id="op" minlength="6" autofocus required>

					<label for="np">
						<?php i18n('new_password');?>
					</label>
					<input placeholder="<?php i18n('type_here');?>" type="password" name="new-password" id="np" minlength="6" required>

					<footer>
						<button type="submit" class="btn" name="a" value="change-password">
							<?php i18n('change_password');?>
						</button>
					</footer>
				</form>
			</div>
		</section>


	</main>


<?php require __DIR__ . "/../layout/footer.php";?>