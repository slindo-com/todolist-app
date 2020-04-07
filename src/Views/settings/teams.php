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
					Teams
				</h2>
				<form method="POST" class="button-wrapper">
					<button type="submit" name="a" value="new-team" class="btn">
						New Team
					</button>
				</form>
			</header>
		</section>

		<?php if (!empty($invitingTeam)): ?>
			<section class="container">
				<div class="box">
					<p>
						You are invited to a team called "<strong><?php echo e($invitingTeam->title); ?></strong>". Do you want to join this team?
					</p>
					<form method="POST">
						<input type="hidden" name="inviteId" value="<?php echo $invite->id; ?>">
						<button type="submit" name="a" value="join-team" class="btn">
							Join Team
						</button>
						<button type="submit" name="a" value="decline-invitation" class="btn">
							Decline Invitation
						</button>
					</form>
				</div>
		
			</section>
		<?php endif; ?>


		<?php if (sizeof($teams) == 0 && empty($invitingTeam)): ?>

			<section class="container">
				<p>
					You work on your own right now. If you want to create a team, please press the button above.
				</p>
			</section>

		<?php else: ?>
			<section class="container">
				<ul class="entries">
					<?php foreach ($teams AS $team): ?>
						
						<li>
							<a href="/settings/teams/<?php echo e($team->slug); ?>/">
								<h4>
									<?php echo e($team->title); ?>
								</h4>
								<small class="published-small">
									<?php echo $team->role == 1 ? 'Admin' : 'Member'; ?>
								</small>
								<small>
									<?php 
										echo $memberCounts[$team->id] . ($memberCounts[$team->id] == 1 ? ' Member' : ' Members');
									?>
								</small>
							</a>	
						</li>

					<?php endforeach; ?>
				</ul>
			</section>
		<?php endif; ?>

		
	</main>




<?php require __DIR__ . "/../layout/footer.php"; ?>
