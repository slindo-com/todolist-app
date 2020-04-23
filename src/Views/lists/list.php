<?php require __DIR__ . "/../layout/header.php";?>

<div class="frame">
	<?php require __DIR__ . "/../layout/main-nav.php";?>
	<main>

		<div class="header-wrapper">
			<header class="header">
				<div class="inner for-todo-form">
					<a href="#main-navigation" class="toggle-nav">
						☰
					</a>
					<h2>
						<?php e(!empty($navData['list']) ? $navData['list']->title : 'All lists')?>
						<a href="/<?php e($navData['teamSlug'] . '/' . $navData['listSlug']);?>/edit/" class="link">
							<?php i18n('edit');?>
						</a>
					</h2>
				</div>

				<form method="POST" class="todo-form" autocomplete="off">
					<input type="text" name="todo" placeholder="Type a new Todo here" minlength="1" required<?php e(!empty($newTaskCreated) ? ' autofocus' : '');?>>
					<div>
						<?php i18n('press_enter_to_create_todo');?>
					</div>
				</form>
			</header>
		</div>

		<?php if (!empty($tasksUndone) && sizeof($tasksUndone) >= 1): ?>
			<section class="container">
				<ul class="entries tasks">
					<?php foreach ($tasksUndone AS $task): ?>

						<li>
							<span class="checkmark">
								<iframe name="checkmark-<?php e($task->id);?>" src="/checkmark/<?php e($task->id);?>/" frameborder="0"></iframe>
								<form method="POST" action="/checkmark/<?php e($task->id);?>/" target="checkmark-<?php e($task->id);?>">
									<button type="submit" name="a" value="toggle"></button>
								</form>
							</span>
							<a href="/<?php e($navData['teamSlug'] . '/' . $navData['listSlug'] . '/' . $task->id);?>/">
								<h4>
									<?php e($task->title);?>
								</h4>
							</a>
							<form method="POST" class="important-toggle <?php e($task->important ? 'important' : '');?>">
								<input type="hidden" name="taskId" value="<?php e($task->id);?>">
								<button type="submit" name="a" value="<?php e($task->important ? 'make-unimportant' : 'make-important');?>">
									☆
								</button>
							</form>
						</li>

					<?php endforeach;?>
				</ul>
			</section>
		<?php elseif (empty($showDone)): ?>
			<section class="container">
				<div class="empty-box">
					<span>

						<?php if (!empty($tasksDone) && sizeof($tasksDone) >= 1): ?>
							<h3 class="mb-2">
								<?php i18n('everything_is_done');?>
							</h3>
							<p>
								<?php i18n('you_could_either');?>
								<a href="/<?php e($navData['teamSlug'] . '/' . $navData['listSlug']);?>/edit/">
									<?php i18n('go_to_the_edit_section');?>
								</a>
								<?php i18n('and_trash_this');?>
							</p>
						<?php else: ?>
							<h3 class="mb-2">
								<?php i18n('your_list_is_empty');?>
							</h3>
							<p>
								<?php i18n('lets_create_a_new_task');?>
							</p>
						<?php endif;?>
						<p>
							<a href="https://todolist.one/help/" taget="_blank">
								<?php i18n('go_to_our_help_section');?>
							</a>
							<?php i18n('if_app_is_unclear');?>
						</p>
					</span>
				</div>
			</section>
		<?php endif;?>


		<?php if (!empty($showDone) && !empty($tasksDone) && sizeof($tasksDone) >= 1): ?>
			<section class="container">
				<ul class="entries tasks">
					<?php foreach ($tasksDone AS $task): ?>

						<li>
							<span class="checkmark">
								<iframe name="checkmark-<?php e($task->id);?>" src="/checkmark/<?php e($task->id);?>/" frameborder="0"></iframe>
								<form method="POST" action="/checkmark/<?php e($task->id);?>/" target="checkmark-<?php e($task->id);?>">
									<button type="submit" name="a" value="toggle"></button>
								</form>
							</span>
							<a href="/<?php e($navData['teamSlug'] . '/' . $navData['listSlug'] . '/' . $task->id);?>/">
								<h4>
									<?php e($task->title);?>
								</h4>
							</a>
						</li>

					<?php endforeach;?>
				</ul>
			</section>
		<?php else: ?>
			<?php if (!empty($tasksDone) && sizeof($tasksDone) >= 1): ?>
				<section class="container center mt-4">
					<a href="/<?php e($navData['teamSlug'] . '/' . $navData['listSlug']);?>/show-done/">
						<?php i18n('show');?> <?php e(sizeof($tasksDone));?> <?php i18n('done_todos');?>
					</a>
				</section>
			<?php endif;?>
		<?php endif;?>

	</main>




<?php require __DIR__ . "/../layout/footer.php";?>
