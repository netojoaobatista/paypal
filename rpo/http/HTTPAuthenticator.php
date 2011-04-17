<?php
/**
 * Classes e interfaces relacionadas ao protocolo HTTP
 * @author	João Batista Neto
 * @package	dso.http
 */

require_once 'rpo/http/HTTPRequest.php';

/**
 * Interface para definição de um autenticador HTTP.
 */
interface HTTPAuthenticator {
	/**
	 * Autentica uma requisição HTTP.
	 * @param	HTTPRequest $httpRequest
	 */
	public function authenticate( HTTPRequest $httpRequest );
}