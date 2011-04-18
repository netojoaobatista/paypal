<?php
require_once 'dso/paypal/api/adaptive.payments/types/AbstractPayPalType.php';
require_once 'dso/paypal/api/adaptive.payments/types/request/FundingTypeList.php';

/**
 * Specifies a list of allowed funding selections for the payment<br /><p>This
 * is a list of funding selections that can be combined in any order to allow
 * payments to use the indicated funding type. If this field is omitted, the
 * payment can be funded by any funding type that is supported for Adaptive
 * Payments.<br /><br />
 * <b>N O TE :</b><br />
 * FundingConstraint is unavailable to API callers with standard permission
 * levels; for more information, refer to the section Adaptive Payments Permission
 * Levels.<br /><br />
 * <b>N O TE :</b><br />
 * To use iACH, omit this field and do not specify a funding source for the payment.
 */
class FundingConstraint extends AbstractPayPalType {
	/**
	 * @var	FundingTypeList
	 */
	private $allowedFundingType;

	/**
	 * This is a list of funding selections that can be combined in any order
	 * to allow payments to use the indicated funding type.
	 * @return	FundingTypeList
	 */
	public function allowedFundingType() {
		if ( $this->allowedFundingType == null ) {
			$this->allowedFundingType = new FundingTypeList();
		}

		return $this->allowedFundingType;
	}
}