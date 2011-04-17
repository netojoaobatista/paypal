<?php
/**
 * Operations related to adaptative payments API
 * @author	João Batista Neto
 * @package	dso.paypal.api.adaptative.payments.operations
 */

require_once 'dso/paypal/PayPalOperation.php';
require_once 'rpo/core/Object.php';

/**
 * Adaptive Payments provides several API operations, enabling you to build
 * an application that handles payments, preapprovals for payments, and refunds.
 * You can also retrieve Foreign Exchange conversion rates for a list of amounts.
 *
 * This class provides a skeletal implementation of the PayPalOperation interface.
 */
abstract class AbstractAdaptativePaymentsOperation extends Object implements PayPalOperation {
	/**
	 * Base path to Adaptative Payments API.
	 */
	const BASE_PATH = '/AdaptivePayments/';

	/**
	 * @var	HTTPConnection
	 */
	protected $httpConnection;

	/**
	 * @var AbstractPayPalMessageFactory
	 */
	protected $paypalMessageFactory;

	/**
	 * @param	AbstractPayPalMessageFactory $paypalMessageFactory
	 * @param	HTTPConnection $httpConnection
	 */
	public function __construct( AbstractPayPalMessageFactory $paypalMessageFactory , HTTPConnection $httpConnection ) {
		parent::__construct();

		$this->httpConnection = $httpConnection;
		$this->paypalMessageFactory = $paypalMessageFactory;
	}
}