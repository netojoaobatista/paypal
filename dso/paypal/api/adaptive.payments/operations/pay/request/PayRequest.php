<?php
/**
 * Request related objects of pay operation.
 * @author	João Batista Neto
 * @package	dso.paypal.api.adaptative.payments.operations.pay.request
 */

require_once 'dso/paypal/api/adaptive.payments/types/PayPalRequest.php';

/**
 * The PayRequest contains the instructions required to make a payment.
 */
class PayRequest extends PayPalRequest {
	/**
	 * Use this option if you are not using the Pay request in
	 * combination with ExecutePayment.
	 */
	const ACTION_PAY = 'PAY';

	/**
	 * Use this option to set up the payment instructions with
	 * SetPaymentOptions and then execute the payment at a later
	 * time with the ExecutePayment.
	 */
	const ACTION_CREATE = 'CREATE';

	/**
	 * For chained payments only, specify this value to delay payments
	 * to the secondary receivers; only the payment to the primary
	 * receiver is processed.
	 */
	const ACTION_PAY_PRIMARY = 'PAY_PRIMARY';

	/**
	 * The action for this request, possible values are:
	 * <ul>
	 * <li><b>PAY</b> – Use this option if you are not using the Pay
	 * request in combination with ExecutePayment.</li>
	 * <li><b>CREATE</b> – Use this option to set up the payment
	 * instructions with SetPaymentOptions and then execute the
	 * payment at a later time with the ExecutePayment.</li>
	 * <li><b>PAY_PRIMARY</b> – For chained payments only, specify
	 * this value to delay payments to the secondary receivers; only
	 * the payment to the primary receiver is processed.</li>
	 * </ul>
	 * @var	string
	 */
	private $actionType;

	/**
	 * URL to redirect the sender’s browser to after canceling the
	 * approval for a payment; it is always required but only used
	 * for payments that require approval (explicit payments)
	 * @var	string
	 */
	private $cancelUrl;

	/**
	 * Information about the sender.
	 * @var	ClientDetails
	 */
	private $clientDetails;

	/**
	 * The code for the currency in which the payment is made;
	 * you can specify only one currency, regardless of the number
	 * of receivers.
	 * @var	CurrencyCode
	 */
	private $currencyCode;

	/**
	 * The payer of PayPal fees. Allowable values are:
	 * <ul>
	 * <li><b>SENDER</b> – Sender pays all fees (for personal, implicit
	 * simple/parallel payments; do not use for chained or unilateral
	 * payments)</li>
	 * <li><b>PRIMARYRECEIVER</b> – Primary receiver pays all fees (chained
	 * payments only)</li>
	 * <li><b>EACHRECEIVER</b> – Each receiver pays their own fee (default,
	 * personal and unilateral payments)</li>
	 * <li><b>SECONDARYONLY</b> – Secondary receivers pay all fees (use only
	 * for chained payments with one secondary receiver)</li>
	 * </ul>
	 * @var	string
	 */
	private $feesPayer;

	/**
	 * Specifies a list of allowed funding types for the payment. This is a
	 * list of funding selections that can be combined in any order to allow
	 * payments to use the indicated funding type. If this Parameter is omitted,
	 * the payment can be funded by any funding type that is supported for
	 * Adaptive Payments<br />
	 * <b>NOTE :</b><br />
	 * FundingConstraint is unavailable to API callers with standard permission
	 * levels; for more information, refer to the section Adaptive Payments
	 * Permission Levels.
	 * @var	FundingConstraint
	 */
	private $fundingConstraint;

	/**
	 * The URL to which you want all IPN messages for this payment to
	 * be sent.
	 * @var	string
	 */
	private $ipnNotificationUrl;

	/**
	 * A note associated with the payment <b>(text, not HTML)</b>.
	 * @var	string
	 */
	private $memo;

	/**
	 * Sender’s personal identification number, if one was
	 * specified when the sender agreed to the approval.
	 * @var	string
	 */
	private $pin;

	/**
	 * Preapproval key for the approval set up between you and the
	 * sender.
	 * @var	string
	 */
	private $preaprovalKey;

	/**
	 * Information about the receivers of the payment.
	 * @var	ReceiverList
	 */
	private $receiverList;

	/**
	 * URL to redirect the sender’s browser to after the sender has
	 * logged into PayPal and approved a payment; it is always
	 * required but only used if a payment requires explicit
	 * approval.
	 * @var	string
	 */
	private $returnUrl;

	/**
	 * Whether to reverse parallel payments if an error occurs with a
	 * payment.
	 * @var boolean
	 */
	private $reverseAllParallelPaymentsOnError;

	/**
	 * Sender’s identifying information.
	 * @var SenderIdentifier
	 */
	private $sender;

	/**
	 * Sender’s email address.
	 * @var	string
	 */
	private $senderEmail;

	/**
	 * A unique ID that you specify to track the payment.
	 * @var	string
	 */
	private $trackingId;

	/**
	 * Information about the sender.
	 * @return	ClientDetails
	 */
	public function clientDetails() {
		if ( $this->clientDetails == null ) {
			$this->clientDetails = new ClientDetails();
		}

		return $this->clientDetails;
	}

	/**
	 * Specifies a list of allowed funding types for the payment.
	 * @return	FundingConstraint
	 */
	public function fundingConstraint() {
		if ( $this->fundingConstraint == null ) {
			$this->fundingConstraint = new FundingConstraint();
		}

		return $this->fundingConstraint;
	}

	/**
	 * @return	string
	 */
	public function getActionType() {
		return $this->actionType;
	}

	/**
	 * @return	string
	 */
	public function getCancelUrl() {
		return $this->cancelUrl;
	}

	/**
	 * @return	ClientDetails
	 */
	public function getClientDetails() {
		return $this->clientDetails;
	}

	/**
	 * @return	CurrencyCode
	 */
	public function getCurrencyCode() {
		return $this->currencyCode;
	}

	/**
	 * @return	string
	 */
	public function getFeesPayer() {
		return $this->feesPayer;
	}

	/**
	 * @return	FundingConstraint
	 */
	public function getFundingConstraint() {
		return $this->fundingConstraint;
	}

	/**
	 * @return	string
	 */
	public function getIpnNotificationUrl() {
		return $this->ipnNotificationUrl;
	}

	/**
	 * @return	string
	 */
	public function getMemo() {
		return $this->memo;
	}

	/**
	 * @return	string
	 */
	public function getPin() {
		return $this->pin;
	}

	/**
	 * @return	string
	 */
	public function getPreaprovalKey() {
		return $this->preaprovalKey;
	}

	/**
	 * @return	ReceiverList
	 */
	public function getReceiverList() {
		return $this->receiverList;
	}

	/**
	 * @return	string
	 */
	public function getReturnUrl() {
		return $this->returnUrl;
	}

	/**
	 * @return	boolean
	 */
	public function getReverseAllParallelPaymentsOnError() {
		return $this->reverseAllParallelPaymentsOnError;
	}

	/**
	 * @return	SenderIdentifier
	 */
	public function getSender() {
		return $this->sender;
	}

	/**
	 * @return	string
	 */
	public function getSenderEmail() {
		return $this->senderEmail;
	}

	/**
	 * @return	string
	 */
	public function getTrackingId() {
		return $this->trackingId;
	}

	/**
	 * Information about the receivers of the payment.
	 * @return	ReceiverList
	 */
	public function receiverList() {
		if ( $this->receiverList == null ) {
			$this->receiverList = new ReceiverList();
		}

		return $this->receiverList;
	}

	/**
	 * Sender’s identifying information.
	 * @return	SenderIdentifier
	 */
	public function sender() {
		if ( $this->sender == null ) {
			$this->sender = new SenderIdentifier();
		}

		return $this->sender;
	}

	/**
	 * Whether to reverse parallel payments if an error occurs with a payment.
	 * @param	boolean $reverseAllParallelPaymentsOnError
	 * <ul>
	 * <li><b>true</b> – Each parallel payment is reversed if an error occurs</li>
	 * <li><b>false</b> – Only incomplete payments are reversed <b>(default)</b></li>
	 * </ul>
	 */
	public function reverseAllParallelPaymentsOnError( $reverseAllParallelPaymentsOnError ) {
		$this->reverseAllParallelPaymentsOnError = $reverseAllParallelPaymentsOnError === true;
	}

	/**
	 * Whether the Pay request pays the receiver or whether the Pay request
	 * is set up to create a payment request, but not fulfill the payment until
	 * the ExecutePayment is called.
	 * @param	string $actionType
	 * @throws InvalidArgumentException
	 */
	public function setActionType( $actionType ) {
		switch ( $actionType ) {
			case PayRequest::ACTION_CREATE:
			case PayRequest::ACTION_PAY:
			case PayRequest::ACTION_PAY_PRIMARY:
				$this->actionType = $actionType;
				break;
			default :
				throw new InvalidArgumentException( 'Invalid action type supplied: "' . $actionType . '".' );
		}
	}

	/**
	 * The URL to which the sender’s browser is redirected if the sender
	 * cancels the approval for the payment after logging in to paypal.com
	 * to approve the payment. <b>Specify the URL with the HTTP or HTTPS</b><br />.
	 * <b>Maximum length:</b> 1024 characters
	 * @param	string $cancelUrl
	 * @throws	InvalidArgumentException
	 * @throws	LengthException
	 */
	public function setCancelUrl( $cancelUrl ) {
		if ( strlen( $cancelUrl ) <= 1024 ) {
			if ( filter_var( $cancelUrl , FILTER_VALIDATE_URL ) ) {
				$this->cancelUrl = $cancelUrl;
			} else {
				throw new InvalidArgumentException( 'The cancel url supplied is invalid: "' . $cancelUrl . '".' );
			}
		} else {
			throw new LengthException( 'The cancel url supplied is too long.' );
		}
	}

	/**
	 *  Information about the sender.
	 * @param	ClientDetails $clientDetails
	 */
	public function setClientDetails( ClientDetails $clientDetails ) {
		$this->clientDetails = $clientDetails;
	}

	/**
	 * The currency code.
	 * @param	CurrencyCode $currencyCode
	 */
	public function setCurrencyCode( CurrencyCode $currencyCode ) {
		$this->currencyCode = $currencyCode;
	}

	/**
	 * The payer of PayPal fees<br /><br />
	 * <b>Allowable values are:</b>
	 * <ul>
	 * <li><b>SENDER</b> – Sender pays all fees (for personal, implicit
	 * simple/parallel payments; do not use for chained or unilateral payments)</li>
	 * <li><b>PRIMARYRECEIVER</b> – Primary receiver pays all fees (chained payments only)</li>
	 * <li><b>EACHRECEIVER</b> – Each receiver pays their own fee (default, personal and
	 * unilateral payments)</li>
	 * <li><b>SECONDARYONLY</b> – Secondary receivers pay all fees (use only for chained
	 * payments with one secondary receiver)</li>
	 * </ul>
	 * @param	string $feesPayer
	 * @throws	InvalidArgumentException
	 */
	public function setFeesPayer( $feesPayer ) {
		switch ( $feesPayer ) {
			case 'SENDER' :
			case 'PRIMARYRECEIVER' :
			case 'EACHRECEIVER' :
			case 'SECONDARYONLY' :
				$this->feesPayer = $feesPayer;
				break;
			default :
				throw new InvalidArgumentException( 'Invalid payer of PayPal fees supplied.' );
		}
	}

	/**
	 * Specifies a list of allowed funding types for the payment
	 * @param	FundingConstraint $fundingConstraint
	 */
	public function setFundingConstraint( FundingConstraint $fundingConstraint ) {
		$this->fundingConstraint = $fundingConstraint;
	}

	/**
	 * The URL to which you want all IPN messages for this payment to
	 * be sent.<br />
	 * <b>Maximum length:</b> 1024 characters
	 * @param	string $ipnNotificationUrl
	 * @throws	InvalidArgumentException
	 * @throws	LengthException
	 */
	public function setIpnNotificationUrl( $ipnNotificationUrl ) {
		if ( strlen( $ipnNotificationUrl ) <= 1024 ) {
			if ( filter_var( $ipnNotificationUrl , FILTER_VALIDATE_URL ) ) {
				$this->ipnNotificationUrl = $ipnNotificationUrl;
			} else {
				throw new InvalidArgumentException( 'The supplied IPN notification url is invalid: "' . $ipnNotificationUrl . '".' );
			}
		} else {
			throw new LengthException( 'The supplied IPN notification url is too long.' );
		}
	}

	/**
	 * A note associated with the payment (text, not HTML).
	 * <b>Maximum length:</b> 1000 characters, including newline characters
	 * @param	string $memo
	 * @throws	LengthException
	 */
	public function setMemo( $memo ) {
		if ( strlen( $memo ) <= 1000 ) {
			$this->memo = $memo;
		} else {
			throw new LengthException( 'The supplied memo note is too long.' );
		}
	}

	/**
	 * The sender’s personal identification number, which was specified
	 * when the sender signed up for a preapproval.
	 * @param	string $pin
	 */
	public function setPin( $pin ) {
		$this->pin = $pin;
	}

	/**
	 * The key associated with a preapproval for this payment. The
	 * preapproval key is required if this is a preapproved payment.<br /><br />
	 * <b>N O TE :</b><br />
	 * The Preapproval API is unavailable to API callers with Standard
	 * permission levels.
	 * @param string $preaprovalKey
	 */
	public function setPreaprovalKey( $preaprovalKey ) {
		$this->preaprovalKey = $preaprovalKey;
	}

	/**
	 *  Information about the receivers of the payment.
	 * @param	ReceiverList $receiverList
	 */
	public function setReceiverList( ReceiverList $receiverList ) {
		$this->receiverList = $receiverList;
	}

	/**
	 * The URL to which the sender’s browser is redirected after
	 * approving a payment on paypal.com. <b>Specify the URL with the HTTP or
	 * HTTPS designator.</b><br />
	 * <b>Maximum length:</b> 1024 characters
	 * @param	string $returnUrl
	 * @throws	InvalidArgumentException
	 * @throws	LengthException
	 */
	public function setReturnUrl( $returnUrl ) {
		if ( strlen( $returnUrl ) <= 1024 ) {
			if ( filter_var( $returnUrl , FILTER_VALIDATE_URL ) ) {
				$this->returnUrl = $returnUrl;
			} else {
				throw new InvalidArgumentException( 'The supplied return url is invalid: "' . $returnUrl . '".' );
			}
		} else {
			throw new LengthException( 'The supplied return url is too long.' );
		}
	}

	/**
	 * Sender’s identifying information.
	 * @param	SenderIdentifier $sender
	 */
	public function setSender( SenderIdentifier $sender ) {
		$this->sender = $sender;
	}

	/**
	 * Sender’s email address.<br />
	 * <b>Maximum length:</b> 127 characters
	 * @param	string $senderEmail
	 * @throws	InvalidArgumentException
	 * @throws	LengthException
	 */
	public function setSenderEmail( $senderEmail ) {
		if ( strlen( $senderEmail ) <= 127 ) {
			if ( filter_var( $senderEmail , FILTER_VALIDATE_EMAIL ) ) {
				$this->senderEmail = $senderEmail;
			} else {
				throw new InvalidArgumentException( 'The supplied sender email address is invalid: "' . $senderEmail . '".' );
			}
		} else {
			throw new LengthException( 'The supplied sender email address is too long.' );
		}
	}

	/**
	 * A unique ID that you specify to track the payment.<br />
	 * <b>N O TE :</b><br />
	 * You are responsible for ensuring that the ID is unique.<br />
	 * <b>Maximum length:</b> 127 characters
	 * @param	string $trackingId
	 * @throws	LengthException
	 */
	public function setTrackingId( $trackingId ) {
		if ( strlen( $trackingId ) <= 127 ) {
			$this->trackingId = $trackingId;
		} else {
			throw new LengthException( 'The supplied tracking id is too long' );
		}
	}
}