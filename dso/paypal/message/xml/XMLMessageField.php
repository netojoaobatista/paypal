<?php
require_once 'dso/paypal/message/PayPalMessageField.php';

/**
 *
 */
class XMLMessageField extends PayPalMessageField {
	/**
	 * @param	PayPalMessageComponent $child
	 * @return	boolean
	 */
	protected function accept( PayPalMessageComponent $child ) {
		return $child instanceof PayPalMessagePrimitive;
	}

	/**
	 * @return	string
	 * @see		PayPalMessageComponent::draw()
	 */
	public function draw() {
		return sprintf( '%s=%s' , $this->name , $this->value->draw() );
	}
}