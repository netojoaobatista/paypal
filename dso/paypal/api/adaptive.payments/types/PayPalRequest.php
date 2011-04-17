<?php
require_once 'rpo/core/Object.php';

/**
 * Common fields for request messages.
 */
class PayPalRequest extends Object {
	/**
	 * Details about the request
	 * @var	RequestEnvelope
	 */
	private $requestEnvelope;

	/**
	 * Details about the request.
	 * @return	RequestEnvelope
	 */
	public function requestEnvelope() {
		if ( $this->requestEnvelope == null ) {
			$this->requestEnvelope = new RequestEnvelope();
		}

		return $this->requestEnvelope;
	}
}