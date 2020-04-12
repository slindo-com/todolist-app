<?php require __DIR__ . "/../layout/header.php";?>


<div class="frame">
	<main class="full">
		<?php $navItemActive = 'account';require __DIR__ . "/../layout/secondary-nav.php";?>


		<section class="container">
			<header class="header">
				<h2>
					<a href="/settings/account/">
						Account
					</a>
					→
					Change Password
				</h2>
				<form method="POST" action="/account/" class="button-wrapper">
					<button type="submit" name="a" value="sign-out" class="btn">
						Sign Out
					</button>
				</form>
			</header>
		</section>


		<?php if ($error): ?>
			<section class="container">
				<div class="message error">
					<?php echo e($error); ?>
				</div>
			</section>
		<?php endif?>


		<section class="container flex">
			<div class="left">
				<small>
					Please provide your old and new password.
				</small>
			</div>
			<div class="right">

				<form method="POST" class="form shadow">
					<label for="op">
						Old Password:
					</label>
					<input placeholder="Type here…" type="password" name="old-password" id="op" minlength="6" autofocus required>

					<label for="np">
						New Password:
					</label>
					<input placeholder="Type here…" type="password" name="new-password" id="np" minlength="6" required>

					<footer>
						<button type="submit" class="btn" name="a" value="change-password">
							Change Password
						</button>
					</footer>
				</form>
			</div>
		</section>


	</main>


<?php require __DIR__ . "/../layout/footer.php";?>