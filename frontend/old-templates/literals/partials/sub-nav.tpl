<nav class="subnav container">

	<a href="/settings/" ${d.subview === 'general' ? ` class="active"` : ``}>
		General
	</a>
	<a href="/settings/team/" ${d.subview === 'team' ? ` class="active"` : ``}>
		Team
	</a>
	<a href="/settings/account/"${d.subview === 'account' ? ` class="active"` : ``}>
		Account
	</a>

</nav>