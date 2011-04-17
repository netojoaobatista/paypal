<?php
require_once 'dso/paypal/api/adaptive.payments/types/AbstractPayPalType.php';

/**
 * Information about the receivers of the payment.
 */
class ReceiverList extends AbstractPayPalType {
	/**
	 * Receiver is the party whose account is credited.
	 * @var	array[Receiver]
	 */
	private $receiver = array();

	/**
	 * The receiver whose account is credited.
	 * @param	integer $n An integer between 0 and 5 for a maximum of 6 receivers
	 * @return	Receiver
	 * @throws	OutOfRangeException
	 * @throws	InvalidArgumentException
	 */
	public function receiver( $n ) {
		if ( is_int( $n ) ) {
			if ( $n >= 0 && $n <= 5 ) {
				if ( !isset( $this->receiver[ $n ] ) ) {
					$this->receiver[ $n ] = new Receiver();
				}

				return $this->receiver[ $n ];
			} else {
				throw new OutOfRangeException( 'The receiver’s offset must an integer between 0 and 5 for a maximum of 6 receivers' );
			}
		} else {
			throw new InvalidArgumentException( 'The receiver offset must be an integer between 0 and 5.' );
		}
	}
}