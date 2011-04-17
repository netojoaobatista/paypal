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
class XMLMessagePrimitive extends PayPalMessagePrimitive {
	/**
	 * @return	string
	 * @see		PayPalMessageComponent::draw()
	 */
	public function draw() {
		$value = null;

		switch ( $this->type ) {
			case 'boolean' :
				$value = $this->value ? 'true' : 'false';
			case 'float' :
			case 'integer':
				$value = (string) $this->value;
			case 'string' :
				$value = addcslashes( $this->value , '"' );
		}

		return '"' . $value . '"';
	}
}