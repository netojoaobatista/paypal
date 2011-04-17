<?php
final class InternalError extends PayPalException {
	const CODE = 520002;

	public function __construct( $message , PayPalException $previous = null ) {
		parent::__construct( $message , InternalError::CODE , $previous );
	}
}