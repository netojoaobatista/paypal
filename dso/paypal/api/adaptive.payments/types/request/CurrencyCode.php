<?php
require_once 'rpo/core/Object.php';
require_once 'dso/paypal/api/adaptive.payments/types/PayPalType.php';

/**
 * This class represents the code for the currency in which
 * the payment is made.
 */
final class CurrencyCode extends Object implements PayPalType {
	/**
	 * Australian Dollar
	 */
	const AUD = 'AUD';

	/**
	 * Brazilian Real<br /><br />
	 * <b>NOTE:</b>
	 * The Real is supported as a payment currency and currency balance
	 * only for Brazilian PayPal accounts.
	 */
	const BRL = 'BRL';

	/**
	 * Canadian Dollar
	 */
	const CAD = 'CAD';

	/**
	 * Swiss Franc
	 */
	const CHF = 'CHF';

	/**
	 * Czech Koruna
	 */
	const CZK = 'CZK';

	/**
	 * Danish Krone
	 */
	const DKK = 'DKK';

	/**
	 * Euro
	 */
	const EUR = 'EUR';

	/**
	 * Pound Sterling
	 */
	const GBP = 'GBP';

	/**
	 * Hong Kong Dollar
	 */
	const HKD = 'HKD';

	/**
	 * Hungarian Forint
	 */
	const HUF = 'HUF';

	/**
	 * Israeli New Sheqel
	 */
	const ILS = 'ILS';

	/**
	 * Japanese Yen
	 */
	const JPY = 'JPY';

	/**
	 * Mexican Peso
	 */
	const MXN = 'MXN';

	/**
	 * Malaysian Ringgit<br /><br />
	 * <b>NOTE:</b>
	 * The Ringgit is supported as a payment currency and currency balance
	 * only for Malaysian PayPal accounts.
	 */
	const MYR = 'MYR';

	/**
	 * Norwegian Krone
	 */
	const NOK = 'NOK';

	/**
	 * New Zealand Dollar
	 */
	const NZD = 'NZD';

	/**
	 * Philippine Peso
	 */
	const PHP = 'PHP';

	/**
	 * Polish Zloty
	 */
	const PLN = 'PLN';

	/**
	 * Swedish Krona
	 */
	const SEK = 'SEK';

	/**
	 * Singapore Dollar
	 */
	const SGD = 'SGD';

	/**
	 * Thai Baht
	 */
	const THB = 'THB';

	/**
	 * Taiwan New Dollar
	 */
	const TWD = 'TWD';

	/**
	 * Turkish Lira
	 */
	const USD = 'USD';

	/**
	 * @var	string
	 */
	private $code;

	/**
	 * @param	string $code The currency code
	 * @throws	InvalidArgumentException
	 */
	protected function __construct( $code ) {
		parent::__construct();

		switch ( $code ) {
			case 'AUD' :
			case 'BRL' :
			case 'CAD' :
			case 'CHF' :
			case 'CZK' :
			case 'DKK' :
			case 'EUR' :
			case 'GBP' :
			case 'HKD' :
			case 'HUF' :
			case 'ILS' :
			case 'JPY' :
			case 'MXN' :
			case 'MYR' :
			case 'NOK' :
			case 'NZD' :
			case 'PHP' :
			case 'PLN' :
			case 'SEK' :
			case 'SGD' :
			case 'THB' :
			case 'TRY' : //we don't have a constant for this, try is a PHP reserved keyword
			case 'TWD' :
			case 'USD' :
				$this->code = $code;
				break;
			default :
				throw new InvalidArgumentException( 'Unsuported currency code: "' . $code . '".' );
		}
	}

	/**
	 * @return	string
	 * @see		Object::__toString()
	 */
	public function __toString() {
		return $this->value();
	}

	/**
	 * @param	string $code The currency code
	 * @return	CurrencyCode
	 */
	public static function create( $code ) {
		return new CurrencyCode( $code );
	}

	/**
	 * @return	string
	 */
	public function value() {
		return $this->code;
	}
}