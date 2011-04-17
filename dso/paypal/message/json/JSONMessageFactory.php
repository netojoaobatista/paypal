<?php
/**
 * Objects related with JSON message creation and composition
 * @author	João Batista Neto
 * @package	dso.paypal.message.json
 */

require_once 'dso/paypal/message/AbstractPayPalMessageFactory.php';
require_once 'dso/paypal/message/json/JSONMessageElement.php';
require_once 'dso/paypal/message/json/JSONMessageField.php';
require_once 'dso/paypal/message/json/JSONMessageList.php';
require_once 'dso/paypal/message/json/JSONMessagePrimitive.php';

/**
 * JSON message factory
 */
class JSONMessageFactory extends AbstractPayPalMessageFactory {
	/**
	 * @return	JSONMessageElement
	 * @see		AbstractPayPalMessageFactory::createMessageElement()
	 */
	public function createMessageElement( $name ) {
		return new JSONMessageElement( $name );
	}

	/**
	 * @param	string $name
	 * @param	PayPalMessageComponent $value
	 * @return	JSONMessageField
	 * @see		AbstractPayPalMessageFactory::createMessageField()
	 */
	public function createMessageField( $name , PayPalMessageComponent $value ) {
		return new JSONMessageField( $name , $value );
	}

	/**
	 * @return	JSONMessageList
	 * @see		AbstractPayPalMessageFactory::createMessageList()
	 */
	public function createMessageList( $name ) {
		return new JSONMessageList( $name );
	}

	/**
	 * @param	mixed $value
	 * @return	PayPalMessagePrimitive
	 * @see		AbstractPayPalMessageFactory::createMessagePrimitive()
	 */
	public function createMessagePrimitive( $value ) {
		return new JSONMessagePrimitive( $value );
	}
}