<?php
final class SystemError extends PayPalException {
	const CODE = 500000;

	public function __construct( $message , PayPalException $previous = null ) {
		parent::__construct( $message , SystemError::CODE , $previous );
	}
}