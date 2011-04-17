<?php
require_once 'dso/paypal/api/adaptive.payments/types/AbstractPayPalType.php';

/**
 * Information about the sender.
 */
class ClientDetails extends AbstractPayPalType {
	/**
	 * Your application’s identification, such as the name of your
	 * application.
	 * @var	string
	 */
	private $applicationId;

	/**
	 * Your ID for this sender<br />
	 * <b>Maximum length:</b> 127 characters.
	 * @var	string
	 */
	private $customerId;

	/**
	 * Your identification of the type of customer<br />
	 * <b>Maximum length:</b> 127 characters.
	 * @var	string
	 */
	private $customerType;

	/**
	 * Sender’s device ID, such as a mobile device’s IMEI number or a
	 * web browser cookie. If a device ID was passed with the PayRequest, use the
	 * same ID here.<br />
	 * <b>Maximum length:</b> 127 characters
	 * @var	string
	 */
	private $deviceId;

	/**
	 * Sender’s geographic location<br />
	 * <b>Maximum length:</b> 127 characters
	 * @var	string
	 */
	private $geoLocation;

	/**
	 * Sender’s IP address. If an IP addressed was passed with the
	 * PayRequest, use the same ID here.
	 * @var	string
	 */
	private $ipAddress;

	/**
	 * A sub-identification of the application<br />
	 * <b>Maximum length:</b> 127 characters
	 * @var	string
	 */
	private $model;

	/**
	 * Your organization’s name or ID<br />
	 * <b>Maximum length:</b> 127 characters
	 * @var	string
	 */
	private $partnerName;

	/**
	 * @return	string
	 */
	public function getApplicationId() {
		return $this->applicationId;
	}

	/**
	 * @return	string
	 */
	public function getCustomerId() {
		return $this->customerId;
	}

	/**
	 * @return	string
	 */
	public function getCustomerType() {
		return $this->customerType;
	}

	/**
	 * @return	string
	 */
	public function getDeviceId() {
		return $this->deviceId;
	}

	/**
	 * @return	string
	 */
	public function getGeoLocation() {
		return $this->geoLocation;
	}

	/**
	 * @return	string
	 */
	public function getIpAddress() {
		return $this->ipAddress;
	}

	/**
	 * @return	string
	 */
	public function getModel() {
		return $this->model;
	}

	/**
	 * @return	string
	 */
	public function getPartnerName() {
		return $this->partnerName;
	}

	/**
	 * Your application’s identification, such as the name of your
	 * application.
	 * @param string $applicationId
	 */
	public function setApplicationId( $applicationId ) {
		$this->applicationId = $applicationId;
	}

	/**
	 * Your ID for this sender<br />
	 * <b>Maximum length:</b> 127 characters.
	 * @param	string $customerId
	 * @throws	LengthException
	 */
	public function setCustomerId( $customerId ) {
		if ( strlen( $customerId ) <= 127 ) {
			$this->customerId = $customerId;
		} else {
			throw new LengthException( 'customerId too long.' );
		}
	}

	/**
	 * Your identification of the type of customer<br />
	 * <b>Maximum length:</b> 127 characters
	 * @param	string $customerType
	 * @throws	LengthException
	 */
	public function setCustomerType( $customerType ) {
		if ( strlen( $customerType ) <= 127 ) {
			$this->customerType = $customerType;
		} else {
			throw new LengthException( 'customerType too long.' );
		}
	}

	/**
	 * Sender’s device ID, such as a mobile device’s IMEI number or a
	 * web browser cookie; If a device ID was passed with the PayRequest,
	 * use the same ID here.<br />
	 * <b>Maximum length:</b> 127 characters
	 * @param	string $deviceId
	 * @throws	LengthException
	 */
	public function setDeviceId( $deviceId ) {
		if ( strlen( $deviceId ) <= 127 ) {
			$this->deviceId = $deviceId;
		} else {
			throw new LengthException( 'deviceId too long.' );
		}
	}

	/**
	 * Sender’s geographic location<br />
	 * <b>Maximum length:</b> 127 characters
	 * @param	string $geoLocation
	 * @throws	LengthException
	 */
	public function setGeoLocation( $geoLocation ) {
		if ( strlen( $geoLocation ) <= 127 ) {
			$this->geoLocation = $geoLocation;
		} else {
			throw new LengthException( 'geoLocation too long.' );
		}
	}

	/**
	 * Sender’s IP address; If an IP addressed was passed with the
	 * PayRequest, use the same ID here.
	 * @param	string $ipAddress
	 * @throws	InvalidArgumentException
	 */
	public function setIpAddress( $ipAddress ) {
		if ( filter_var( $ipAddress , FILTER_VALIDATE_IP ) ) {
			$this->ipAddress = $ipAddress;
		} else {
			throw new InvalidArgumentException( 'Invalid IP address supplied.' );
		}
	}

	/**
	 * A sub-identification of the application<br />
	 * <b>Maximum length:</b> 127 characters
	 * @param string $model
	 * @throws	LengthException
	 */
	public function setModel( $model ) {
		if ( strlen( $model ) <= 127 ) {
			$this->model = $model;
		} else {
			throw new LengthException( 'model too long.' );
		}
	}

	/**
	 * Your organization’s name or ID<br />
	 * <b>Maximum length:</b> 127 characters
	 * @param	string $partnerName
	 * @throws	LengthException
	 */
	public function setPartnerName( $partnerName ) {
		if ( strlen( $partnerName ) <= 127 ) {
			$this->partnerName = $partnerName;
		} else {
			throw new LengthException( 'partnerName too long.' );
		}
	}
}