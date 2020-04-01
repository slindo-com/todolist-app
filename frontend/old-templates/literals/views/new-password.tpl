{{html-header}}


<section class="small-container">
	<h2 class="mb-2">
		New Password
	</h2>

	${d.error ? `<p class="err">${d.error}</p>` : ``}

	<form method="POST" class="shadow">

		<label for="e">
			E-Mail:
		</label>
		<input placeholder="Type here…" type="email" name="email" id="e" required autofocus>

		<footer>
			<button type="submit" name="a" value="new-password" class="btn">
				Send New Password
			</button>
			<span>
				or
				<a href="/sign-in/">
					sign in to account
				</a>
			</span>
		</footer>

	</form>

</section>


{{html-footer}}