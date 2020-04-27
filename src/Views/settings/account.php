<?php require __DIR__ . "/../layout/header.php";?>

<main class="full">
	<?php $navItemActive = 'account';require __DIR__ . "/../layout/secondary-nav.php";?>


	<div class="header-wrapper">
		<header class="header">
			<div class="inner">
				<h2>
					[[account]]
				</h2>
				<form method="POST" class="button-wrapper">
					<button type="submit" name="a" value="sign-out" class="btn">
						[[sign_out]]
					</button>
				</form>
			</div>
		</header>
	</div>



	<?php if ($success): ?>
		<section class="container">
			<div class="message">
				<?php
switch ($success) {
case 'change-name':i18n('name_updated_successfully');
	break;
case 'change-email':i18n('please_confirm_email');
	break;
case 'change-email-success':i18n('email_updated_successfully');
	break;
case 'change-name':i18n('password_updated_successfully');
	break;
case 'change-pic':i18n('picture_updated_successfully');
	break;
}
?>
			</div>
		</section>
	<?php endif?>



	<section class="container flex">
		<div class="left">
			<small>
				[[basic_account_settings]]
			</small>
		</div>
		<div class="right">



			<div class="box">
				<?php if (!empty($user->pic)): ?>
					<figure class="pic">
						<img src="/pics/{{$user->pic}}" alt="Profile Picture" />
					</figure>
				<?php endif;?>

				<p>
					<strong>
						[[email]] &nbsp;
					</strong>
					{{$user->email}}
				</p>
				<div class="link-wrapper">
					<a href="/settings/account/change-email/">
						[[change_email]]
					</a>
					<a href="/settings/account/change-password/">
						[[change_password]]
					</a>
					<a href="/settings/account/change-pic/">
						[[change_picture]]
					</a>
				</div>
			</div>



			<form method="POST" class="form shadow">
				<label for="na">
					[[your_name]]
				</label>
				<input placeholder="[[type_here]]" type="text" name="name" id="na" value="{{!empty($user->name) ? $user->name : ''}}">

				<footer>
					<button type="submit" class="btn" name="a" value="save-name">
						[[change_name]]
					</button>
				</footer>
			</form>
		</div>
	</section>




	<section class="container mt-8 flex">
		<div class="left">
			<h3>
				[[account_plan]]
			</h3>
			<small>
				[[account_plan_description]]
			</small>
		</div>
		<div class="right">

			<?php if (!$user->pro_plan): ?>

				<div class="box">
					<p>
						[[upgrade_plan_description]]
					</p>
					<a href="https://pay.paddle.com/checkout/591502/?passthrough={{$user->id}}-{{$user->id}}&guest_email={{urlencode($user->email)}}" class="btn" target="_blank">
						[[upgrade_plan]]
					</a>
				</div>

				<!--
					&custom_message=
				-->

			<?php else: ?>

				<?php if (!empty($proPlan)): ?>
					<ul class="entries">
						<li>
							<div>
								<p>
									[[plan_updates_description]]
								</p>
								<h3 class="mt-8">
									[[plan_updates]]
								</h3>
							</div>
						</li>

						<?php foreach ($proPlanUpdates AS $update): ?>
							<li>
								<div>
									<p>
									<strong>
										{{date('d.m.y H:i', strtotime($update->created_at))}}:
									</strong>
									<br />

<?php
switch ($update->type) {
case 'subscription_created':i18n('subscription_created');
	break;
case 'subscription_updated':i18n('subscription_updated');
	break;
case 'subscription_cancelled':i18n('subscription_cancelled');
	break;
case 'subscription_payment_succeeded':i18n('subscription_payment_succeeded');
	break;
case 'subscription_payment_failed':i18n('subscription_payment_failed');
	break;
case 'subscription_payment_refunded':i18n('subscription_payment_refunded');
	break;
}
?>
									</p>
									<?php if (!empty($update->receipt_url)): ?>
										<p>
											<a href="{{$update->receipt_url}}" target="_blank">
												View the receipt
											</a>
										</p>
									<?php endif;?>


								</div>
							</li>
						<?php endforeach;?>


						<li>
							<div>
								<a href="{{$proPlan->cancel_url}}" class="btn" target="_blank">
									Cancel Pro Plan
								</a>
							</div>
						</li>
					</ul>
				<?php endif;?>

			<?php endif;?>

		</div>
	</section>

</main>

<?php require __DIR__ . "/../layout/footer.php";?>
