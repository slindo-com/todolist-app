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
						<?php i18n('change_email');?>
					</h2>
					<form method="POST" action="/account/" class="button-wrapper">
						<button type="submit" name="a" value="sign-out" class="btn">
							<?php i18n('sign_out');?>
						</button>
					</form>
				</div>
			</header>
		</div>


		<section class="container flex">
			<div class="left">
				<small>
					<?php i18n('change_email_description');?>
				</small>
			</div>
			<div class="right">


				<form method="POST" class="form shadow">
					<label for="em">
						<?php i18n('new_email');?>
					</label>
					<input placeholder="Type here…" type="email" name="email" id="em" autofocus required>

					<footer>
						<button type="submit" class="btn" name="a" value="change-email">
							<?php i18n('change_email_address');?>
						</button>
					</footer>
				</form>
			</div>
		</section>


	</main>


<?php require __DIR__ . "/../layout/footer.php";?>