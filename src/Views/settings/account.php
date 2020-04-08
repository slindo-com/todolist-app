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



		<?php if($success) : ?>
			<section class="container">
				<div class="message">
					<?php
						switch ($success) {
							case 'change-name': echo 'Your name was updated successfully!'; break;
							case 'change-email': echo 'Please confirm your new email address!'; break;
							case 'change-email-success': echo 'Your email address was updated successfully!'; break;
							case 'change-name': echo 'Your password was changed successfully!'; break;
							case 'change-pic': echo 'Your picture was changed successfully!'; break;
						}
					?>
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
					<?php if(!empty($user->pic)): ?>
						<figure class="pic">
							<img src="/pics/<?php echo $user->pic; ?>" alt="Profile Picture" />
						</figure>
					<?php endif; ?>

					<p>
						<strong>
							E-Mail: &nbsp;
						</strong>
						<?php echo e($user->email); ?>
					</p>
					<a href="/settings/account/change-email/">
						Change E-Mail
					</a>
					&nbsp;
					<a href="/settings/account/change-password/">
						Change Password
					</a>
					&nbsp;
					<a href="/settings/account/change-pic/">
						Change Picture
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
