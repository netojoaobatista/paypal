<?php
require_once 'dso/paypal/api/adaptive.payments/types/AbstractPayPalType.php';

/**
 * This is a list of funding selections that can be combined in any order
 * to allow payments to use the indicated funding type. If this field is
 * omitted, the payment can be funded by any funding type that is supported
 * for Adaptive Payments<br /><br />
 * <b>N O TE :</b><br />
 * FundingConstraint is unavailable to API callers with standard permission
 * levels; for more information, refer to the section Adaptive Payments
 * Permission Levels<br /><br />
 * <b>N O TE :</b><br />
 * To use iACH, omit this field and do not specify a funding source for the
 * payment.
 */
class FundingTypeList extends AbstractPayPalType implements Countable, IteratorAggregate {
	/**
	 * Electronic check.
	 */
	const ECHECK  = 'ECHECK';

	/**
	 * PayPal account balance.
	 */
	const BALANCE = 'BALANCE';

	/**
	 * Credit card.
	 */
	const CREDITCARD = 'CREDITCARD';

	/**
	 * @var	array
	 */
	private $fundingTypeInfo = array();

	/**
	 * Add a funding selection for the payment.
	 * <b>Allowable values are:</b>
	 * <ul>
	 * <li><b>ECHECK</b> – Electronic check</li>
	 * <li><b>BALANCE</b> – PayPal account balance</li>
	 * <li><b>CREDITCARD</b> – Credit card</li>
	 * </ul><br />
	 * <b>N O TE :</b><br />
	 * ECHECK and CREDITCARD include BALANCE implicitly.<br />
	 * <b>N O TE :</b><br />
	 * FundingConstraint is unavailable to API callers with standard
	 * permission levels; for more information, refer to the section
	 * Adaptive Payments Permission Levels.
	 * @param	string $fundingTypeInfo
	 * @throws	InvalidArgumentException
	 */
	public function add( $fundingTypeInfo ) {
		switch ( $fundingTypeInfo ) {
			case FundingTypeList::ECHECK:
			case FundingTypeList::BALANCE:
			case FundingTypeList::CREDITCARD:
				$this->fundingTypeInfo[] = $fundingTypeInfo;
				break;
			default :
				throw new InvalidArgumentException( 'The "' . $fundingTypeInfo . '" is not allowed.' );
		}
	}

	/**
	 * @return	integer
	 * @see		Countable::count()
	 */
	public function count() {
		return count( $this->fundingTypeInfo );
	}

	/**
	 * @return	Iterator[string]
	 * @see		IteratorAggregate::getIterator()
	 */
	public function getIterator() {
		return new ArrayIterator( $this->fundingTypeInfo );
	}
}