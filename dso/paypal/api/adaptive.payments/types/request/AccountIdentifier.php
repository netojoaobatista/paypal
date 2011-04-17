<?php
require_once 'dso/paypal/api/adaptive.payments/types/AbstractPayPalType.php';

/**
 *
 */
class AccountIdentifier extends AbstractPayPalType {
	/**
	 *  Sender’s email address.
	 * @var	string
	 */
	private $email;

	/**
	 * Sender’s phone number.
	 * @var	PhoneNumberType
	 */
	private $phone;

	/**
	 * @return	string
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * @return	PhoneNumberType
	 */
	public function getPhone() {
		return $this->phone;
	}

	/**
	 * Set the sender's email address<br />
	 * <b>Maximum length:</b> 127 characters.
	 * @param	string $email
	 * @throws	InvalidArgumentException
	 * @throws	LengthException
	 */
	public function setEmail( $email ) {
		if ( strlen( $email ) <= 127 ) {
			if ( filter_var( $email , FILTER_VALIDATE_EMAIL ) ) {
				$this->email = $email;
			} else {
				throw new InvalidArgumentException( 'Invalid email supplied: "' . $email . '".' );
			}
		} else {
			throw new LengthException( 'Supplied email address is too long.' );
		}
	}

	/**
	 * Set the sender's phone number
	 * @param	PhoneNumberType $phone
	 */
	public function setPhone( PhoneNumberType $phone ) {
		$this->phone = $phone;
	}
}