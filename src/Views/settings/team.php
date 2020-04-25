<?php require __DIR__ . "/../layout/header.php";?>

<main class="full">
	<?php $navItemActive = 'teams';require __DIR__ . "/../layout/secondary-nav.php";?>

	<div class="header-wrapper">
		<header class="header">
			<div class="inner">
				<h2>
					<a href="/settings/teams/">
						[[teams]]
					</a>
					&nbsp;→&nbsp;
					{{$team->title}}
				</h2>
				<div class="button-wrapper">
					<a href="/settings/teams/{{$team->slug}}/edit-title/" class="btn">
						[[edit_title]]
					</a>
					<a href="/settings/teams/{{$team->slug}}/invite/" class="btn">
						[[invite_member]]
					</a>
				</div>
			</div>
		</header>
	</div>


	<?php if (sizeof($members) == 1 && sizeof($invites) == 0): ?>

		<section class="container">
			<p>
				[[teams_empty]]
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
								{{$member->email}}
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
								{{$invite->name}}
							</h4>
							<small class="published-small">
								[[invited]]
							</small>
							<small>
								{{$invite->email}}
							</small>
						<div>
					</li>

				<?php endforeach;?>
			</ul>
		</section>
	<?php endif;?>

</main>

<?php require __DIR__ . "/../layout/footer.php";?>
