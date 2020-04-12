<section class="container">
	<a href="/private/" class="btn back">
		← Back to todo lists
	</a>

	<nav class="secondary-nav">
		<a href="/settings/"<?php echo ($navItemActive == 'general') ? 'class="active"' : ''; ?>>
			General
		</a>
		<a href="/settings/teams/"<?php echo ($navItemActive == 'teams') ? 'class="active"' : ''; ?>>
			Teams
		</a>
		<a href="/settings/account/"<?php echo ($navItemActive == 'account') ? 'class="active"' : ''; ?>>
			Account
		</a>
	</nav>
</section>