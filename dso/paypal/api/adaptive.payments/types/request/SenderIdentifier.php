<?php
require_once 'dso/paypal/api/adaptive.payments/types/request/AccountIdentifier.php';

/**
 * Sender’s identifying information.
 */
class SenderIdentifier extends AccountIdentifier {
	/**
	 * If true, use credentials to identify the sender; default is false.
	 * @var	boolean
	 */
	private $useCredentials = false;

	/**
	 * @return	boolean
	 */
	public function getUseCredentials() {
		return $this->useCredentials;
	}

	/**
	 * If true, use credentials to identify the sender; default is false.
	 * @param	boolean $useCredentials
	 */
	public function setUseCredentials( $useCredentials ) {
		$this->useCredentials = $useCredentials == true;
	}
}