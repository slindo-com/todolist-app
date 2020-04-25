<?php require __DIR__ . "/../layout/header.php";?>

<main class="full">
	<?php $navItemActive = 'general';require __DIR__ . "/../layout/secondary-nav.php";?>


	<div class="header-wrapper">
		<header class="header">
			<div class="inner">
				<h2>
					[[general]]
				</h2>
			</div>
		</header>
	</div>


	<section class="container">
		<div class="flex">
			<div class="left">
				<small>
					[[general_description]]
				</small>
			</div>
			<div class="right">
				<form method="POST" class="form shadow">


					<label for="la">
						[[language]]
					</label>
					<select name="language" id="la" autofocus>
						<option value="de" {{$user->language == 'de' ? 'selected' : ''}}>Deutsch</option>
						<option value="en" {{$user->language == 'en' ? 'selected' : ''}}>English</option>
					</select>


					<footer>
						<span>
							<button type="submit" class="btn" name="a" value="edit-general">
								[[save_general_settings]]
							</button>
						</span>
					</footer>
				</form>
			</div>
		</div>
	</section>

</main>

<?php require __DIR__ . "/../layout/footer.php";?>
