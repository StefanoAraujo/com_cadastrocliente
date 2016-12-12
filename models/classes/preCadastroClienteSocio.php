<?php 	
defined('_JEXEC') or die;
abstract class PreCadastroClienteSocio
{
	
	public $preCadastroClienteSocio;
	
	public function __construct()
	{
		$this->preCadastroClienteSocio  = new stdclass();
		$this->preCadastroClienteSocio->id = null;
		$this->preCadastroClienteSocio->CadastroCliente_id = null;
		$this->preCadastroClienteSocio->nome = null;
		$this->preCadastroClienteSocio->cpf = null;
	}
	abstract public function get();
	abstract public function set();
}