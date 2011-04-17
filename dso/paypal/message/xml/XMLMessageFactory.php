<?php
require_once 'dso/paypal/message/AbstractPayPalMessageFactory.php';
require_once 'dso/paypal/message/xml/XMLMessageElement.php';
require_once 'dso/paypal/message/xml/XMLMessageField.php';
require_once 'dso/paypal/message/xml/XMLMessagePrimitive.php';

/**
 *
 */
class XMLMessageFactory extends AbstractPayPalMessageFactory {
	/**
	 * @return	PayPalMessageElement
	 * @see		AbstractPayPalMessageFactory::createMessageElement()
	 */
	public function createMessageElement( $name = null ) {
		return new XMLMessageElement( $name );
	}

	/**
	 * @param	string $name
	 * @param	PayPalMessageComponent $value
	 * @return	PayPalMessageField
	 * @see		AbstractPayPalMessageFactory::createMessageField()
	 */
	public function createMessageField( $name , PayPalMessageComponent $value ) {
		return new XMLMessageField( $name , $value );
	}

	/**
	 * @return	PayPalMessageList
	 * @see		AbstractPayPalMessageFactory::createMessageList()
	 */
	public function createMessageList( $name = null ) {
		return new XMLMessageElement( $name );
	}

	/**
	 * @param	mixed $value
	 * @return	PayPalMessagePrimitive
	 * @see		AbstractPayPalMessageFactory::createMessagePrimitive()
	 */
	public function createMessagePrimitive( $value ) {
		return new XMLMessagePrimitive( $value );
	}
}