<?php
require_once 'dso/paypal/api/adaptive.payments/types/AbstractPayPalType.php';

/**
 * Receiver is the party whose account is credited.
 */
class Receiver extends AbstractPayPalType {
	/**
	 * Amount to be paid to the receiver.
	 * @var	float
	 */
	private $amount;

	/**
	 * Receiver’s email address.
	 * @var	string
	 */
	private $email;

	/**
	 * The invoice number for the payment. This data in this field shows
	 * on the Transaction Details report.
	 * @var	string
	 */
	private $invoiceId;

	/**
	 * The transaction type for the payment.
	 * @var	string
	 */
	private $paymentType;

	/**
	 * The transaction subtype for the payment.
	 * @var	string
	 */
	private $paymentSubType;

	/**
	 * The receiver’s phone number.
	 * @var	PhoneNumberType
	 */
	private $phone;

	/**
	 * Whether this receiver is the primary receiver, which makes the
	 * payment a chained payment.
	 * @var	boolean
	 */
	private $primary;

	/**
	 * Creates the Receiver object that represents the party whose account
	 * is credited.
	 * @param	float $amount Amount to be paid to the receiver.
	 * @param	string $email Receiver’s email address.
	 * @param	PhoneNumberType $phone Receiver’s phone number.
	 * @throws	UnexpectedValueException
	 * @throws	InvalidArgumentException
	 * @throws	LengthException
	 */
	public function __construct( $amount = null , $email = null , PhoneNumberType $phone = null ) {
		parent::__construct();

		if ( func_num_args() > 0 ) {
			$this->setAmount( $amount );

			if ( $email == null && $phone == null ) {
				throw new UnexpectedValueException( 'The PayRequest must pass either an email address or a phone number as the payment receiver' );
			} else {
				if ( $email != null ) {
					$this->setEmail( $email );
				}

				if ( $phone != null ) {
					$this->setPhone( $phone );
				}
			}
		}
	}

	/**
	 * @return	float
	 */
	public function getAmount() {
		return $this->amount;
	}

	/**
	 * @return	string
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * @return	string
	 */
	public function getInvoiceId() {
		return $this->invoiceId;
	}

	/**
	 * @return	string
	 */
	public function getPaymentType() {
		return $this->paymentType;
	}

	/**
	 * @return	string
	 */
	public function getPaymentSubType() {
		return $this->paymentSubType;
	}

	/**
	 * @return	PhuneNumberType
	 */
	public function getPhone() {
		return $this->phone;
	}

	/**
	 * @return	boolean
	 */
	public function isPrimary() {
		return $this->primary != null ? $this->primary === true : null;
	}

	/**
	 * Sets the amount to be paid to the receiver.
	 * @param	float $amount
	 * @throws	InvalidArgumentException
	 */
	public function setAmount( $amount ) {
		if ( is_numeric( $amount ) ) {
			$this->amount = (float) $amount;
		} else {
			throw new InvalidArgumentException( 'Invalid amount supplied: "' . $amount . '".' );
		}
	}

	/**
	 * Sets the receiver’s email address. This address can be unregistered
	 * with paypal.com. If so, a receiver cannot claim the payment until a
	 * PayPal account is linked to the email address. The PayRequest must
	 * pass either an email address or a phone number.<br /><br />
	 * <b>Maximum length:</b> 127 characters
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
			throw new LengthException( 'The supplied email address is too long.' );
		}
	}

	/**
	 * The invoice number for the payment. This data in this field shows
	 * on the Transaction Details report.<br /><br />
	 * <b>Maximum length:</b> 127 characters
	 * @param	string $invoiceId
	 */
	public function setInvoiceId( $invoiceId ) {
		if ( strlen( $invoiceId ) <= 127 ) {
			$this->invoiceId = $invoiceId;
		} else {
			throw new LengthException( 'The supplied invoiceId address is too long.' );
		}
	}

	/**
	 * The transaction type for the payment<br /><br />
	 * <b>Allowable values are:</b>
	 * <ul>
	 * <li><b>GOODS</b> – This is a payment for non-digital goods</li>
	 * <li><b>SERVICE</b> – This is a payment for services <b>(default)</b></li>
	 * <li><b>PERSONAL</b> – This is a person-to-person payment</li>
	 * <li><b>CASHADVANCE</b> – This is a person-to-person payment for a cash advance</li>
	 * <li><b>DIGITALGOODS</b> – This is a payment for digital goods</li>
	 * </ul>
	 * <b>N O TE :</b><br />
	 * Person-to-person payments are valid only for parallel payments that
	 * have the feesPayer field set to <b>EACHRECEIVER</b> or <b>SENDER</b>.
	 * @param	string $paymentType
	 * @throws	InvalidArgumentException
	 */
	public function setPaymentType( $paymentType ) {
		switch ( $paymentType ) {
			case 'GOODS':
			case 'SERVICE':
			case 'PERSONAL':
			case 'CASHADVANCE':
			case 'DIGITALGOODS':
				$this->paymentType = $paymentType;
				break;
			default :
				throw new InvalidArgumentException( 'Invalid paymentType supplied: "' . $paymentType . '".' );
		}
	}

	/**
	 * The transaction subtype for the payment.
	 * @param	string $paymentSubType
	 */
	public function setPaymentSubType( $paymentSubType ) {
		$this->paymentSubType = $paymentSubType;
	}

	/**
	 * The receiver’s phone number. The PayRequest must pass
	 * either an email address or a phone number as the payment receiver.
	 * @param	PhoneNumberType $phone
	 */
	public function setPhone( PhoneNumberType $phone ) {
		$this->phone = $phone;
	}

	/**
	 * Sets this receiver as the primary receiver, which makes the
	 * payment a chained payment. You can specify at most one primary receiver.
	 * <b>Omit this field for simple and parallel payments.</b>
	 * @param	boolean $primary
	 */
	public function setPrimary( $primary ) {
		$this->primary = $primary === true;
	}
}