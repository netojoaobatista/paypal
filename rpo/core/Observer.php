<?php
/**
 * Objetos e interfaces de base
 * @author	João Batista Neto
 * @package	rpo.core
 */

require_once 'rpo/core/Subject.php';

/**
 * Interface para definição de um objeto que observa
 * outros objetos pode modificações de estado
 */
interface Observer {
	/**
	 * Atualiza o observador caso o objeto observado
	 * tenha seu estado modificado
	 * @param	Subject $subject
	 */
	public function update( Subject $subject );
}