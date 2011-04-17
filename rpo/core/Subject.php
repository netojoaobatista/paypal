<?php
/**
 * Objetos e interfaces de base
 * @author	João Batista Neto
 * @package	rpo.core
 */

require_once 'rpo/core/Observer.php';

/**
 * Interface para definição de um objeto que pode ser
 * observado por modificações de estado por outros
 * objetos
 */
interface Subject {
	/**
	 * Adiciona um observador à lista de observadores
	 * do objeto
	 * @param	Observer $observer
	 * @return	boolean TRUE caso o observador tenha sido
	 * adicionado com sucesso
	 */
	public function attach( Observer $observer );

	/**
	 * Remove um observador do objeto
	 * @param	Observer $observer
	 * @return	boolean TRUE caso o observador tenha sido
	 * removido com sucesso
	 */
	public function detach( Observer $observer );

	/**
	 * Notifica todos os observadores sobre modificações
	 * de estado
	 */
	public function notify();
}