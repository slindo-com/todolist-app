<section class="container">
	<a href="/private/" class="btn back">
		←
		[[back_to_todo_lists]]
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