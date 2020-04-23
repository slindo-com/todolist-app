<?php require __DIR__ . "/../layout/header.php";?>

<?php if ($action == 'DEFAULT'): ?>



	<section class="small-container">
		<h2 class="one-line mb-2">
			<?php i18n('reset_password');?>
		</h2>
		<small class="mb-2">
			<?php i18n('reset_password_description');?>
		</small>

		<?php if (!empty($error)): ?>
			<p class="err">
				<?php e($error);?>
			</p>
		<?php endif;?>

		<form method="POST" class="form shadow">

			<label for="e">
				<?php i18n('email');?>
			</label>
			<input placeholder="<?php i18n('type_here');?>" type="email" name="email" id="e" required autofocus>

			<footer>
				<span>
					<button type="submit" name="a" value="send-instructions" class="btn">
						<?php i18n('send_reset_instructions');?>
					</button>
				</span>
			</footer>

		</form>

		<a href="/sign-in/" class="mt-2 one-line">
			<?php i18n('back_to_sign_in');?>
		</a>
	</section>



<?php elseif ($action == 'TOKEN_SENT'): ?>



	<section class="small-container">
		<h2 class="one-line mb-2">
			<?php i18n('instructions_sent');?>
		</h2>
		<p class="mt-2">
			<?php i18n('instructions_sent_description');?>
		</p>
		<a href="/sign-in/" class="mt-2 one-line">
			<?php i18n('back_to_sign_in');?>
		</a>
	</section>



<?php elseif ($action == 'TOKEN_NOT_VALID'): ?>



	<section class="small-container">
		<h2 class="one-line mb-2">
			<?php i18n('link_not_valid');?>
		</h2>
		<p class="mt-2">
			<?php i18n('link_not_valid_description');?>
		</p>
		<a href="/new-password/" class="mt-2 one-line">
			<?php i18n('request_new_link');?>
		</a>
	</section>



<?php elseif ($action == 'PASSWORD_FORM'): ?>



	<section class="small-container">
		<h2 class="one-line mb-2">
			<?php i18n('set_new_password');?>
		</h2>

		<form method="POST" class="form shadow">

		    <label for="p">
		      <?php i18n('new_password');?>
		    </label>

		    <input placeholder="<?php i18n('type_here');?>" type="password" name="password" id="p" minlength="6" autofocus required>

			<footer>
				<button type="submit" name="a" value="set-password" class="btn">
					<?php i18n('set_new_password');?>
				</button>
			</footer>

		</form>
	</section>



<?php elseif ($action == 'PASSWORD_SET'): ?>



	<section class="small-container">
		<h2 class="one-line mb-2">
			<?php i18n('password_updated');?>
		</h2>
		<p class="mt-2">
			<?php i18n('password_updated_description');?>
		</p>
		<a href="/sign-in/" class="mt-2 one-line">
			<?php i18n('back_to_sign_in');?>
		</a>
	</section>



<?php endif;?>



<?php require __DIR__ . "/../layout/footer.php";?>
