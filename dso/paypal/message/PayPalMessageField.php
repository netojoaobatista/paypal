<?php
require_once 'dso/paypal/message/PayPalMessageComponent.php';

/**
 */
abstract class PayPalMessageField extends PayPalMessageComponent {
	/**
	 * @var	string
	 */
	protected $name;

	/**
	 * @var	PayPalMessageComponent
	 */
	protected $value;

	/**
	 * Creates the PayPal message field object
	 * @param	string $name The fields name.
	 * @param	PayPalMessageComponent $value The fields value.
	 * @throws	LogicException
	 */
	public function __construct( $name , PayPalMessageComponent $value ) {
		parent::__construct( true );

		if ( $value instanceof PayPalMessageField ) {
			throw new LogicException( 'The value of a PayPalMessageField cannot be an instance of PayPalMessageField.' );
		} else {
			$this->name = $name;
			$this->value = $value;
		}
	}
}