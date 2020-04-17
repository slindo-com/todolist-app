<?php require __DIR__ . "/../layout/header.php";?>


<section class="small-container">
	<h2 class="one-line mb-2">
		<?php i18n('sign_in'); ?>
	</h2>

	<?php if (!empty($error)): ?>
		<p class="err">
			<?php e2($error); ?>
		</p>
	<?php endif;?>

	<form method="POST" class="form shadow">

		<label for="e">
			<?php i18n('email'); ?>
		</label>
		<input placeholder="<?php i18n('type_here'); ?>" type="email" name="email" id="e" required autofocus>

		<label for="p">
			<?php i18n('password'); ?>
		</label>
		<input placeholder="<?php i18n('password_for_account'); ?>" type="password" name="password" id="p" minlength="6" required>

		<footer>
			<span>
				<button type="submit" name="a" value="sign-in" class="btn">
					<?php i18n('sign_in'); ?>
				</button>
			</span>
			<a href="/new-account/">
				<?php i18n('create_new_account'); ?>
			</a>
		</footer>

	</form>

	<a href="/new-password/" class="mt-2 one-line">
		<?php i18n('get_a_new_password'); ?>
	</a>

</section>



<?php require __DIR__ . "/../layout/footer.php";?>
