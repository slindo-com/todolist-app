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
						<?php i18n('edit');?>
					</h2>
				</div>
			</header>
		</div>


		<section class="container">
			<div class="flex">
				<div class="left">
					<h3>
						<?php i18n('list_title');?>
					</h3>
					<small>
						<?php i18n('list_title_description');?>
					</small>
				</div>
				<div class="right">
					<form method="POST" class="form shadow">


						<label for="ti">
							<?php i18n('new_title');?>
						</label>
						<input placeholder="<?php i18n('type_here');?>" type="text" name="title" id="ti" value="<?php echo e($navData['list']->title); ?>" autofocus required maxlength="30">

						<input type="hidden" name="listId" value="<?php echo e($navData['list']->id); ?>">

						<footer>
							<span>
								<button type="submit" class="btn" name="a" value="edit-title">
									<?php i18n('save_new_title');?>
								</button>
							</span>
							<button type="submit" class="btn red" name="a" value="trash-list">
								<?php i18n('trash_list');?>
							</button>
						</footer>
					</form>
				</div>
			</div>
		</section>








	</main>




<?php require __DIR__ . "/../layout/footer.php";?>
