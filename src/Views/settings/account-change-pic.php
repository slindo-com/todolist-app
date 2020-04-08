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
					Change Picture
				</h2>
				<form method="POST" action="/account/" class="button-wrapper">
					<button type="submit" name="a" value="sign-out" class="btn">
						Sign Out
					</button>
				</form>
			</header>
		</section>


		<?php if($error) : ?>
			<section class="container">
				<div class="message error">
					<?php echo e($error); ?>
				</div>				
			</section>
		<?php endif ?>


		<section class="container flex">
			<div class="left">
				<small>
					Please choose an PNG or JPG for your new picture. Drag it on the input or click the input to choose one.
				</small>
			</div>
			<div class="right">

				<form method="POST" enctype="multipart/form-data" class="shadow">
					<label for="pi">
						New Picture:
					</label>
					<input placeholder="Type here…" type="file" name="pic" id="pi" required>

					<footer>
						<button type="submit" class="btn" name="a" value="change-picture">
							Change Picture
						</button>
					</footer>
				</form>
			</div>
		</section>


	</main>


<?php require __DIR__ . "/../layout/footer.php"; ?>