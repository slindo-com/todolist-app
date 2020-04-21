<?php require __DIR__ . "/../layout/header.php";?>


<section class="small-container">
	<h2 class="one-line mb-2">
		<?php i18n('create_new_account');?>
	</h2>

	<?php if (!empty($error)): ?>
		<p class="err">
			<?php e2($error);?>
		</p>
	<?php endif;?>


	<?php if ($hasInvite): ?>
		<p class="mb-2">
			<?php i18n('new_account_with_invite');?>
		</p>
	<?php endif;?>

	<form method="POST" class="form shadow">

		<label for="e">
			<?php i18n('email');?>
		</label>
		<input placeholder="<?php i18n('type_here');?>" type="email" name="email" id="e" required <?php e2($hasInvite ? 'value=' . $inviteEmail . ' disabled' : 'autofocus');?>>

		<label for="p">
			<?php i18n('password');?>
		</label>
		<input placeholder="<?php i18n('password_for_account');?>" type="password" name="password" id="p" minlength="6" required <?php e2($hasInvite ? 'autofocus' : '');?>>

		<footer>
			<span>
				<button type="submit" name="a" value="new-account" class="btn">
					<?php i18n('create_account');?>
				</button>
			</span>
			<a href="/sign-in/">
				<?php i18n('back_to_sign_in');?>
			</a>
		</footer>
	</form>
</section>



<?php require __DIR__ . "/../layout/footer.php";?>
