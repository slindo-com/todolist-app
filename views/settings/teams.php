<?php require __DIR__ . "/../layout/header.php"; ?>

<div class="frame">
	<?php require __DIR__ . "/../layout/main-nav.php"; ?>
	<main>
		<?php 
			$navItemActive = 'teams';
			require __DIR__ . "/../layout/secondary-nav.php";
		?>


		<section class="container">
			<header class="header">
				<h2>
					Teams
				</h2>
				<form method="POST" class="button-wrapper">
					<button type="submit" name="a" value="new-team" class="btn">
						New Team
					</button>
				</form>
			</header>
		</section>

		<section class="container">
			<p>
				You work on your own right now. If you want to create a team, please press the button above.
			</p>
		</section>

		
	</main>




<?php require __DIR__ . "/../layout/footer.php"; ?>
