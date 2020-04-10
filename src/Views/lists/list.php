<?php require __DIR__ . "/../layout/header.php"; ?>

<div class="frame">
	<?php require __DIR__ . "/../layout/main-nav.php"; ?>
	<main>

		<section class="container">
			<header class="header">
				<h2>
					<?php echo !empty($navData['list']) ? $navData['list']->title : 'All lists' ?>
				</h2>

				<form method="POST" class="todo-form" autocomplete="off">
					<input type="text" name="todo" placeholder="Type a new Todo here" minlength="1" required<?php echo $newTaskCreated ? ' autofocus' : ''; ?>>
					<div>
						Press Enter to create todo
					</div>
				</form>		
			</header>
		</section>

		<section class="container">
			<ul class="entries tasks">
				<?php foreach ($tasks AS $task): ?>
					<li>
						<span class="checkmark">
							<iframe name="checkmark-<?php echo $task->id; ?>" src="/checkmark/<?php echo $task->id; ?>/" frameborder="0"></iframe>
							<form method="POST" action="/checkmark/<?php echo $task->id; ?>/" target="checkmark-<?php echo $task->id; ?>">
								<button type="submit" name="a" value="toggle"></button>
							</form>
						</span>
						<a href="/<?php echo $navData['teamSlug'] .'/'. $navData['listSlug'] .'/'. $task->id; ?>/">
							<h4>
								<?php echo e($task->title); ?>
							</h4>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>

		</section>


		<!-- <?php var_dump($navData); ?> -->
	
	</main>




<?php require __DIR__ . "/../layout/footer.php"; ?>
