<?php require __DIR__ . "/../layout/header.php";?>
<?php require __DIR__ . "/../layout/main-nav.php";?>
<main>

	<div class="header-wrapper">
		<header class="header">
			<div class="inner for-todo-form">
				<a href="#main-navigation" class="toggle-nav">
					☰
				</a>
				<h2>
					New Team
				</h2>
			</div>
		</header>
	</div>

	<section class="container">
		<div class="empty-box">
			<span>

				<h3 class="mb-2">
					[[a_new_team]]
				</h3>
				<p>
					<form method="POST" action="/{{$navData['teamSlug']}}/">
						<button type="submit" name="a" value="new-list">
							[[create_a_first_list]]
						</button>
					</form>
					&nbsp;
					[[to_get_this_started]]
				</p>
				<p>
					<a href="https://todolist.one/help/" taget="_blank">
						[[go_to_our_help_section]]
					</a>&nbsp;
					[[if_app_is_unclear]]
				</p>
			</span>
		</div>
	</section>

</main>

<?php require __DIR__ . "/../layout/footer.php";?>
