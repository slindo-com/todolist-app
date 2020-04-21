<?php require __DIR__ . "/../layout/header.php";?>

<div class="frame">
	<main class="full">
		<?php $navItemActive = 'teams';require __DIR__ . "/../layout/secondary-nav.php";?>


		<div class="header-wrapper">
			<header class="header">
				<div class="inner">
					<h2>
						<a href="/settings/teams/">
							<?php i18n('teams');?>
						</a>
						→
						<a href="/settings/teams/<?php echo $team->slug; ?>/">
							<?php echo $team->title; ?>
						</a>
						→
						<?php i18n('invite_member');?>
					</h2>
				</div>
			</header>
		</section>


		<section class="container">
			<div class="flex">
				<div class="left">
					<h3>
						<?php i18n('invite_member');?>
					</h3>
					<small>
						<?php i18n('invite_member_description');?>
					</small>
				</div>
				<div class="right">
					<form method="POST" class="form shadow">


						<label for="em">
							<?php i18n('email');?>
						</label>
						<input placeholder="<?php i18n('type_here');?>" type="email" name="email" id="em" autofocus required>


						<label for="na">
							<?php i18n('name');?>
						</label>
						<input placeholder="<?php i18n('name_example');?>" type="text" name="name" id="na" minlength="2" required>


						<footer>
							<button type="submit" class="btn" name="a" value="send-invitation">
								<?php i18n('invite_new_member');?>
							</button>
						</footer>
					</form>
				</div>
			</div>
		</section>








	</main>




<?php require __DIR__ . "/../layout/footer.php";?>
