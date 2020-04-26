<?php require __DIR__ . "/../layout/header.php";?>

<main class="full">
	<?php $navItemActive = 'general';require __DIR__ . "/../layout/secondary-nav.php";?>


	<div class="header-wrapper">
		<header class="header">
			<div class="inner">
				<h2>
					<a href="/settings/">
						[[general]]
					</a>
					&nbsp;→&nbsp;
					Trashed Lists
				</h2>
			</div>
		</header>
	</div>



	<?php if ($listWasReactivated): ?>
		<section class="container">
			<div class="message">
				[[you_reactivated_the_list]]
			</div>
		</section>
	<?php elseif ($listWasDeleted): ?>
		<section class="container">
			<div class="message">
				[[you_deleted_the_list]]
			</div>
		</section>
	<?php endif?>



	<section class="container">
	<?php foreach ($trashedLists AS $trashedListTeamId => $trashedListTeam): ?>
		<?php if (sizeof($trashedListTeam) > 0): ?>
			<ul class="entries">
				<?php foreach ($trashedListTeam AS $trashedList): ?>
				<li>
					<div class="flex-entry">
						<div>
							<h4>
								{{$trashedList->title}}
							</h4>
							<small>
								[[team]]:&nbsp;
								{{($trashedListTeamId == 0) ? i18n('private') : $teams[$trashedListTeamId]->title}}
							</small>
							<small>{{$trashedList->task_count}} {{$trashedList->task_count == 1 ? i18n('todo') : i18n('todos')}}</small>
						</div>
						<form method="POST" class="button-wrapper">
							<input type="hidden" name="listId" value="{{$trashedList->id}}">
							<button type="submit" name="a" value="reactivate" class="btn">
								[[reactivate]]
							</button>
							<button type="submit" name="a" value="delete" class="btn">
								[[delete_permanently]]
							</button>
						</form>
					</div>
				</li>
				<?php endforeach;?>
			</ul>
		<?php endif;?>
	<?php endforeach;?>
	</section>

</main>

<?php require __DIR__ . "/../layout/footer.php";?>
