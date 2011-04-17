<?php
/**
 * Objects related to the Pay API operation.
 * @author	João Batista Neto
 * @package	dso.paypal.api.adaptative.payments.operations.pay
 */

require_once 'dso/paypal/api/adaptive.payments/operations/AbstractAdaptativePaymentsOperation.php';
require_once 'dso/paypal/api/adaptive.payments/operations/pay/request/PayRequest.php';

/**
 * Use the Pay API operation to transfer funds from a sender's PayPal
 * account to one or more receivers' PayPal accounts.
 *
 * You can use the Pay API operation to make simple payments, chained
 * payments, or parallel payments; these payments can be explicitly approved,
 * preapproved, or implicitly approved.
 */
class PayOperation extends AbstractAdaptativePaymentsOperation {
	/**
	 * @var	PayRequest
	 */
	private $request;

	/**
	 * @see		PayPalOperation::call()
	 */
	public function call() {
		$requestMessage = $this->paypalMessageFactory->createMessageElement();

		$httpConnection->setRequestBody( $requestMessage->draw() );

		return $this->httpConnection->execute( self::BASE_PATH . 'Pay' , HTTPRequestMethod::POST );
	}

	/**
	 * The PayRequest contains the instructions required to make a payment.
	 * @return	PayRequest
	 * @see		PayPalOperation::request()
	 */
	public function request() {
		if ( $this->request == null ) {
			$this->request = new PayRequest();
		}

		return $this->request;
	}
}