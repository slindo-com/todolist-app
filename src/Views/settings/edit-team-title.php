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
					<a href="/settings/teams/">
						Teams
					</a>
					→
					<a href="/settings/teams/<?php echo $team->slug; ?>/">
						<?php echo $team->title; ?>
					</a>
					→
					Edit Title
				</h2>
			</header>
		</section>


		<section class="container">
			<div class="flex">
				<div class="left">
					<h3>
						Team Title
					</h3>
					<small>
						Lorem Ipsum dolor sit amet set consetetur…
					</small>
				</div>
				<div class="right">
					<form method="POST" class="shadow">


						<label for="ti">
							New Title:
						</label>
						<input placeholder="Type here…" type="text" name="title" id="ti" value="<?php echo e($team->title); ?>" autofocus required>


						<footer>
							<button type="submit" class="btn" name="a" value="edit-title">
								Save New Title
							</button>
						</footer>
					</form>
				</div>
			</div>
		</section>






		
		
	</main>




<?php require __DIR__ . "/../layout/footer.php"; ?>
