<?php
require_once 'rpo/core/Object.php';

/**
 *
 */
class PayRequestMessageBuilder extends Object {
	/**
	 * @var	PayPalMessageContainer
	 */
	private $message;

	/**
	 * Creates the builder instance to build the request message
	 * @param	PayRequest $payRequest
	 * @param	AbstractPayPalMessageFactory $factory
	 */
	public function __construct( PayRequest $payRequest , AbstractPayPalMessageFactory $factory ) {
		parent::__construct();

		$this->buildPayRequest( $payRequest , $factory );
	}

	private function buildPayRequest( PayRequest $request , AbstractPayPalMessageFactory $factory ) {
		$this->message = $factory->createMessageElement();
		$this->message->addChild( $factory->createMessageField( 'actionType' , $factory->createMessagePrimitive( $request->getActionType() ) ) );
		$this->message->addChild( $factory->createMessageField( 'cancelUrl' , $factory->createMessagePrimitive( $request->getCancelUrl() ) ) );

		if ( $request->getClientDetails() != null ) {
			$this->message->addChild( $factory->createMessageField( 'clientDetails' , $this->buildClientDetails( $request->clientDetails() ) ) );
		}

		$this->message->addChild( $factory->createMessageField( 'currencyCode' , $factory->createMessagePrimitive( $request->currencyCode()->value() ) ) );

		if ( $request->receiverList()->count() > 0 ) {
			$this->message->addChild( $factory->createMessageField( 'receiverList' , $this->buildReceiverList( $request->receiverList() , $factory ) ) );
		} else {
			throw new RuntimeException( 'You are *required* to specify at least one receiver' );
		}

		$this->message->addChild( $factory->createMessageField( 'returnUrl' , $factory->createMessagePrimitive( $request->getReturnUrl() ) ) );
		$this->message->addChild( $factory->createMessageField( 'requestEnvelope' , $this->buildRequestEnvelope( $request->requestEnvelope() , $factory ) ) );
	}

	private function buildClientDetails( ClientDetails $clientDetails , AbstractPayPalMessageFactory $factory ) {

	}

	private function buildReceiverList( ReceiverList $receiverList , AbstractPayPalMessageFactory $factory ) {
		$receiverElement = $factory->createMessageList();

		foreach ( $receiverList->getIterator() as $receiver ) {
			$receiverElement->addChild( $this->buildReceiver( $receiver , $factory ) );
		}

		$receiverListElement = $factory->createMessageElement();
		$receiverListElement->addChild( $factory->createMessageField( 'receiver' , $receiverElement ) );

		return $receiverListElement;
	}

	private function buildReceiver( Receiver $receiver , AbstractPayPalMessageFactory $factory ) {
		$receiverAmount = $receiver->getAmount();
		$receiverEmail = $receiver->getEmail();
		$receiverInvoiceId = $receiver->getInvoiceId();
		$receiverPaymentType = $receiver->getPaymentType();
		$receiverPaymentSubType = $receiver->getPaymentSubType();
		$receiverPhone = $receiver->getPhone();
		$receiverPrimary = $receiver->isPrimary();

		if ( $receiverEmail == null && $receiverPhone == null ) {
			throw new RuntimeException( 'You are *required* to specify the Receiver\'s email or the phone number.' );
		} else {
			$receiverElement = $factory->createMessageElement();
			$receiverElement->addChild( $factory->createMessageField( 'amount' , $factory->createMessagePrimitive( $receiverAmount ) ) );

			if ( $receiverEmail != null ) {
				$receiverElement->addChild( $factory->createMessageField( 'email' , $factory->createMessagePrimitive( $receiverEmail ) ) );
			}

			if ( $receiverInvoiceId != null ) {
				$receiverElement->addChild( $factory->createMessageField( 'invoiceId' , $factory->createMessagePrimitive( $receiverInvoiceId ) ) );
			}

			if ( $receiverPaymentType != null ) {
				$receiverElement->addChild( $factory->createMessageField( 'paymentType' , $factory->createMessagePrimitive( $receiverPaymentType ) ) );
			}

			if ( $receiverPaymentSubType != null ) {
				$receiverElement->addChild( $factory->createMessageField( 'paymentSubType' , $factory->createMessagePrimitive( $receiverPaymentSubType ) ) );
			}

			if ( $receiverPhone != null ) {
				$receiverElement->addChild( $factory->createMessageField( 'phone' , $this->buildPhoneNumber( $receiverPhone , $factory ) ) );
			}

			if ( $receiverPrimary != null ) {
				$receiverElement->addChild( $factory->createMessageField( 'primary' , $factory->createMessagePrimitive( $receiverPrimary ) ) );
			}

			return $receiverElement;
		}
	}

	private function buildPhoneNumber( PhoneNumberType $phoneNumber , AbstractPayPalMessageFactory $factory ) {
		$phoneElement = $factory->createMessageElement();
		$phoneElement->addChild( $factory->createMessageField( 'countryCode' , $phoneNumber->getCountryCode() ) );
		$phoneElement->addChild( $factory->createMessageField( 'phoneNumber' , $phoneNumber->getPhoneNumber() ) );

		if ( ( $phoneExtension = $phoneNumber->getExtension() ) != null ) {
			$phoneElement->addChild( $factory->createMessageField( 'extension' , $phoneExtension ) );
		}

		return $phoneElement;
	}

	private function buildRequestEnvelope( RequestEnvelope $requestEnvelope , AbstractPayPalMessageFactory $factory ) {
		$requestEnvelopeElement = $factory->createMessageElement();
		$requestEnvelopeElement->addChild( $factory->createMessageField( 'errorLanguage' , $factory->createMessagePrimitive( $requestEnvelope->getErrorLanguage() ) ) );
		$requestEnvelopeElement->addChild( $factory->createMessageField( 'detailLevel' , $factory->createMessagePrimitive( $requestEnvelope->getDetailLevel() ) ) );

		return $requestEnvelopeElement;
	}

	/**
	 * Gets the request message
	 * @return	PayPalMessageComponent
	 */
	public function getMessage() {
		return $this->message;
	}
}