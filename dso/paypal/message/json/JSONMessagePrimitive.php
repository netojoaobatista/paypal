<?php
/**
 * Objects related with JSON message creation and composition
 * @author	João Batista Neto
 * @package	dso.paypal.message.json
 */

require_once 'dso/paypal/message/PayPalMessagePrimitive.php';

/**
 *
 */
class JSONMessagePrimitive extends PayPalMessagePrimitive {
	/**
	 * @return	string
	 * @see		PayPalMessageComponent::draw()
	 */
	public function draw() {
		switch ( $this->type ) {
			case 'boolean' :
				return $this->value ? 'true' : 'false';
			case 'double' :
			case 'float' :
			case 'integer':
				return (string) $this->value;
			case 'string' :
				return '"' . addcslashes( $this->value , '"' ) . '"';
		}
	}
}