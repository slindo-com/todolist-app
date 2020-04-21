<section class="container">
	<a href="/private/" class="btn back">
		←
		<?php i18n('back_to_todo_lists');?>
	</a>

	<nav class="secondary-nav">
		<a href="/settings/"<?php echo ($navItemActive == 'general') ? 'class="active"' : ''; ?>>
			<?php i18n('general');?>
		</a>
		<a href="/settings/teams/"<?php echo ($navItemActive == 'teams') ? 'class="active"' : ''; ?>>
			<?php i18n('teams');?>
		</a>
		<a href="/settings/account/"<?php echo ($navItemActive == 'account') ? 'class="active"' : ''; ?>>
			<?php i18n('account');?>
		</a>
	</nav>
</section>