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
					Account
				</h2>
				<form method="POST" class="button-wrapper">
					<button type="submit" name="a" value="sign-out" class="btn">
						Sign Out
					</button>
				</form>
			</header>
		</section>



		<?php if($updateNameSuccess) : ?>
			<section class="container">
				<div class="message">
					Your name was updated successfully!
				</div>				
			</section>
		<?php endif ?>

		<?php if($success && $success == 'change-email') : ?>
			<section class="container">
				<div class="message">
					Please confirm your new email address!
				</div>				
			</section>
		<?php endif ?>

		<?php if($success && $success == 'change-email-success') : ?>
			<section class="container">
				<div class="message">
					You email address was updated successfully!
				</div>				
			</section>
		<?php endif ?>



		<section class="container flex">
			<div class="left">
				<small>
					Basic account settings
				</small>
			</div>
			<div class="right">



				<div class="box">
					<p>
						<strong>
							E-Mail:
						</strong>
						<?php echo e($user->email); ?>
					</p>
					<a href="/settings/account/change-email/" class="btn">
						Change E-Mail Address
					</a>
					<a href="/settings/account/change-password/" class="btn">
						Change Password
					</a>
				</div>



				<form method="POST" class="shadow">
					<label for="na">
						Your Name:
					</label>
					<input placeholder="Type here…" type="text" name="name" id="na" value="<?php echo e(!empty($user->name) ? $user->name : ''); ?>">

					<footer>
						<button type="submit" class="btn" name="a" value="save-name">
							Save Name
						</button>
					</footer>
				</form>
			</div>
		</section>



	</main>




<?php require __DIR__ . "/../layout/footer.php"; ?>
