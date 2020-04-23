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
						<a href="/settings/teams/<?php e($team->slug);?>/">
							<?php e($team->title);?>
						</a>
						→
						<?php i18n('edit_title');?>
					</h2>
				</a>
			</header>
		</div>


		<section class="container">
			<div class="flex">
				<div class="left">
					<h3>
						<?php i18n('team_title');?>
					</h3>
					<small>
						<?php i18n('team_title_description');?>
					</small>
				</div>
				<div class="right">
					<form method="POST" class="form shadow">


						<label for="ti">
							<?php i18n('new_title');?>
						</label>
						<input placeholder="<?php i18n('type_here');?>" type="text" name="title" id="ti" value="<?php e($team->title);?>" autofocus required>


						<footer>
							<button type="submit" class="btn" name="a" value="edit-title">
								<?php i18n('save_new_title');?>
							</button>
						</footer>
					</form>
				</div>
			</div>
		</section>








	</main>




<?php require __DIR__ . "/../layout/footer.php";?>
