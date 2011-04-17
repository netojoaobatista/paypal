<?php
/**
 * Objects related with message creation and composition
 * @author	João Batista Neto
 * @package	dso.paypal.message
 */

require_once 'dso/paypal/message/PayPalMessageComponent.php';

/**
 * A PayPalMessageComponent that can contains other components.
 */
abstract class PayPalMessageContainer extends PayPalMessageComponent {
	/**
	 * @var	array[PayPalMessageComponent]
	 */
	protected $children = array();

	/**
	 * For invocation by subclass constructors.
	 */
	public function __construct() {
		parent::__construct( false );
	}

	/**
	 * Checks whether a child is acceptable for this container.
	 * This implementation always returns true
	 * @param	PayPalMessage $child
	 * @return	boolean
	 */
	protected function accept( PayPalMessageComponent $child ) {
		return true;
	}

	/**
	 * Adds a child PayPalMessageComponent instance to this container.
	 * @param	PayPalMessageComponent $child
	 */
	public function addChild( PayPalMessageComponent $child ) {
		if ( $this->accept( $child ) ) {
			$this->children[] = $child;
			$child->setParent( $this );
		} else {
			throw new RuntimeException( 'The "' . $child->getClass()->getName() . '" was not accepted by the "' . $this->getClass()->getName() . '" container.' );
		}
	}

	/**
	 * Retrieves an array with the containers children.
	 * @return	array[PayPalMessageComponent]
	 */
	protected function toArray() {
		return $this->children;
	}
}