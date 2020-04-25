<?php require __DIR__ . "/../layout/header.php";?>

<main class="full">
	<?php $navItemActive = 'teams';require __DIR__ . "/../layout/secondary-nav.php";?>


	<div class="header-wrapper">
		<header class="header">
			<div class="inner">
				<h2>
					[[teams]]
				</h2>
				<form method="POST" class="button-wrapper">
					<button type="submit" name="a" value="new-team" class="btn">
						[[new_team]]
					</button>
				</form>
			</div>
		</header>
	</div>

	<?php if (!empty($invitingTeam)): ?>
		<section class="container">
			<div class="box">
				<p>
					[[you_are_invited]]
					"<strong>
						{{$invitingTeam->title}}
					</strong>"
					[[do_you_want_to_join]]
				</p>
				<form method="POST">
					<input type="hidden" name="inviteId" value="{{$invite->id}}">
					<button type="submit" name="a" value="join-team" class="btn">
						[[join_team]]
					</button>
					<button type="submit" name="a" value="decline-invitation" class="btn">
						[[decline_invitation]]
					</button>
				</form>
			</div>

		</section>
	<?php endif;?>


	<?php if (sizeof($teams) == 0 && empty($invitingTeam)): ?>

		<section class="container">
			<p>
				[[teams_empty]]
			</p>
		</section>

	<?php else: ?>
		<section class="container">
			<ul class="entries">
				<?php foreach ($teams AS $team): ?>

					<li>
						<a href="/settings/teams/{{$team->slug}}/">
							<h4>
								{{$team->title}}
							</h4>
							<small>
								<?php $team->role == 1 ? i18n('admin') : i18n('member');?>
							</small>
							<small>
								{{$memberCounts[$team->id] . ' '}}
								<?php ($memberCounts[$team->id] == 1 ? i18n('member') : i18n('members'));?>
							</small>
						</a>
					</li>

				<?php endforeach;?>
			</ul>
		</section>
	<?php endif;?>

</main>

<?php require __DIR__ . "/../layout/footer.php";?>
