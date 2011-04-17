<?php
/**
 * Objects related with message creation and composition
 * @author	João Batista Neto
 * @package	dso.paypal.message
 */

require_once 'dso/paypal/message/PayPalMessageContainer.php';

/**
 * Interface to define a message component that represents
 * a list of other components.
 */
abstract class PayPalMessageList extends PayPalMessageContainer {
	/**
	 * @var	string
	 */
	protected $name;

	/**
	 * @param	string $name
	 */
	public function __construct( $name = null ) {
		parent::__construct( false );

		$this->name = $name;
	}
}