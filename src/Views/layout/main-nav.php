<nav class="main-nav" id="main-navigation">
	<header>
		<a href="#team-select" class="team-select">
			<small>
				<?php i18n('team');?>
			</small>
			<?php echo !empty($navData['team']) ? e($navData['team']->title) : 'Private' ?>
		</a>
		<a href="/settings/" class="settings">
			<?php i18n('settings');?>
		</a>
	</header>
	<div>
		<?php foreach ($navData['lists'] AS $list): ?>
			<a href="/<?php echo e($navData['teamSlug']); ?>/<?php echo e($list->slug); ?>/"<?php echo !empty($navData['listSlug']) && $navData['listSlug'] == $list->slug ? ' class="active"' : '' ?>>
				<?php echo e($list->title); ?>
				<span>
					<?php echo e($list->task_count - $list->done_count) ?>
				</span>
			</a>
		<?php endforeach;?>
	</div>
	<form method="POST" action="/<?php echo e($navData['teamSlug']); ?>/" class="new-list-wrapper">
		<button type="submit" name="a" value="new-list">
			<?php i18n('add_new_list');?>
		</button>
	</form>
	<a href="#" class="shadow">
	</a>
</nav>


<div class="team-select-overlay" id="team-select">
	<a href="#">
	</a>
	<nav>
		<a href="/private/">
			<?php i18n('private');?>
		</a>
		<?php foreach ($navData['teams'] AS $team): ?>
			<a href="/<?php echo e($team->slug) ?>/">
				<?php echo e($team->title) ?>
			</a>
		<?php endforeach;?>
	</nav>
</div>