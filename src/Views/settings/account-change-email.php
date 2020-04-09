<?php require __DIR__ . "/../layout/header.php"; ?>


<div class="frame">
	<?php require __DIR__ . "/../layout/main-nav.php"; ?>
	<main>
		<?php 
			$navItemActive = 'account';
			require __DIR__ . "/../layout/secondary-nav.php";
		?>


		<section class="container">
			<header class="header">
				<h2>
					<a href="/settings/account/">
						Account
					</a>
					→
					Change E-Mail
				</h2>
				<form method="POST" action="/account/" class="button-wrapper">
					<button type="submit" name="a" value="sign-out" class="btn">
						Sign Out
					</button>
				</form>
			</header>
		</section>


		<section class="container flex">
			<div class="left">
				<small>
					Please provide your new email address. You'll get a email with a confirmation link to this address.
				</small>
			</div>
			<div class="right">


				<form method="POST" class="form shadow">
					<label for="em">
						New E-Mail:
					</label>
					<input placeholder="Type here…" type="email" name="email" id="em" autofocus required>

					<footer>
						<button type="submit" class="btn" name="a" value="change-email">
							Change E-mail Address
						</button>
					</footer>
				</form>
			</div>
		</section>


	</main>


<?php require __DIR__ . "/../layout/footer.php"; ?>