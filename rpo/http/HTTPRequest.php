<?php
/**
 * Classes e interfaces relacionadas ao protocolo HTTP
 * @author	João Batista Neto
 * @package	dso.http
 */

require_once 'rpo/http/HTTPConnection.php';

/**
 * Interface para definição de um objeto que fará uma
 * requisição HTTP.
 */
interface HTTPRequest {
	/**
	 * Adiciona um campo de cabeçalho para ser enviado com a
	 * requisição.
	 * @param	string $name Nome do campo de cabeçalho.
	 * @param	string $value Valor do campo de cabeçalho.
	 * @param	boolean $override Indica se o campo deverá
	 * ser sobrescrito caso já tenha sido definido.
	 * @throws	InvalidArgumentException Se o nome ou o valor
	 * do campo não forem valores scalar.
	 */
	public function addRequestHeader( $name , $value , $override = true );

	/**
	 * Autentica uma requisição HTTP.
	 * @param	HTTPAuthenticator $authenticator
	 */
	public function authenticate( HTTPAuthenticator $authenticator );

	/**
	 * Fecha a requisição.
	 */
	public function close();

	/**
	 * Executa a requisição HTTP em um caminho utilizando um
	 * método específico.
	 * @param	string $method Método da requisição.
	 * @param	string $path Alvo da requisição.
	 * @return	string Resposta HTTP.
	 * @throws	BadMethodCallException Se não houver uma conexão
	 * inicializada.
	 */
	public function execute( $path = '/' , $method = HTTPRequestMethod::GET );

	/**
	 * Recupera a resposta da requisição.
	 * @return	HTTPResponse
	 */
	public function getResponse();

	/**
	 * Abre a requisição.
	 * @param	HTTPConnection $httpConnection Conexão HTTP
	 * relacionada com essa requisição
	 */
	public function open( HTTPConnection $httpConnection );

	/**
	 * Define um parâmetro que será enviado com a requisição,
	 * um parâmetro é um par nome-valor que será enviado como uma
	 * query string (<b>ex:</b> <i>?name=value</i>).
	 * @param	string $name Nome do parâmetro.
	 * @param	string $value Valor do parâmetro.
	 * @throws	InvalidArgumentException Se o nome ou o valor
	 * do campo não forem valores scalar.
	 */
	public function setParameter( $name , $value );

	/**
	 * Corpo da requisição HTTP.
	 * @param	string $contentBody
	 */
	public function setRequestBody( $requestBody );
}