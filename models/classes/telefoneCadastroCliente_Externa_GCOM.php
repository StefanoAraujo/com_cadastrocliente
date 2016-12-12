<?php 	
defined('_JEXEC') or die;
abstract class TelefoneCadastroCliente_Externa_GCOM
{
	
	public $telefoneCadastroCliente_Externa_GCOM;
	
	public function __construct()
	{
		$this->telefoneCadastroCliente_Externa_GCOM  = new stdclass();
		$this->telefoneCadastroCliente_Externa_GCOM->id = null;
		$this->telefoneCadastroCliente_Externa_GCOM->tipoTelefone_id = null;
		$this->telefoneCadastroCliente_Externa_GCOM->pais_id = null;
		$this->telefoneCadastroCliente_Externa_GCOM->preCadastroCliente_id = null;
		$this->telefoneCadastroCliente_Externa_GCOM->nome = null;
		$this->telefoneCadastroCliente_Externa_GCOM->ddd = null;
		$this->telefoneCadastroCliente_Externa_GCOM->numero = null;
		$this->telefoneCadastroCliente_Externa_GCOM->ramal = null;
		$this->telefoneCadastroCliente_Externa_GCOM->principal = null;
		$this->telefoneCadastroCliente_Externa_GCOM->nacional = null;
	}
	abstract public function get();
	abstract public function set();
}