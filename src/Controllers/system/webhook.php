<?php // ROUTE: /webhook/

if (!empty($_POST['alert_name']) AND $_POST['alert_name'] == 'subscription_created') {
	F::dbNew(M::PRO_PLANS(), [
		'id' => $_POST['subscription_id'],
		'email' => $_POST['email'],
		'cancel_url' => $_POST['cancel_url'],
		'update_url' => $_POST['update_url'],
		'next_bill_date' => $_POST['next_bill_date'],
		'user' => explode('-', $_POST['passthrough'])[0],
		'payed_by' => explode('-', $_POST['passthrough'])[1],
	]);

	F::dbNew(M::PRO_PLAN_UPDATES(), [
		'pro_plan' => $_POST['subscription_id'],
		'type' => $_POST['alert_name'],
	]);
} else if (!empty($_POST['alert_name']) AND $_POST['alert_name'] == 'subscription_updated') {

	F::dbUpdate(M::PRO_PLANS(), $_POST['subscription_id'], [
		'next_bill_date' => $_POST['next_bill_date'],
	]);

	F::dbNew(M::PRO_PLAN_UPDATES(), [
		'pro_plan' => $_POST['subscription_id'],
		'type' => $_POST['alert_name'],
	]);
} else if (!empty($_POST['alert_name']) AND $_POST['alert_name'] == 'subscription_cancelled') {

	F::dbNew(M::PRO_PLAN_UPDATES(), [
		'pro_plan' => $_POST['subscription_id'],
		'type' => $_POST['alert_name'],
	]);
} else if (!empty($_POST['alert_name']) AND $_POST['alert_name'] == 'subscription_payment_succeeded') {

	F::dbUpdate(M::PRO_PLANS(), $_POST['subscription_id'], [
		'next_bill_date' => $_POST['next_bill_date'],
	]);

	F::dbNew(M::PRO_PLAN_UPDATES(), [
		'pro_plan' => $_POST['subscription_id'],
		'type' => $_POST['alert_name'],
		'receipt_url' => $_POST['receipt_url'],
	]);
} else if (!empty($_POST['alert_name']) AND $_POST['alert_name'] == 'subscription_payment_failed') {

	F::dbNew(M::PRO_PLAN_UPDATES(), [
		'pro_plan' => $_POST['subscription_id'],
		'type' => $_POST['alert_name'],
	]);
} else if (!empty($_POST['alert_name']) AND $_POST['alert_name'] == 'subscription_payment_refunded') {

	F::dbNew(M::PRO_PLAN_UPDATES(), [
		'pro_plan' => $_POST['subscription_id'],
		'type' => $_POST['alert_name'],
	]);
}
