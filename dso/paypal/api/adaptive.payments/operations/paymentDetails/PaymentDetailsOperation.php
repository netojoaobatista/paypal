<?php
/**
 * Objects related to the PayDetails API operation.
 * @author	João Batista Neto
 * @package	dso.paypal.api.adaptative.payments.operations.payDetails
 */

require_once 'dso/paypal/api/adaptive.payments/operations/AbstractAdaptativePaymentsOperation.php';
require_once 'dso/paypal/api/adaptive.payments/operations/paymentDetails/request/PaymentDetailsRequest.php';
require_once 'dso/paypal/api/adaptive.payments/operations/paymentDetails/request/PaymentDetailsRequestMessageBuilder.php';

/**
 * Use the PaymentDetails API operation to obtain information abouta payment.
 *
 * You can identify the payment by your tracking ID, the PayPal transaction ID
 * in an IPN message, or the pay key associated with the payment.
 */
class PaymentDetailsOperation extends AbstractAdaptativePaymentsOperation {
	/**
	 * @var	PayRequest
	 */
	private $request;

	/**
	 * @see		PayPalOperation::call()
	 */
	public function call() {
		if ( $this->request != null ) {
			$messageBuilder = new PaymentDetailsRequestMessageBuilder( $this->request , $this->paypalMessageFactory );

			$this->httpConnection->setRequestBody( $messageBuilder->getMessage()->draw() );

			return $this->httpConnection->execute( self::BASE_PATH . 'PaymentDetails' , HTTPRequestMethod::POST );
		} else {
			throw new BadMethodCallException( 'The PaymentDetails request was not created yet.' );
		}
	}

	/**
	 * The PayRequest contains the instructions required to make a payment.
	 * @return	PaymentDetailsRequest
	 * @see		PayPalOperation::request()
	 */
	public function request() {
		if ( $this->request == null ) {
			$this->request = new PaymentDetailsRequest();
		}

		return $this->request;
	}
}