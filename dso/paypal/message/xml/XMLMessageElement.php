<?php
/**
 * Objects related with JSON message creation and composition
 * @author	João Batista Neto
 * @package	dso.paypal.message.json
 */

require_once 'dso/paypal/message/PayPalMessageElement.php';

/**
 *
 */
class XMLMessageElement extends PayPalMessageElement {
	/**
	 * @return	string
	 * @see		PayPalMessageComponent::draw()
	 */
	public function draw() {
		$fields = array();
		$children = array();

		foreach ( $this->children as $child ) {
			if ( $child instanceof PayPalMessageField ) {
				$fields[] = $child;
			} else {
				$children[] = $child;
			}
		}

		return sprintf( '<%s %s>%s</%s>' , $this->name , implode( ' ' , $fields ) , implode( '' , $children ) , $this->name );
	}
}