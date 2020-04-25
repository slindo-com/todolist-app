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
			<a href="/{{$navData['teamSlug']}}/{{$list->slug}}/"<?php echo !empty($navData['listSlug']) && $navData['listSlug'] == $list->slug ? ' class="active"' : ''; ?>>
				{{$list->title}}
				<span>
					{{$list->task_count - $list->done_count}}
				</span>
			</a>
		<?php endforeach;?>
		<?php if (sizeof($navData['lists']) == 0): ?>
			<small>
					[[team_without_lists]]
			</small>
		<?php endif;?>
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
			<a href="/{{$team->slug}}/">
				{{$team->title}}
			</a>
		<?php endforeach;?>
	</nav>
</div>