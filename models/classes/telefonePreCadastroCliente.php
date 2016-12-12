<?php 	
defined('_JEXEC') or die;
abstract class TelefonePreCadastroCliente
{
	
	public $telefonePreCadastroCliente;
	
	public function __construct()
	{
		$this->telefonePreCadastroCliente  = new stdclass();
		$this->telefonePreCadastroCliente->id = null;
		$this->telefonePreCadastroClientetipoTelefone_id = null;
		$this->telefonePreCadastroClientepais_id = null;
		$this->telefonePreCadastroClientepreCadastroCliente_id = null;
		$this->telefonePreCadastroClientenome = null;
		$this->telefonePreCadastroClienteddd = null;
		$this->telefonePreCadastroClientenumero = null;
		$this->telefonePreCadastroClienteramal = null;
		$this->telefonePreCadastroClienteprincipal = null;
		$this->telefonePreCadastroClientenacional = null;
	}
	abstract public function get();
	abstract public function set();
}