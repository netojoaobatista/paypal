<?php
require_once 'dso/paypal/api/adaptive.payments/types/PayPalRequest.php';

/**
 * The PaymentDetailsRequest contains the identifier used to retrieve
 * information about the payment.
 */
class PaymentDetailsRequest extends PayPalRequest {
	/**
	 * The pay key that identifies the payment for which you want to
	 * retrieve details. This is the pay key returned in the PayResponse
	 * message.
	 * @var	string
	 */
	private $payKey;

	/**
	 * The PayPal transaction ID associated with the payment. The IPN
	 * message associated with the payment contains the transaction ID.
	 * @var	string
	 */
	private $transactionId;

	/**
	 * The tracking ID that was specified for this payment in the PayRequest
	 * message.
	 * @var	string
	 */
	private $trackingId;

	/**
	 * @return	string
	 */
	public function getPayKey() {
		return $this->payKey;
	}

	/**
	 * @return	STRING
	 */
	public function getTransactionId() {
		return $this->transactionId;
	}

	/**
	 * @return	string
	 */
	public function getTrackingId() {
		return $this->trackingId;
	}

	/**
	 * Sets the pay key that identifies the payment for which you want to
	 * retrieve details. This is the pay key returned in the PayResponse
	 * message.
	 * @param	string $payKey
	 */
	public function setPayKey( $payKey ) {
		$this->payKey = $payKey;
	}

	/**
	 * Sets the PayPal transaction ID associated with the payment. The IPN
	 * message associated with the payment contains the transaction ID.
	 * @param	string $transactionId
	 */
	public function setTransactionId( $transactionId ) {
		$this->transactionId = $transactionId;
	}

	/**
	 * Sets the tracking ID that was specified for this payment in the
	 * PayRequest message.
	 * <b>Maximum length:</b> 127 characters
	 * @param	string $trackingId
	 * @throws	LengthException
	 */
	public function setTrackingId( $trackingId ) {
		if ( strlen( $trackingId ) <= 127 ) {
			$this->trackingId = $trackingId;
		} else {
			throw new LengthException( 'The supplied tracking id is too long' );
		}
	}
}