<?php require __DIR__ . "/../layout/header.php"; ?>

<div class="frame">
	<?php require __DIR__ . "/../layout/main-nav.php"; ?>
	<main>
		<?php 
			$navItemActive = 'teams';
			require __DIR__ . "/../layout/secondary-nav.php";
		?>


		<section class="container">
			<header class="header">
				<h2>
					<a href="/settings/teams/">
						Teams
					</a>
					→
					<?php echo $team->title; ?>
				</h2>
				<a href="/settings/teams/<?php echo $team->slug; ?>/edit-title/" class="btn">
					Edit Title
				</a>
				<a href="/settings/teams/<?php echo $team->slug; ?>/invite/" class="btn">
					Invite Member
				</a>
			</header>
		</section>


		<?php if (sizeof($members) == 1 && sizeof($invites) == 0): ?>

			<section class="container">
				<p>
					You are the only member of this team right now. Invite some mates to work together.
				</p>
			</section>

		<?php else: ?>
			<section class="container">

				<ul class="entries">
					<?php foreach ($members AS $member): ?>
						
						<li>
							<div>
								<h4>
									<?php echo (sizeof($member->name) > 1 ? e($member->name) : 'No Name'); ?>
								</h4>
								<small class="published-small">
									<?php echo $member->role == 1 ? 'Admin' : 'Member'; ?>
								</small>
								<small>
									<?php echo e($member->email); ?>
								</small>
							</div>
						</li>

					<?php endforeach; ?>
				</ul>
			</section>
		<?php endif; ?>



		<?php if (sizeof($invites) >= 1): ?>
			<section class="container">

				<ul class="entries">
					<?php foreach ($invites AS $invite): ?>
						
						<li>
							<div>
								<h4>
									<?php echo e($invite->name); ?>
								</h4>
								<small class="published-small">
									Invited
								</small>
								<small>
									<?php echo e($invite->email); ?>
								</small>
							<div>	
						</li>

					<?php endforeach; ?>
				</ul>
			</section>
		<?php endif; ?>


		
	</main>




<?php require __DIR__ . "/../layout/footer.php"; ?>
