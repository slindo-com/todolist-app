<?php require __DIR__ . "/../layout/header.php";?>

<main class="full">
	<?php $navItemActive = 'account';require __DIR__ . "/../layout/secondary-nav.php";?>


	<div class="header-wrapper">
		<header class="header">
			<div class="inner">
				<h2>
					<a href="/settings/account/">
						[[account]]
					</a>
					&nbsp;→&nbsp;
					[[change_picture]]
				</h2>
				<form method="POST" action="/account/" class="button-wrapper">
					<button type="submit" name="a" value="sign-out" class="btn">
						[[sign_out]]
					</button>
				</form>
			</div>
		</header>
	</div>


	<?php if ($error): ?>
		<section class="container">
			<div class="message error">
				{{$error}}
			</div>
		</section>
	<?php endif?>


	<section class="container flex">
		<div class="left">
			<small>
				[[change_picture_description]]
			</small>
		</div>
		<div class="right">

			<form method="POST" enctype="multipart/form-data" class="form shadow">
				<label for="pi">
					[[new_picture]]
				</label>
				<input placeholder="[[type_here]]" type="file" name="pic" id="pi" required>

				<footer>
					<button type="submit" class="btn" name="a" value="change-picture">
						[[change_picture]]
					</button>
				</footer>
			</form>
		</div>
	</section>

</main>

<?php require __DIR__ . "/../layout/footer.php";?>