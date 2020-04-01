${!d.action ? `

	<div class="container">
		<div id="success-invite" class="saved-target">
			We just sent an invitation to the new author.
		</div>
	</div>


	<header class="header container">
		<h2>
			Team
		</h2>
		<a href="/settings/team/new-author/" class="btn">
			New Author
		</a>
	</header>

	${d.authors.length > 1 || d.invites.length > 0 ? `
		<ul class="entries container">
			${d.authors.map(author => `
				<li>
					<div>
						<h4>
							Ben
						</h4>
						<small class="published-small">
							Admin
						</small>
						
					</div>	
				</li>
			`).join('')}
		</ul>
	`:`
		<p class="container">
			You are the only author. To add someone, please use the button to your right.
		</p>
	`}



	${d.invites.length > 0 ? `

		<ul class="entries container">
			${d.invites.map(invite => `
				<li>
					<div>
						<h4>
							${invite.name}
						</h4>
						<small class="published-small">
							Invited
						</small>
						
					</div>	
				</li>
			`).join('')}
		</ul>
	`:``}



` : ``}




${d.action === 'new-author' ? `
	<div class="container flex">
		<div class="left">
			<h3>
				Invite Author
			</h3>
			<small>
				Please provide the name and email address of the new author. She'll get a invitation to your blog.
			</small>
		</div>
		<div class="right">
			<form method="POST" class="shadow">

				<label for="name">
					Author Name:
				</label>
				<input placeholder="Type here…" type="text" name="name" id="name" required autofocus>

				<label for="em">
					E-Mail Address:
				</label>
				<input placeholder="Type here…" type="email" name="email" id="em" required>

				<input type="hidden" name="a" value="new-author">

				<footer>
					<button type="submit" class="btn">
						Invite New Author
					</button>
					<span>
						or
						<a href="/settings/team/">
							back to team overview
						</a>
					</span>
				</footer>

			</form>
		</div>
	</div>
` : ``}
