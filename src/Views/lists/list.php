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
							[[edit]]
						</a>
					</h2>
				</div>

				<form method="POST" class="todo-form" autocomplete="off">
					<input type="text" name="todo" placeholder="Type a new Todo here" minlength="1" accesskey="n" required autofocus>
					<div>
						[[press_enter_to_create_todo]]
					</div>
				</form>
			</header>
		</div>

		<?php if (!empty($tasksUndone) && sizeof($tasksUndone) >= 1): ?>
			<section class="container">
				<ul class="entries tasks">
					<?php foreach ($tasksUndone AS $task): ?>
						<?php $showImportant = true;require __DIR__ . "/../modules/task-entry.php";?>
					<?php endforeach;?>
				</ul>
			</section>
		<?php elseif (empty($showDone)): ?>
			<section class="container">
				<div class="empty-box">
					<span>

						<?php if (!empty($tasksDone) && sizeof($tasksDone) >= 1): ?>
							<h3 class="mb-2">
								[[everything_is_done]]
							</h3>
							<p>
								[[you_could_either]]
								<a href="/<?php e($navData['teamSlug'] . '/' . $navData['listSlug']);?>/edit/">
									[[go_to_the_edit_section]]
								</a>
								[[and_trash_this]]
							</p>
						<?php else: ?>
							<h3 class="mb-2">
								[[your_list_is_empty]]
							</h3>
							<p>
								[[lets_create_a_new_task]]
							</p>
						<?php endif;?>
						<p>
							<a href="https://todolist.one/help/" taget="_blank">
								[[go_to_our_help_section]]
							</a>
							[[if_app_is_unclear]]
						</p>
					</span>
				</div>
			</section>
		<?php endif;?>


		<?php if (!empty($showDone) && !empty($tasksDone) && sizeof($tasksDone) >= 1): ?>
			<section class="container">
				<ul class="entries tasks">
					<?php foreach ($tasksDone AS $task): ?>
						<?php $showImportant = false;require __DIR__ . "/../modules/task-entry.php";?>
					<?php endforeach;?>
				</ul>
			</section>
		<?php else: ?>
			<?php if (!empty($tasksDone) && sizeof($tasksDone) >= 1): ?>
				<section class="container center mt-4">
					<a href="/<?php e($navData['teamSlug'] . '/' . $navData['listSlug']);?>/show-done/">
						[[show]] <?php e(' ' . sizeof($tasksDone) . ' ');?> [[done_todos]]
					</a>
				</section>
			<?php endif;?>
		<?php endif;?>

	</main>




<?php require __DIR__ . "/../layout/footer.php";?>
