<?php require __DIR__ . "/../layout/header.php";?>

<main class="full">
	<?php $navItemActive = 'teams';require __DIR__ . "/../layout/secondary-nav.php";?>


	<div class="header-wrapper">
		<header class="header">
			<div class="inner">
				<h2>
					<a href="/settings/teams/">
						[[teams]]
					</a>
					&nbsp;→&nbsp;
					<a href="/settings/teams/{{$team->slug}}/">
						{{$team->title}}
					</a>
					&nbsp;→&nbsp;
					[[edit_title]]
				</h2>
			</a>
		</header>
	</div>


	<section class="container">
		<div class="flex">
			<div class="left">
				<h3>
					[[team_title]]
				</h3>
				<small>
					[[team_title_description]]
				</small>
			</div>
			<div class="right">
				<form method="POST" class="form shadow">


					<label for="ti">
						[[new_title]]
					</label>
					<input placeholder="[[type_here]]" type="text" name="title" id="ti" value="{{$team->title}}" autofocus required>


					<footer>
						<button type="submit" class="btn" name="a" value="edit-title">
							[[save_new_title]]
						</button>
					</footer>
				</form>
			</div>
		</div>
	</section>

</main>

<?php require __DIR__ . "/../layout/footer.php";?>
