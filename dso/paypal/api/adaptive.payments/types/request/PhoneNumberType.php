<?php
require_once 'dso/paypal/api/adaptive.payments/types/AbstractPayPalType.php';

/**
 * A type to specify the receiver’s phone number. The PayRequest must pass
 * either an email address or a phone number as the payment receiver.
 */
class PhoneNumberType extends AbstractPayPalType {
	/**
	 * Telephone country code.
	 * @var	string
	 */
	private $countryCode;

	/**
	 * Telephone number.
	 * @var	string
	 */
	private $phoneNumber;

	/**
	 * Telephone extension.
	 * @var	string
	 */
	private $extension;

	/**
	 * Creates the object to specify the receiver’s phone number.
	 * @param	string $countryCode Telephone country code.
	 * @param	string $phoneNumber Telephone number.
	 * @param	string $extension Telephone extension.
	 */
	public function __construct( $countryCode , $phoneNumber , $extension = null ) {
		parent::__construct();

		$this->setCountryCode( $countryCode );
		$this->setPhoneNumber( $phoneNumber );
		$this->setExtension( $extension );
	}

	/**
	 * @return	string
	 */
	public function getCountryCode() {
		return $this->countryCode;
	}

	/**
	 * @return	string
	 */
	public function getPhoneNumber() {
		return $this->phoneNumber;
	}

	/**
	 * @return	string
	 */
	public function getExtension() {
		return $this->extension;
	}

	/**
	 * Sets the telephone country code.
	 * @param	string $countryCode
	 */
	public function setCountryCode( $countryCode ) {
		$this->countryCode = $countryCode;
	}

	/**
	 * Sets the telephone number.
	 * @param string $phoneNumber
	 */
	public function setPhoneNumber( $phoneNumber ) {
		$this->phoneNumber = $phoneNumber;
	}

	/**
	 * Sets the telephone extension.
	 * @param string $extension
	 */
	public function setExtension( $extension ) {
		$this->extension = $extension;
	}
}