<?php require __DIR__ . "/../layout/header.php";?>

<div class="frame">
	<main class="full">
		<?php $navItemActive = 'general';require __DIR__ . "/../layout/secondary-nav.php";?>


		<div class="header-wrapper">
			<header class="header">
				<div class="inner">
					<h2>
						<?php i18n('general');?>
					</h2>
				</div>
			</header>
		</div>


		<section class="container">
			<div class="flex">
				<div class="left">
					<small>
						<?php i18n('general_description');?>
					</small>
				</div>
				<div class="right">
					<form method="POST" class="form shadow">


						<label for="la">
							<?php i18n('language');?>
						</label>
						<select name="language" id="la" autofocus>
							<option value="de" <?php echo ($user->language == 'de') ? 'selected' : ''; ?>>Deutsch</option>
							<option value="en" <?php echo ($user->language == 'en') ? 'selected' : ''; ?>>English</option>
						</select>


						<footer>
							<span>
								<button type="submit" class="btn" name="a" value="edit-general">
									<?php i18n('save_general_settings');?>
								</button>
							</span>
						</footer>
					</form>
				</div>
			</div>
		</section>



	</main>




<?php require __DIR__ . "/../layout/footer.php";?>
