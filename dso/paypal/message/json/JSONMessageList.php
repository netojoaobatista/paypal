<?php
/**
 * Objects related with JSON message creation and composition
 * @author	João Batista Neto
 * @package	dso.paypal.message.json
 */

require_once 'dso/paypal/message/PayPalMessageList.php';

/**
 *
 */
class JSONMessageList extends PayPalMessageList {
	/**
	 * @return	string
	 * @see		PayPalMessageComponent::draw()
	 */
	public function draw() {
		if ( $this->name == null ) {
			return '[' . implode( ',' , $this->toArray() ) . ']';
		} else {
			$list = '"' . addcslashes( $this->name , '"' ) . '": [' . implode( ',' , $this->toArray() ) . ']';

			if ( !$this->hasParent() ) {
				$list = '{' . $list . '}';
			}

			return $list;
		}
	}
}