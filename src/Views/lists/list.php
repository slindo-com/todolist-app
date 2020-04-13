<?php require __DIR__ . "/../layout/header.php";?>

<div class="frame">
	<?php require __DIR__ . "/../layout/main-nav.php";?>
	<main>

		<section class="container">
			<header class="header">
				<h2>
					<?php echo !empty($navData['list']) ? $navData['list']->title : 'All lists' ?>
					<a href="/<?php echo $navData['teamSlug'] . '/' . $navData['listSlug']; ?>/edit/" class="link">
						Edit
					</a>
				</h2>

				<form method="POST" class="todo-form" autocomplete="off">
					<input type="text" name="todo" placeholder="Type a new Todo here" minlength="1" required<?php echo !empty($newTaskCreated) ? ' autofocus' : ''; ?>>
					<div>
						Press Enter to create todo
					</div>
				</form>
			</header>
		</section>

		<?php if (!empty($tasksUndone) && sizeof($tasksUndone) >= 1): ?>
			<section class="container">
				<ul class="entries tasks">
					<?php foreach ($tasksUndone AS $task): ?>

						<li>
							<span class="checkmark">
								<iframe name="checkmark-<?php echo $task->id; ?>" src="/checkmark/<?php echo $task->id; ?>/" frameborder="0"></iframe>
								<form method="POST" action="/checkmark/<?php echo $task->id; ?>/" target="checkmark-<?php echo $task->id; ?>">
									<button type="submit" name="a" value="toggle"></button>
								</form>
							</span>
							<a href="/<?php echo $navData['teamSlug'] . '/' . $navData['listSlug'] . '/' . $task->id; ?>/">
								<h4>
									<?php echo e($task->title); ?>
								</h4>
							</a>
							<form method="POST" class="important-toggle <?php echo $task->important ? 'important' : ''; ?>">
								<input type="hidden" name="taskId" value="<?php echo $task->id; ?>">
								<button type="submit" name="a" value="<?php echo $task->important ? 'make-unimportant' : 'make-important'; ?>">
									☆
								</button>
							</form>
						</li>

					<?php endforeach;?>
				</ul>
			</section>
		<?php endif;?>


		<?php if (!empty($showDone) && !empty($tasksDone) && sizeof($tasksDone) >= 1): ?>
			<section class="container">
				<ul class="entries tasks">
					<?php foreach ($tasksDone AS $task): ?>

						<li>
							<span class="checkmark">
								<iframe name="checkmark-<?php echo $task->id; ?>" src="/checkmark/<?php echo $task->id; ?>/" frameborder="0"></iframe>
								<form method="POST" action="/checkmark/<?php echo $task->id; ?>/" target="checkmark-<?php echo $task->id; ?>">
									<button type="submit" name="a" value="toggle"></button>
								</form>
							</span>
							<a href="/<?php echo $navData['teamSlug'] . '/' . $navData['listSlug'] . '/' . $task->id; ?>/">
								<h4>
									<?php echo e($task->title); ?>
								</h4>
							</a>
						</li>

					<?php endforeach;?>
				</ul>
			</section>
		<?php else: ?>
			<?php if (!empty($tasksDone) && sizeof($tasksDone) >= 1): ?>
				<section class="container center">
					<a href="/<?php echo $navData['teamSlug'] . '/' . $navData['listSlug']; ?>/show-done/">
						Show <?php echo e(sizeof($tasksDone)); ?> done todos
					</a>
				</section>
			<?php endif;?>
		<?php endif;?>

	</main>




<?php require __DIR__ . "/../layout/footer.php";?>
