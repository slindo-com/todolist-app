<?php

//
function PRO_PLANS() {
	return [
		'table' => 'pro_plans',
		'asset' => 'ProPlansAsset',
	];
}

//
class ProPlansAsset extends AbstractAsset {
	public $id;
	public $email;
	public $cancel_url;
	public $update_url;
	public $next_bill_date;
	public $user;
	public $payed_by;
}