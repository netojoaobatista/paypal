<?php
require_once 'rpo/core/Object.php';

/**
 *
 */
class AbstractMessageBuilder extends Object {
	/**
	 * @var	PayPalMessageContainer
	 */
	protected $message;

	protected function __construct( PayPalMessageContainer $message ) {
		parent::__construct();

		$this->message = $message;
	}

	protected function buildRequestEnvelope( RequestEnvelope $requestEnvelope , AbstractPayPalMessageFactory $factory ) {
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