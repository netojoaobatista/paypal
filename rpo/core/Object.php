<?php
/**
 * Objetos e interfaces de base
 * @author	João Batista Neto
 * @package	rpo.core
 */

require_once 'rpo/core/Observer.php';
require_once 'rpo/core/Subject.php';

/**
 * Objeto primitivo
 */
class Object implements Observer, Subject {
	/**
	 * Lista de observadores
	 * @var	array
	 */
	private $observers = array();

	/**
	 * Construtor do objeto
	 */
	protected function __construct(){
	}

	/**
	 * Clona o objeto
	 */
	public function __clone(){
	}

	/**
	 * Recupera a representação do objeto como string
	 * @return	string
	 */
	public function __toString() {
		return sprintf( '%s@%s' , get_class( $this ) , $this->hashCode() );
	}

	/**
	 * Adiciona um observador à lista de observadores
	 * do objeto
	 * @param	Observer $observer
	 * @return	boolean TRUE caso o observador tenha sido
	 * adicionado com sucesso
	 * @see		Subject::attach()
	 */
	public function attach( Observer $observer ) {
		if ( $observer instanceof Object ) {
			$hashCode = $observer->hashCode();
		} else {
			$hashCode = spl_object_hash( $observer );
		}

		if ( !isset( $this->observers[ $hashCode ] ) ) {
			$this->observers[ $hashCode ] = $observer;
			return true;
		}

		return false;
	}

	/**
	 * Remove um observador do objeto
	 * @param	Observer $observer
	 * @return	boolean TRUE caso o observador tenha sido
	 * removido com sucesso
	 * @see		Subject::detach()
	 */
	public function detach( Observer $observer ) {
		if ( $observer instanceof Object ) {
			$hashCode = $observer->hashCode();
		} else {
			$hashCode = spl_object_hash( $observer );
		}

		if ( isset( $this->observers[ $hashCode ] ) ) {
			unset( $this->observers[ $hashCode ] );
			return true;
		}

		return false;
	}

	/**
	 * Verifica a igualdade entre dois objetos
	 * @param	Object $o O objeto que será utilizado na comparação
	 * @return	boolean TRUE Se os dois objetos forem iguais
	 * @see		Object::hashCode()
	 */
	public function equals( Object $o ) {
		return $o->hashCode() == $this->hashCode();
	}

	/**
	 * Recupera um objeto de reflexão desse objeto
	 * @return	ReflectionClass
	 */
	public function getClass() {
		return new ReflectionClass( get_class( $this ) );
	}

	/**
	 * Recupera o hash do objeto
	 * @return	string
	 * @see		Observer::hashCode()
	 */
	public function hashCode() {
		return spl_object_hash( $this );
	}

	/**
	 * Notifica todos os observadores sobre modificações
	 * de estado
	 * @see		Subject::notify()
	 */
	public function notify() {
		foreach ( $this->observers as $observer ) {
			$observer->update( $this );
		}
	}

	/**
	 * Atualiza o observador caso o objeto observado
	 * tenha seu estado modificado
	 * @param	Subject $subject
	 */
	public function update( Subject $subject ) {
	}
}