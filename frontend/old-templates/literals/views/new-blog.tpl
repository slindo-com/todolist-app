{{html-header}}
{{main-nav}}



<section class="small-container">
	<h2>
		New Blog
	</h2>

	${d.err ? `<p class="err">${d.err}</p>` : ``}

	<form method="POST">

		<label for="t">
			Title:
		</label>
		<input placeholder="eg. 'Blogswise Company Blog'" type="text" name="title" id="t" minlength="3" required autofocus>

		<label for="s">
			Subdomain:
		</label>
		<input placeholder="Please just use letters and numbers" type="text" name="subdomain" id="s" pattern="[a-zA-Z0-9]+" minlength="3" required>
		<small>
			Your blog will be available at https://<strong>SUBDOMAIN</strong>.blogswise.com/
		</small>


		<input type="hidden" name="a" value="s">

		<footer>
			<button type="submit" class="btn">
				Create new blog
			</button>
		</footer>

	</form>
</section>



{{html-footer}}


