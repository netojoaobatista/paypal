<?php
/**
 * Objects and interfaces to integrate with the PayPal API.
 * @author	João Batista Neto
 * @package	dso.paypal
 */

/**
 * An PayPalOperation encapsulate a request to the PayPal
 * API as an object.
 */
interface PayPalOperation {
	/**
	 * Perform the API call and manipulate the HTTPResponse from
	 * the PayPal server.
	 * @return	PayPalResponse
	 */
	public function call();

	/**
	 * The request object related to this operation.
	 * @return	PayPalRequest
	 */
	public function request();
}