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
					[[invite_member]]
				</h2>
			</div>
		</header>
	</div>


	<section class="container">
		<div class="flex">
			<div class="left">
				<h3>
					[[invite_member]]
				</h3>
				<small>
					[[invite_member_description]]
				</small>
			</div>
			<div class="right">
				<form method="POST" class="form shadow">


					<label for="em">
						[[email]]
					</label>
					<input placeholder="[[type_here]]" type="email" name="email" id="em" autofocus required>


					<label for="na">
						[[name]]
					</label>
					<input placeholder="[[name_example]]" type="text" name="name" id="na" minlength="2" required>


					<footer>
						<button type="submit" class="btn" name="a" value="send-invitation">
							[[invite_new_member]]
						</button>
					</footer>
				</form>
			</div>
		</div>
	</section>

</main>

<?php require __DIR__ . "/../layout/footer.php";?>
