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
					Invite Member
				</h2>
			</header>
		</section>


		<section class="container">
			<div class="flex">
				<div class="left">
					<h3>
						Grow Team
					</h3>
					<small>
						Please provide the data for your new team member. She'll get a invitation to her e-mail address.
					</small>
				</div>
				<div class="right">
					<form method="POST" class="form shadow">


						<label for="em">
							E-Mail Address:
						</label>
						<input placeholder="Type here…" type="email" name="email" id="em" autofocus required>


						<label for="na">
							Name:
						</label>
						<input placeholder="e.g. 'John'" type="text" name="name" id="na" minlength="2" required>


						<footer>
							<button type="submit" class="btn" name="a" value="send-invitation">
								Invite New Member
							</button>
						</footer>
					</form>
				</div>
			</div>
		</section>






		
		
	</main>




<?php require __DIR__ . "/../layout/footer.php"; ?>
