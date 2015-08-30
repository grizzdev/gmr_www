<?php

$report = '';

$db = mysql_connect('aws-rds-gamerosity.grizzdev.com', 'gamerroot', 'teV^ceevjia');
mysql_select_db('gamerosity');

$ordersq = mysql_query("SELECT * FROM `orders` WHERE `status_id` IN (1,2,7) AND `created_at` > '2015-01-01'");

while ($order = mysql_fetch_assoc($ordersq)) {
	$checkout = (array)json_decode($order['checkout_json']);
	$state = @mysql_fetch_assoc(@mysql_query("SELECT * FROM `locations` WHERE `id` = ".$checkout['shipping-state-id']));

	$cart = json_decode($order['cart_json']);
	foreach ($cart as $item) {
		$report .= "{$order['id']},";
		$report .= "{$item->name},";
		foreach ($item->attributes as $attr) {
			if ($attr->name == 'Size') {
				$report .= $attr->value.',';
			} elseif ($attr->name == 'pa_size') {
				$report .= $attr->options->name.',';
			}
		}
		$report .= $item->quantity.',';
		$report .= $checkout['first-name'].' '.$checkout['last-name'].',';
		$report .= $checkout['shipping-address-1'].',';
		$report .= $checkout['shipping-address-2'].',';
		$report .= $checkout['shipping-city'].',';
		$report .= (!empty($state)) ? $state['code'].',' : ',';
		$report .= $checkout['shipping-zip'];
		$report .= "\n";
	}
}

echo $report;
