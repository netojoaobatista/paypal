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

	private function buildClientDetails( ClientDetails $clientDetails , AbstractPayPalMessageFactory $factory ) {
		$applicationId = $clientDetails->getApplicationId();
		$customerId = $clientDetails->getCustomerId();
		$customerType = $clientDetails->getCustomerType();
		$deviceId = $clientDetails->getDeviceId();
		$geoLocation = $clientDetails->getGeoLocation();
		$ipAddress = $clientDetails->getIpAddress();
		$model = $clientDetails->getModel();
		$partnerName = $clientDetails->getPartnerName();

		$clientDetailsElement = $factory->createMessageElement();

		if ( $applicationId != null ) {
			$clientDetails->addChild( $factory->createMessageField( 'applicationId' , $factory->createMessagePrimitive( $applicationId ) ) );
		}

		if ( $customerId != null ) {
			$clientDetails->addChild( $factory->createMessageField( 'customerId' , $factory->createMessagePrimitive( $customerId ) ) );
		}

		if ( $customerType != null ) {
			$clientDetails->addChild( $factory->createMessageField( 'customerType' , $factory->createMessagePrimitive( $customerType ) ) );
		}

		if ( $deviceId != null ) {
			$clientDetails->addChild( $factory->createMessageField( 'deviceId' , $factory->createMessagePrimitive( $deviceId ) ) );
		}

		if ( $geoLocation != null ) {
			$clientDetails->addChild( $factory->createMessageField( 'geoLocation' , $factory->createMessagePrimitive( $geoLocation ) ) );
		}

		if ( $ipAddress != null ) {
			$clientDetails->addChild( $factory->createMessageField( 'ipAddress' , $factory->createMessagePrimitive( $ipAddress ) ) );
		}

		if ( $model != null ) {
			$clientDetails->addChild( $factory->createMessageField( 'model' , $factory->createMessagePrimitive( $model ) ) );
		}

		if ( $partnerName != null ) {
			$clientDetails->addChild( $factory->createMessageField( 'partnerName' , $factory->createMessagePrimitive( $partnerName ) ) );
		}

		return $clientDetailsElement;
	}

	private function buildFundingConstraint( FundingConstraint $fundingConstraint , AbstractPayPalMessageFactory $factory ) {
		$allowedFundingType = $fundingConstraint->allowedFundingType();
		$allowedFundingConstraintElement = $factory->createMessageElement();
		$allowedFundingTypeList = $factory->createMessageList();

		foreach ( $allowedFundingType->getIterator() as $fundingType ) {
			$fundingInfoElement = $factory->createMessageElement();
			$fundingInfoElement->addChild( $factory->createMessageField( 'fundingType' , $factory->createMessagePrimitive( $fundingType ) ) );

			$allowedFundingTypeList->addChild( $fundingInfoElement );
		}

		$fundingTypeInfoElement = $factory->createMessageField( 'fundingTypeInfo' , $allowedFundingTypeList );
		$allowedFundingTypeElement = $factory->createMessageElement();
		$allowedFundingTypeElement->addChild( $fundingTypeInfoElement );
		$allowedFundingConstraintElement->addChild( $factory->createMessageField( 'allowedFundingType' , $allowedFundingTypeElement ) );

		return $allowedFundingConstraintElement;
	}

	private function buildPayRequest( PayRequest $request , AbstractPayPalMessageFactory $factory ) {
		$this->message = $factory->createMessageElement();
		$this->message->addChild( $factory->createMessageField( 'actionType' , $factory->createMessagePrimitive( $request->getActionType() ) ) );
		$this->message->addChild( $factory->createMessageField( 'cancelUrl' , $factory->createMessagePrimitive( $request->getCancelUrl() ) ) );

		if ( $request->getClientDetails() != null ) {
			$this->message->addChild( $factory->createMessageField( 'clientDetails' , $this->buildClientDetails( $request->clientDetails() ) ) );
		}

		$this->message->addChild( $factory->createMessageField( 'currencyCode' , $factory->createMessagePrimitive( $request->currencyCode()->value() ) ) );

		if ( $request->getFundingConstraint() != null ) {
			$this->message->addChild( $factory->createMessageField( 'fundingConstraint' , $this->buildFundingConstraint( $request->fundingConstraint() , $factory ) ) );
		}

		if ( ( $ipnNotificationUrl = $request->getIpnNotificationUrl() ) != null ) {
			$this->message->addChild( $factory->createMessageField( 'ipnNotificationUrl' , $factory->createMessagePrimitive( $ipnNotificationUrl ) ) );
		}

		if ( ( $memo = $request->getMemo() ) != null ) {
			$this->message->addChild( $factory->createMessageField( 'memo' , $factory->createMessagePrimitive( $memo ) ) );
		}

		if ( ( $pin = $request->getPin() ) != null ) {
			$this->message->addChild( $factory->createMessageField( 'pin' , $factory->createMessagePrimitive( $pin ) ) );
		}

		if ( ( $preaprovalKey = $request->getPreaprovalKey() ) != null ) {
			$this->message->addChild( $factory->createMessageField( 'preaprovalKey' , $factory->createMessagePrimitive( $preaprovalKey ) ) );
		}

		if ( $request->receiverList()->count() > 0 ) {
			$this->message->addChild( $factory->createMessageField( 'receiverList' , $this->buildReceiverList( $request->receiverList() , $factory ) ) );
		} else {
			throw new RuntimeException( 'You are *required* to specify at least one receiver' );
		}

		$this->message->addChild( $factory->createMessageField( 'returnUrl' , $factory->createMessagePrimitive( $request->getReturnUrl() ) ) );
		$this->message->addChild( $factory->createMessageField( 'requestEnvelope' , $this->buildRequestEnvelope( $request->requestEnvelope() , $factory ) ) );

		if ( ( $reverseAllParallelPaymentsOnError = $request->getReverseAllParallelPaymentsOnError() ) != null ) {
			$this->message->addChild( $factory->createMessageField( 'reverseAllParallelPaymentsOnError' , $factory->createMessagePrimitive( $reverseAllParallelPaymentsOnError ) ) );
		}

		if ( $request->getSender() != null ) {
			$this->message->addChild( $factory->createMessageField( 'sender' , $this->buildSender( $request->sender() , $factory ) ) );
		}

		if ( ( $senderEmail = $request->getSenderEmail() ) != null ) {
			$this->message->addChild( $factory->createMessageField( 'senderEmail' , $factory->createMessagePrimitive( $senderEmail ) ) );
		}

		if ( ( $trackingId = $request->getTrackingId() ) != null ) {
			$this->message->addChild( $factory->createMessageField( 'trackingId' , $factory->createMessagePrimitive( $trackingId ) ) );
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

	private function buildReceiverList( ReceiverList $receiverList , AbstractPayPalMessageFactory $factory ) {
		$receiverElement = $factory->createMessageList();

		foreach ( $receiverList->getIterator() as $receiver ) {
			$receiverElement->addChild( $this->buildReceiver( $receiver , $factory ) );
		}

		$receiverListElement = $factory->createMessageElement();
		$receiverListElement->addChild( $factory->createMessageField( 'receiver' , $receiverElement ) );

		return $receiverListElement;
	}

	private function buildRequestEnvelope( RequestEnvelope $requestEnvelope , AbstractPayPalMessageFactory $factory ) {
		$requestEnvelopeElement = $factory->createMessageElement();
		$requestEnvelopeElement->addChild( $factory->createMessageField( 'errorLanguage' , $factory->createMessagePrimitive( $requestEnvelope->getErrorLanguage() ) ) );
		$requestEnvelopeElement->addChild( $factory->createMessageField( 'detailLevel' , $factory->createMessagePrimitive( $requestEnvelope->getDetailLevel() ) ) );

		return $requestEnvelopeElement;
	}

	private function buildSender( SenderIdentifier $sender , AbstractPayPalMessageFactory $factory ) {
		$senderIdentifierElement = $factory->createMessageElement();

		if ( ( $email = $sender->getEmail() ) != null ) {
			$senderIdentifierElement->addChild( $factory->createMessageField( 'email' , $factory->createMessagePrimitive( $email ) ) );
		}

		if ( ( $phone = $sender->getPhone() ) != null ) {
			$senderIdentifierElement->addChild( $factory->createMessageField( 'phone' , $this->buildPhoneNumber( $phone , $factory ) ) );
		}

		if ( ( $useCredentials = $sender->getUseCredentials() ) != null ) {
			$senderIdentifierElement->addChild( $factory->createMessageField( 'useCredentials' , $factory->createMessagePrimitive( $useCredentials == true ? true : false ) ) );
		}

		return $senderIdentifierElement;
	}

	/**
	 * Gets the request message
	 * @return	PayPalMessageComponent
	 */
	public function getMessage() {
		return $this->message;
	}
}