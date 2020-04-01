<div class="container flex">
	<div class="left">
		${!d.action ? `
			<h3>
				Account
			</h3>
			<small>
				Basic account settings
			</small>
		` : ``}

		${d.action === 'change-email' ? `
			<h3>
				Change Email
			</h3>
			<small>
				Please provide your new email address. You'll get a email with a confirmation link to this address.
			</small>
		` : ``}

		${d.action === 'change-password' ? `
			<h3>
				Change Password
			</h3>
			<small>
				Please provide your old and new password.
			</small>
		` : ``}
	</div>
	<div class="right">



		${!d.action ? `

			<div id="success-email" class="saved-target">
				Please go to your email inbox and confirm the change.
			</div>

			<div id="success-password" class="saved-target">
				Password successfully changed!
			</div>

			<div class="box">
				<p>
					<strong>
						E-Mail:
					</strong>
					&nbsp;
					Benjamin.Kowalski.1987@gmail.com
				</p>
				<a href="/settings/account/change-email/" class="btn">
					Change E-Mail Address
				</a>
				<a href="/settings/account/change-password/" class="btn">
					Change Password
				</a>
			</div>



			<form method="POST" class="shadow">
				<label for="na">
					Your Name:
				</label>
				<input placeholder="Type here…" type="text" name="name" id="na" value=\"${d.user.name ? d.user.name : ''}\">

				<input type="hidden" name="a" value="pro">

				<footer>
					<button type="submit" class="btn">
						Save Name
					</button>
					${d.saved ? `
						<div class="saved">
							Name successfully saved!
						</div>
					` : ``}
				</footer>
			</form>
		` : ``}



		${d.action === 'change-email' ? `
			<form method="POST" class="shadow">
				<label for="em">
					New E-Mail Address:
				</label>
				<input placeholder="Type here…" type="email" name="email" id="em" required autofocus>

				<input type="hidden" name="a" value="ema">

				<footer>
					<button type="submit" class="btn">
						Change E-Mail Address
					</button>
					<span>
						or
						<a href="/settings/account/">
							back to account settings
						</a>
					</span>
				</footer>
			</form>
		` : ``}



		${d.action === 'change-password' ? `
			<form method="POST" class="shadow">

				<label for="op">
					Old Password:
				</label>
				<input placeholder="Type here…" type="password" name="oldpassword" id="op" minlength="6" required autofocus>

				<label for="np">
					New Password:
				</label>
				<input placeholder="Type here…" type="password" name="newpassword" id="np" minlength="6" required>

				<input type="hidden" name="a" value="pas">

				<footer>
					<button type="submit" class="btn">
						Change Password
					</button>
					<span>
						or
						<a href="/settings/account/">
							back to account settings
						</a>
					</span>
				</footer>

			</form>
		` : ``}



	</div>
</div>




