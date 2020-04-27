<?php

//
function PRO_PLAN_UPDATES() {
	return [
		'table' => 'pro_plan_updates',
		'asset' => 'ProPlanUpdatesAsset',
	];
}

//
class ProPlanUpdatesAsset extends AbstractAsset {
	public $id;
	public $pro_plan;
	public $type;
	public $receipt_url;
	public $created_at;
}