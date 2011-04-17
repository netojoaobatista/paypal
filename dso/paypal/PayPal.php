<?php
/**
 * Objects and interfaces to integrate with the PayPal API.
 * @author	João Batista Neto
 * @package	dso.paypal
 */

require_once 'rpo/core/Object.php';
require_once 'rpo/http/HTTPConnection.php';
require_once 'rpo/http/HTTPCookieManager.php';
require_once 'dso/paypal/PayPal3TokenAuthenticator.php';
require_once 'dso/paypal/api/adaptive.payments/AdaptativePayments.php';
require_once 'dso/paypal/message/json/JSONMessageFactory.php';
require_once 'dso/paypal/message/xml/XMLMessageFactory.php';

/**
 * The PayPal class offers an simple interface to call an PayPal API
 * operation.
 */
class PayPal extends Object {
	/**
	 * The default request data format.
	 */
	const DEFAULT_REQUEST_DATA_FORMAT = 'JSON';

	/**
	 * The default response data format.
	 */
	const DEFAULT_RESPONSE_DATA_FORMAT = 'JSON';

	/**
	 * PayPal API target host.
	 */
	const DEFAULT_HOST = 'svcs.paypal.com';

	/**
	 * PayPal sandbox application id.
	 */
	const SANDBOX_APPLICATION_ID = 'APP-80W284485P519543T';

	/**
	 * PayPal sandbox target host.
	 */
	const SANDBOX_HOST = 'svcs.sandbox.paypal.com';

	/**
	 * @var	string
	 */
	private $applicationId;

	/**
	 * @var	PayPalAuthenticator
	 */
	private $authenticator;

	/**
	 * @var	AbstractPayPalMessageFactory
	 */
	private $paypalMessageFactory;

	/**
	 * @var	string
	 */
	private $requestDataFormat = PayPal::DEFAULT_REQUEST_DATA_FORMAT;

	/**
	 * @var	string
	 */
	private $responseDataFormat = PayPal::DEFAULT_RESPONSE_DATA_FORMAT;

	/**
	 * @var	string
	 */
	private $targetHost = PayPal::DEFAULT_HOST;

	/**
	 * @param	string $applicationId Your application’s identification,
	 * which is issued by PayPal.
	 * @param	HTTPAuthenticator $authenticator Use your PayPal account
	 * API credentials to authenticate your application.
	 */
	public function __construct( $applicationId , HTTPAuthenticator $authenticator) {
		parent::__construct();

		$this->applicationId = $applicationId;
		$this->authenticator = $authenticator;
	}

	/**
	 * Adaptive payments handles payments between a sender of a payment and one or
	 * more receivers of the payment. You are an application owner, such as a merchant
	 * that owns a website, the owner of a widget on a social networking site, the
	 * provider of a payment application on cell phones, and so on. Your application
	 * is the caller of Adaptive Payments API operations.
	 * @return	AdaptativePayments
	 */
	public function adaptativePayments() {
		$adaptativePayments = new AdaptativePayments( $this );

		return $adaptativePayments;
	}

	/**
	 * Gets the abstract message factory for the supplied request data format.
	 * @return	AbstractPayPalMessageFactory
	 * @throws	RuntimeException
	 */
	public function getAbstractMessageFactory() {
		switch ( $this->requestDataFormat ) {
			case 'JSON':
				return new JSONMessageFactory();
			case 'XML' :
				return new XMLMessageFactory();
			case 'NVP' :
			default:
				throw new RuntimeException( 'The "' . $this->requestDataFormat . '" request data format is not yet implemented.' );
		}
	}

	/**
	 * @return	HTTPConnection
	 */
	public function getHTTPConnection() {
		$httpConnection = new HTTPConnection();
		$httpConnection->addHeader( 'X-PAYPAL-APPLICATION-ID' , $this->applicationId );
		$httpConnection->addHeader( 'X-PAYPAL-REQUEST-DATA-FORMAT' , $this->requestDataFormat );
		$httpConnection->addHeader( 'X-PAYPAL-RESPONSE-DATA-FORMAT' , $this->responseDataFormat );
		$httpConnection->addHeader( 'X-Target-URI' , $this->targetHost );
		$httpConnection->setAuthenticator( $this->authenticator );
		$httpConnection->setCookieManager( new HTTPCookieManager() );
		$httpConnection->initialize( $this->targetHost , true );

		return $httpConnection;
	}

	/**
	 * Use the Sandbox to test your applications as if they were on the live PayPal.com
	 * web site; The only difference is the funds in the Sandbox are play money.
	 * @return	PayPal
	 */
	public function sandbox() {
		$this->applicationId = PayPal::SANDBOX_APPLICATION_ID;
		$this->targetHost = PayPal::SANDBOX_HOST;

		return $this;
	}

	/**
	 * The payload format for the request, allowable values are:
	 * JSON, NVP or straight XML.
	 * @param	string $requestDataFormat
	 * @throws	InvalidArgumentException
	 */
	public function setRequestDataFormat( $requestDataFormat ) {
		switch ( $requestDataFormat ) {
			case 'JSON':
			case 'NVP' :
			case 'XML' :
				$this->requestDataFormat = $requestDataFormat;
				break;
			default :
				throw new InvalidArgumentException( 'Invalid request data format supplied: ' . $requestDataFormat );
		}
	}

	/**
	 * The payload format for the response, allowable values are:
	 * JSON, NVP or straight XML.
	 * @param	string $responseDataFormat
	 * @throws	InvalidArgumentException
	 */
	public function setResponseDataFormat( $responseDataFormat ) {
		switch ( $responseDataFormat ) {
			case 'JSON':
			case 'NVP' :
			case 'XML' :
				$this->responseDataFormat = $responseDataFormat;
				break;
			default :
				throw new InvalidArgumentException( 'Invalid response data format supplied: ' . $responseDataFormat );
		}
	}
}