<?php require __DIR__ . "/../layout/header.php";?>
<?php require __DIR__ . "/../layout/main-nav.php";?>

<main>

	<div class="header-wrapper">
		<header class="header">
			<div class="inner">
				<a href="#main-navigation" class="toggle-nav">
					☰
				</a>
				<h2>
					<a href="/{{$navData['teamSlug'] . '/' . $navData['listSlug']}}/">
						{{$navData['list']->title}}
					</a>
					→
					[[edit]]
				</h2>
			</div>
		</header>
	</div>


	<section class="container">
		<div class="flex">
			<div class="left">
				<h3>
					[[list_title]]
				</h3>
				<small>
					[[list_title_description]]
				</small>
			</div>
			<div class="right">
				<form method="POST" class="form shadow">

					<label for="ti">
						[[new_title]]
					</label>
					<input placeholder="[[type_here]]" type="text" name="title" id="ti" value="{{$navData['list']->title}}" autofocus required maxlength="30">

					<input type="hidden" name="listId" value="{{$navData['list']->id}}">

					<footer>
						<span>
							<button type="submit" class="btn" name="a" value="edit-title">
								[[save_new_title]]
							</button>
						</span>
						<button type="submit" class="btn red" name="a" value="trash-list">
							[[trash_list]]
						</button>
					</footer>
				</form>
			</div>
		</div>
	</section>

</main>

<?php require __DIR__ . "/../layout/footer.php";?>
