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
					<a href="/{{$navData['teamSlug']}}/{{$navData['listSlug']}}/">
						← [[back_to]] {{$navData['list']->title}}
					</a>
				</h2>
			</div>
		</header>
	</div>



	<section class="container">
		<div class="flex">
			<div class="left">
				<h3>
					[[update_todo]]
				</h3>
				<small>
					[[update_todo_description]]
				</small>
			</div>
			<div class="right">
				<form method="POST" class="form shadow">


					<label for="ti">
						[[task_title]]
					</label>
					<input placeholder="[[type_here]]" type="text" name="title" id="ti" value="{{$todo->title}}" autofocus required>


					<footer>
						<span>
							<button type="submit" class="btn" name="a" value="update">
								[[save_task]]
							</button>
						</span>
						<button type="submit" class="btn end red" name="a" value="delete">
							[[delete]]
						</button>
					</footer>
				</form>
			</div>
		</div>
	</section>

</main>

<?php require __DIR__ . "/../layout/footer.php";?>
