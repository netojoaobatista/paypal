<?php
/**
 * Classes e interfaces relacionadas ao protocolo HTTP
 * @author	João Batista Neto
 * @package	dso.http
 */

/**
 * Constantes para identificar o método de requisição HTTP
 */
interface HTTPRequestMethod {
	const DELETE = 'DELETE';
	const GET = 'GET';
	const HEAD = 'HEAD';
	const OPTIONS = 'OPTIONS';
	const POST = 'POST';
	const PUT = 'PUT';
	const TRACE = 'TRACE';
}