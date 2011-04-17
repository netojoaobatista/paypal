<?php
require_once 'dso/paypal/message/PayPalMessageField.php';

/**
 *
 */
class JSONMessageField extends PayPalMessageField {
	/**
	 * @return	string
	 * @see		PayPalMessageComponent::draw()
	 */
	public function draw() {
		return sprintf( '"%s":%s' , addcslashes( $this->name , '"' ) , $this->value->draw() );
	}
}