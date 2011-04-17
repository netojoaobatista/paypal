<?php
/**
 * Objects related with message creation and composition
 * @author	João Batista Neto
 * @package	dso.paypal.message
 */

require_once 'rpo/core/Object.php';

/**
 * This is the main class to creates a composition that represents
 * the request message of any of the PayPal API operations.
 */
abstract class PayPalMessageComponent extends Object {
	/**
	 * Identify this component as a leaf, that cannot have children.
	 * @var	boolean
	 */
	protected $isLeaf = true;

	/**
	 * @var PayPalMessageComponent
	 */
	protected $parent;

	/**
	 * For invocation by subclass constructors.
	 * @param	boolean $isLeaf
	 */
	public function __construct( $isLeaf ) {
		parent::__construct();

		$this->isLeaf = $isLeaf === true;
	}

	/**
	 * @return	string
	 * @see		Object::__toString()
	 */
	public function __toString() {
		return $this->draw();
	}

	/**
	 * Draws the message.
	 * @return	string
	 */
	abstract public function draw();

	/**
	 * Checks is this component has a parent.
	 * @return	boolean
	 */
	public function hasParent() {
		return $this->parent != null;
	}

	/**
	 * Checks if this component is a leaf, that cannot have children.
	 * @return	boolean
	 */
	public function isLeaf() {
		return $this->isLeaf;
	}

	/**
	 * Defines this components parent.
	 * @param	PayPalMessageComponent $parent
	 * @throws	LogicException
	 */
	public function setParent( PayPalMessageComponent $parent ) {
		if ( $this->parent == null ) {
			$this->parent = $parent;
		} else {
			throw new LogicException( 'This component already has a parent.' );
		}
	}
}