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
						<?php e($team->title);?>
					</h2>
					<a href="/settings/teams/<?php e($team->slug);?>/edit-title/" class="btn">
						<?php i18n('edit_title');?>
					</a>
					<a href="/settings/teams/<?php e($team->slug);?>/invite/" class="btn">
						<?php i18n('invite_member');?>
					</a>
				</div>
			</header>
		</div>


		<?php if (sizeof($members) == 1 && sizeof($invites) == 0): ?>

			<section class="container">
				<p>
					<?php i18n('teams_empty');?>
				</p>
			</section>

		<?php else: ?>
			<section class="container">

				<ul class="entries">
					<?php foreach ($members AS $member): ?>

						<li>
							<div>
								<h4>
									<?php (sizeof($member->name) > 1 ? e($member->name) : i18n('no_name'));?>
								</h4>
								<small class="published-small">
									<?php $member->role == 1 ? i18n('admin') : i18n('member');?>
								</small>
								<small>
									<?php e($member->email);?>
								</small>
							</div>
						</li>

					<?php endforeach;?>
				</ul>
			</section>
		<?php endif;?>



		<?php if (sizeof($invites) >= 1): ?>
			<section class="container">

				<ul class="entries">
					<?php foreach ($invites AS $invite): ?>

						<li>
							<div>
								<h4>
									<?php e($invite->name);?>
								</h4>
								<small class="published-small">
									<?php i18n('invited');?>
								</small>
								<small>
									<?php e($invite->email);?>
								</small>
							<div>
						</li>

					<?php endforeach;?>
				</ul>
			</section>
		<?php endif;?>



	</main>




<?php require __DIR__ . "/../layout/footer.php";?>
