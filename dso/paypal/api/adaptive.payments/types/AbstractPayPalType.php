<?php
require_once 'rpo/core/Object.php';
require_once 'dso/paypal/api/adaptive.payments/types/PayPalType.php';

/**
 *
 */
abstract class AbstractPayPalType extends Object implements PayPalType {
	public function __construct() {
		parent::__construct();
	}
}