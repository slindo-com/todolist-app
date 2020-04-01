<header class="article-header">
	<div class="left-wrapper">
		<a href="/articles/">
			Back to articles
		</a>
		${d.subview === 'editor' ? `
			<button name="a" value="sav" type="submit" class="btn js-ref">
				Save Article
			</button>
		` : ``}
	</div>

	<div class="center-wrapper">

	</div>

	<div class="right-wrapper">
		<a href="/article/${d.article.id}/" ${d.subview === 'editor' ? ` class="active"` : ``}>
			Editor
		</a>
		<a href="/article/${d.article.id}/preview/" ${d.subview === 'preview' ? ` class="active"` : ``}>
			Preview
		</a>
		<a href="/article/${d.article.id}/options/" ${d.subview === 'options' ? ` class="active"` : ``}>
			Options
		</a>
	</div>
</header>