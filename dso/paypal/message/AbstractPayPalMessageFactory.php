<?php
/**
 * Objects related with message creation and composition
 * @author	João Batista Neto
 * @package	dso.paypal.message
 */

require_once 'rpo/core/Object.php';

/**
 * Abstract factory to create ou parse abstract message elements.
 */
abstract class AbstractPayPalMessageFactory extends Object {
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Creates an abstract product that represents an array.
	 * @param	string $name The name of the element.
	 * @return	PayPalMessageElement
	 */
	public abstract function createMessageElement( $name );

	/**
	 * Creates an abstract product that represents a pair field-value.
	 * @param	string $name
	 * @param	PayPalMessageComponent $value
	 * @return	PayPalMessageField
	 */
	public abstract function createMessageField( $name , PayPalMessageComponent $value );

	/**
	 * Creates an abstract product that represents a list.
	 * * @param	string $name The name of the list.
	 * @return	PayPalMessageList
	 */
	public abstract function createMessageList( $name );

	/**
	 * Creates an abstract product that represents a primitive
	 * value.
	 * @param	mixed $value
	 * @return	PayPalMessagePrimitive
	 */
	public abstract function createMessagePrimitive( $value );
}