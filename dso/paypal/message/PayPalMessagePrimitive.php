<?php
/**
 * Objects related with message creation and composition
 * @author	João Batista Neto
 * @package	dso.paypal.message
 */

require_once 'dso/paypal/message/PayPalMessageComponent.php';

/**
 * Interface to define a message component that represents a primitive value.
 */
abstract class PayPalMessagePrimitive extends PayPalMessageComponent {
	/**
	 * @var	mixed
	 */
	protected $value;

	/**
	 * @var	string
	 */
	protected $type;

	/**
	 * Creates a PayPalMessageComponent that represents a primitive value.
	 * @param	mixed $value
	 * @throws	InvalidArgumentException
	 */
	public function __construct( $value ) {
		parent::__construct( true );

		$type = gettype( $value );

		switch ( $type ){
			case 'boolean' :
			case 'double' :
			case 'float' :
			case 'integer' :
			case 'string' :
				$this->value = $value;
				$this->type = $type;
				break;
			default :
				throw new InvalidArgumentException( 'Only primitive values are allowed, (' . $type . ') >' . $value . '< given.' );
		}
	}
}