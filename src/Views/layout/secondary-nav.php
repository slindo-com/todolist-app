<section class="container secondary-nav-wrapper">
	<a href="/private/" class="btn back">
		←
		<span>
			&nbsp;
			[[back_to_todo_lists]]
		</span>
	</a>

	<nav class="secondary-nav">
		<a href="/settings/"<?php echo $navItemActive == 'general' ? ' class="active"' : ''; ?>>
			[[general]]
		</a>
		<a href="/settings/teams/"<?php echo $navItemActive == 'teams' ? ' class="active"' : ''; ?>>
			[[teams]]
		</a>
		<a href="/settings/account/"<?php echo $navItemActive == 'account' ? ' class="active"' : ''; ?>>
			[[account]]
		</a>
	</nav>
</section>