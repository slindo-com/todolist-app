<?php require __DIR__ . "/../layout/header.php"; ?>

<div class="frame">
	<?php require __DIR__ . "/../layout/main-nav.php"; ?>
	<main>

		<section class="container">
			<header class="header">
				<h2>
					<a href="/<?php echo $navData['teamSlug']; ?>/<?php echo $navData['listSlug']; ?>/">
						← Back to <?php echo e($navData['list']->title); ?>
					</a>
				</h2>
			</header>
		</section>



		<section class="container">
			<div class="flex">
				<div class="left">
					<h3>
						Update Todo
					</h3>
					<small>
						Lorem Ipsum dolor sit amet set consetetur…
					</small>
				</div>
				<div class="right">
					<form method="POST" class="form shadow">


						<label for="ti">
							Task Title:
						</label>
						<input placeholder="Type here…" type="text" name="title" id="ti" value="<?php echo e($todo->title); ?>" autofocus required>


						<footer>
							<button type="submit" class="btn" name="a" value="update">
								Save Todo Item
							</button>
							<button type="submit" class="btn end red" name="a" value="delete">
								Delete
							</button>
						</footer>
					</form>
				</div>
			</div>
		</section>






		
		
	</main>




<?php require __DIR__ . "/../layout/footer.php"; ?>
