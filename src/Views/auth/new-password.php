<?php require __DIR__ . "/../layout/header.php";?>

<?php if ($action == 'DEFAULT'): ?>



	<section class="small-container">
		<h2>
			Reset Password
		</h2>
		<small class="mb-4">
			Provide your email address below and we will send you instructions on how to reset your password.
		</small>

		<?php if (!empty($error)): ?>
			<p class="err">
				Something went wrong.
			</p>
		<?php endif;?>

		<form method="POST" class="form shadow">

			<label for="e">
				E-Mail:
			</label>
			<input placeholder="Type here…" type="email" name="email" id="e" required autofocus>

			<footer>
				<button type="submit" name="a" value="send-instructions" class="btn">
					Send Reset Instructions
				</button>
				<span>
					or
					<a href="/sign-in/">
						sign in to account
					</a>
				</span>
			</footer>

		</form>
	</section>



<?php elseif ($action == 'TOKEN_SENT'): ?>



	<section class="small-container">
		<h2>
			Instructions sent!
		</h2>
		<p class="mt-2">
			We have emailed you a link to reset your password. Don't forget to check your spam folder.
		</p>
		<a href="/sign-in/" class="mt-2">
			Back to sign in
		</a>
	</section>



<?php elseif ($action == 'TOKEN_NOT_VALID'): ?>



	<section class="small-container">
		<h2>
			Your link is not valid
		</h2>
		<p class="mt-2">
			Your link seems to be expired or unvalid. Please request a new link:
		</p>
		<a href="/new-password/" class="mt-2">
			Request new link
		</a>
	</section>



<?php elseif ($action == 'PASSWORD_FORM'): ?>



	<section class="small-container">
		<h2 class="mb-2">
			Set New Password
		</h2>

		<form method="POST" class="form shadow">

		    <label for="p">
		      New Password:
		    </label>

		    <input placeholder="Type here…" type="password" name="password" id="p" minlength="6" autofocus required>

			<footer>
				<button type="submit" name="a" value="set-password" class="btn">
					Set New Password
				</button>
			</footer>

		</form>
	</section>



<?php elseif ($action == 'PASSWORD_SET'): ?>



	<section class="small-container">
		<h2>
			Password Updated
		</h2>
		<p class="mt-2">
			Your password is updated now. Please go to the Sign In and try again.
		</p>
		<a href="/sign-in/" class="mt-2">
			Back to sign in
		</a>
	</section>



<?php endif;?>



<?php require __DIR__ . "/../layout/footer.php";?>
