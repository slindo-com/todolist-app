{{html-header}}



${d.subview === 'editor' ? `
	<form method="POST">
		{{article-nav}}
		<textarea name="text" class="article-textarea" placeholder="Type here…" autofocus>${d.article.text ? d.article.text : ''}</textarea>
	</form>

	<script>
		var changed = false,
			btnEl = document.querySelector('.js-ref');

		document.querySelector('textarea').oninput = () => {
			if(!changed) {
				btnEl.style.display = 'inline-block';
				window.onbeforeunload = () => 'Changes you made may not be saved.';
			}
			changed = true;
		};

		btnEl.onclick = () => window.onbeforeunload = null
		
	</script>

` : ``}



${d.subview === 'preview' ? `
	<form method="POST">
		{{article-nav}}
		<iframe class="preview-iframe" src="/preview-article/${d.article.id}"></iframe>
	</form>
` : ``}



${d.subview === 'options' ? `
	<form method="POST">
		{{article-nav}}
	</form>

	<div class="container">
		<div id="success-metadata" class="saved-target">
			Metadata successfully changed!
		</div>
	</div>

	<div class="container flex">
		<div class="left">
			<h3>
				Options for article
			</h3>
			<small>
				Lorem Ipsum Dolor sit amet set consetetur. Lorem Ipsum Dolor sit amet set consetetur. 
			</small>
		</div>
		<div class="right">
			<form method="POST" class="shadow">

				<label for="title">
					Article Title:
				</label>
				<input placeholder="Type here…" type="text" name="title" id="title" value="${d.article.title ? d.article.title : ''}" required autofocus>

				<label>
					<input type="checkbox" name="published" ${d.article.published ? 'checked' : ''}>
					<p>
						Published
					</p>
				</label>

				<input type="hidden" name="a" value="change-metadata">

				<footer>
					<button type="submit" class="btn">
						Save Article Options
					</button>
				</footer>

			</form>
		</div>
	</div>
` : ``}



{{html-footer}}


