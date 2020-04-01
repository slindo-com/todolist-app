{{html-header}}
{{main-nav}}



<header class="header container">
	<h2>
		Articles
	</h2>
	<form method="POST" class="button-wrapper">
		<input type="hidden" name="a" value="s">
		<button class="btn">
			New article
		</button>
	</form>
</header>

${d.articlesDraft.length > 0 ? `
	<ul class="entries container">
		${d.articlesDraft.map(article => `
			<li>
				<a href="/article/${article.id}/">
					<h4>
						${article.title ? article.title : 'No Title'}
					</h4>
					<small class="published-small">
						Draft
					</small>
					<small>
						by Ben
					</small>
					
				</a>	
			</li>
		`).join('')}
	</ul>
`:``}

${d.articlesPublished.length > 0 ? `
	<ul class="entries container">
		${d.articlesPublished.map(article => `
			<li>
				<a href="/article/${article.id}/">
					<h4>
						${article.title ? article.title : 'No Title'}
					</h4>
					<small class="published-small">
						Published
					</small>
					<small>
						by Ben
					</small>
					
				</a>	
			</li>
		`).join('')}
	</ul>
`:``}

${!d.hasArticles ? `
	<p class="container">
		No articles available!
	</p>
`:``}


{{html-footer}}


