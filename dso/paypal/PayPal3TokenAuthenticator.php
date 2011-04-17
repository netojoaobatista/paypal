<?php
/**
 * Objects and interfaces to integrate with the PayPal API.
 * @author	João Batista Neto
 * @package	dso.paypal
 */

require_once 'rpo/http/HTTPAuthenticator.php';
require_once 'rpo/http/HTTPRequest.php';
require_once 'rpo/core/Object.php';

/**
 * 3 Token PayPal API credentials to authenticate your application
 */
class PayPal3TokenAuthenticator implements HTTPAuthenticator {
	/**
	 * @var	string
	 */
	private $securityPassword;

	/**
	 * @var	string
	 */
	private $securitySignature;

	/**
	 * @var	string
	 */
	private $securityUserId;

	/**
	 * Create the 3-token authentication object to authenticate your application.
	 * @param	string $securityUserId Your API username.
	 * @param	string $securityPassword Your API password.
	 * @param	string $securitySignature Your API signature.
	 */
	public function __construct( $securityUserId , $securityPassword , $securitySignature ) {
		$this->securityPassword = $securityPassword;
		$this->securitySignature = $securitySignature;
		$this->securityUserId = $securityUserId;
	}

	/**
	 * Authenticate your application request.
	 * @param	HTTPRequest $httpRequest
	 * @see		HTTPAuthenticator::authenticate()
	 */
	public function authenticate( HTTPRequest $httpRequest ) {
		$httpRequest->addRequestHeader( 'X-PAYPAL-SECURITY-USERID' , $this->securityUserId );
		$httpRequest->addRequestHeader( 'X-PAYPAL-SECURITY-PASSWORD' , $this->securityPassword );
		$httpRequest->addRequestHeader( 'X-PAYPAL-SECURITY-SIGNATURE' , $this->securitySignature );
	}

	/**
	 * @param string $securityPassword
	 */
	public function setSecurityPassword( $securityPassword ) {
		$this->securityPassword = $securityPassword;
	}

	/**
	 * @param string $securitySignature
	 */
	public function setSecuritySignature( $securitySignature ) {
		$this->securitySignature = $securitySignature;
	}

	/**
	 * @param string $securityUserId
	 */
	public function setSecurityUserId( $securityUserId ) {
		$this->securityUserId = $securityUserId;
	}
}