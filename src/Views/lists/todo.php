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
						<a href="/<?php echo $navData['teamSlug']; ?>/<?php echo $navData['listSlug']; ?>/">
							← <?php i18n('back_to');?> <?php e2($navData['list']->title);?>
						</a>
					</h2>
				</div>
			</header>
		</div>



		<section class="container">
			<div class="flex">
				<div class="left">
					<h3>
						<?php i18n('update_todo');?>
					</h3>
					<small>
						<?php i18n('update_todo_description');?>
					</small>
				</div>
				<div class="right">
					<form method="POST" class="form shadow">


						<label for="ti">
							<?php i18n('task_title');?>
						</label>
						<input placeholder="<?php i18n('type_here');?>" type="text" name="title" id="ti" value="<?php echo e($todo->title); ?>" autofocus required>


						<footer>
							<span>
								<button type="submit" class="btn" name="a" value="update">
									<?php i18n('save_task');?>
								</button>
							</span>
							<button type="submit" class="btn end red" name="a" value="delete">
								<?php i18n('delete');?>
							</button>
						</footer>
					</form>
				</div>
			</div>
		</section>








	</main>




<?php require __DIR__ . "/../layout/footer.php";?>
