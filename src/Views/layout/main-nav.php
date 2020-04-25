<nav class="main-nav" id="main-navigation">
	<header>
		<a href="#team-select" class="team-select">
			<small>
				[[team]]
			</small>
			<?php !empty($navData['team']) ? e($navData['team']->title) : i18n('private')?>
		</a>
		<a href="/settings/" class="settings" accesskey="s">
			[[settings]]
		</a>
	</header>
	<div>
		<?php foreach ($navData['lists'] AS $list): ?>
			<a href="/<?php e($navData['teamSlug']);?>/<?php e($list->slug);?>/"<?php e(!empty($navData['listSlug']) && $navData['listSlug'] == $list->slug ? ' class="active"' : '');?>>
				<?php e($list->title);?>
				<span>
					<?php e($list->task_count - $list->done_count)?>
				</span>
			</a>
		<?php endforeach;?>
	</div>
	<form method="POST" action="/{{$navData['teamSlug']}}/" class="new-list-wrapper">
		<button type="submit" name="a" value="new-list">
			[[add_new_list]]
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
			[[private]]
		</a>
		<?php foreach ($navData['teams'] AS $team): ?>
			<a href="/<?php e($team->slug)?>/">
				<?php e($team->title)?>
			</a>
		<?php endforeach;?>
	</nav>
</div>