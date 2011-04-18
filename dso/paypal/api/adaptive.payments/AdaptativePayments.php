<?php
require_once 'rpo/core/Object.php';
require_once 'dso/paypal/api/adaptive.payments/operations/pay/PayOperation.php';
require_once 'dso/paypal/api/adaptive.payments/operations/paymentDetails/PaymentDetailsOperation.php';

/**
 * The Adaptive Payments API enables you to send money in many different
 * scenarios, from simple to complex; for example, you might build a small
 * send money application for a social networking site or a robust payroll
 * system.
 */
class AdaptativePayments extends Object {
	/**
	 * @var	PayPal
	 */
	private $paypal;

	/**
	 * @param	PayPal $paypal
	 */
	public function __construct( PayPal $paypal ) {
		parent::__construct();

		$this->paypal = $paypal;
	}

	/**
	 * Use the Pay API operation to transfer funds from a sender's PayPal
	 * account to one or more receivers' PayPal accounts.
	 * @return	PayOperation
	 */
	public function pay() {
		return new PayOperation( $this->paypal->getAbstractMessageFactory() , $this->paypal->getHTTPConnection() );
	}

	/**
	 * Use the PaymentDetails API operation to obtain information abouta payment.
	 * You can identify the payment by your tracking ID, the PayPal transaction ID
	 * in an IPN message, or the pay key associated with the payment.
	 * @return	PaymentDetailsOperation
	 */
	public function paymentDetails() {
		return new PaymentDetailsOperation( $this->paypal->getAbstractMessageFactory() , $this->paypal->getHTTPConnection() );
	}
}