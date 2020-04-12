<nav class="main-nav">
	<h4>
		Own
	</h4>
	<?php foreach ($navData['lists'] AS $list): ?>
		<a href="/<?php echo e($navData['teamSlug']); ?>/<?php echo e($list->slug); ?>/"<?php echo $list->slug == $navData['listSlug'] ? ' class="active"' : '' ?>>
			<?php echo e($list->title); ?>
			<span>
				<?php echo e($list->task_count - $list->done_count) ?>
			</span>
		</a>
	<?php endforeach;?>

	<a href="/settings/" class="settings">
		Settings
	</a>
</nav>