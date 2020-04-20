<?php require __DIR__ . "/../layout/header.php";?>

<div class="frame">
	<?php require __DIR__ . "/../layout/main-nav.php";?>
	<main>

		<div class="header-wrapper">
			<header class="header">
				<div class="inner">
					<a href="#main-navigation" class="toggle-nav">
						☰
					</a>
					<h2>
						<a href="/<?php echo $navData['teamSlug'] . '/' . $navData['listSlug']; ?>/">
							<?php echo e($navData['list']->title); ?>
						</a>
						→
						Edit
					</h2>
				</div>
			</header>
		</div>


		<section class="container">
			<div class="flex">
				<div class="left">
					<h3>
						List Title
					</h3>
					<small>
						Lorem Ipsum dolor sit amet set consetetur…
					</small>
				</div>
				<div class="right">
					<form method="POST" class="form shadow">


						<label for="ti">
							New Title:
						</label>
						<input placeholder="Type here…" type="text" name="title" id="ti" value="<?php echo e($navData['list']->title); ?>" autofocus required maxlength="30">

						<input type="hidden" name="listId" value="<?php echo e($navData['list']->id); ?>">

						<footer>
							<span>
								<button type="submit" class="btn" name="a" value="edit-title">
									Save New Title
								</button>
							</span>
							<button type="submit" class="btn red" name="a" value="trash-list">
								Trash List
							</button>
						</footer>
					</form>
				</div>
			</div>
		</section>








	</main>




<?php require __DIR__ . "/../layout/footer.php";?>
