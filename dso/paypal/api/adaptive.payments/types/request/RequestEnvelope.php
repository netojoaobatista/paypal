<?php
require_once 'dso/paypal/api/adaptive.payments/types/AbstractPayPalType.php';

/**
 *
 */
class RequestEnvelope extends AbstractPayPalType {
	/**
	 * The level of detail required by the client application for
	 * components. Possible values are:
	 * <ul>
	 * <li><b>ReturnAll</b> – This value provides the maximum level of detail <b>(default)</b></li>
	 * </ul>
	 * @var	string
	 */
	private $detailLevel = 'ReturnAll';

	/**
	 * The RFC 3066 language in which error messages are returned; by
	 * default it is en_US, which is the only language currently supported
	 * @var	string
	 */
	private $errorLanguage = 'en_US';

	/**
	 * @return	string
	 */
	public function getDetailLevel() {
		return $this->detailLevel;
	}

	/**
	 * @return	string
	 */
	public function getErrorLanguage() {
		return $this->errorLanguage;
	}

	/**
	 * Set the level of detail required by the client application for
	 * components.
	 * @param	string $detailLevel
	 * @throws	InvalidArgumentException
	 */
	public function setDetailLevel( $detailLevel ) {
		if ( $detailLevel == 'ReturnAll' ) {
			$this->detailLevel = $detailLevel;
		} else {
			throw new InvalidArgumentException( 'The only currently supported detail level is "ReturnAll".' );
		}
	}

	/**
	 * The RFC 3066 language in which error messages are returned.
	 * @param	string $errorLanguage
	 * @throws	InvalidArgumentException
	 */
	public function setErrorLanguage( $errorLanguage ) {
		if ( $errorLanguage == 'en_US' ) {
			$this->errorLanguage = $errorLanguage;
		} else {
			throw new InvalidArgumentException( 'The only currently supported language is "en_US".' );
		}
	}
}