<?php
/**
 * Objects related with JSON message creation and composition
 * @author	João Batista Neto
 * @package	dso.paypal.message.json
 */

require_once 'dso/paypal/message/PayPalMessageElement.php';

/**
 *
 */
class JSONMessageElement extends PayPalMessageElement {
	/**
	 * @return	string
	 * @see		PayPalMessageComponent::draw()
	 */
	public function draw() {
		if ( $this->name == null ) {
			return '{' . implode( ',' , $this->toArray() ) . '}';
		} else {
			return '{"' . addcslashes( $this->name , '"' ) . '": {' . implode( ',' , $this->toArray() ) . '}}';
		}
	}
}