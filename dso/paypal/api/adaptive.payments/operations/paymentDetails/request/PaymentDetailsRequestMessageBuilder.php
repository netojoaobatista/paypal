<?php
require_once 'dso/paypal/api/adaptive.payments/operations/AbstractMessageBuilder.php';

/**
 *
 *
 */
class PaymentDetailsRequestMessageBuilder extends AbstractMessageBuilder {
	/**
	 * Creates the builder instance to build the request message
	 * @param	PaymentDetailsRequest $paymentDetailsRequest
	 * @param	AbstractPayPalMessageFactory $factory
	 */
	public function __construct( PaymentDetailsRequest $paymentDetailsRequest , AbstractPayPalMessageFactory $factory ) {
		parent::__construct( $factory->createMessageElement() );

		$this->buildPaymentDetailsRequest( $paymentDetailsRequest , $factory );
	}

	public function buildPaymentDetailsRequest( PaymentDetailsRequest $request , AbstractPayPalMessageFactory $factory ) {
		$payKey = $request->getPayKey();
		$transactionId = $request->getTransactionId();
		$trackingId = $request->getTrackingId();

		if ( $payKey != null ) {
			$this->message->addChild( $factory->createMessageField( 'payKey' , $factory->createMessagePrimitive( $payKey ) ) );
		}

		if ( $trackingId != null ) {
			$this->message->addChild( $factory->createMessageField( 'trackingId' , $factory->createMessagePrimitive( $trackingId ) ) );
		}

		if ( $transactionId != null ) {
			$this->message->addChild( $factory->createMessageField( 'transactionId' , $factory->createMessagePrimitive( $transactionId ) ) );
		}

		$this->message->addChild( $factory->createMessageField( 'requestEnvelope' , $this->buildRequestEnvelope( $request->requestEnvelope() , $factory ) ) );
	}
}