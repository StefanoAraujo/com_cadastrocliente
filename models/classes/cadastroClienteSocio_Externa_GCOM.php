<?php 	
defined('_JEXEC') or die;
abstract class CadastroClienteSocio_Externa_GCOM_Externa_GCOM
{
	
	public $cadastroClienteSocio_Externa_GCOM_Externa_GCOM;
	
	public function __construct()
	{
		$this->cadastroClienteSocio_Externa_GCOM  = new stdclass();
		$this->cadastroClienteSocio_Externa_GCOM->id = null;
		$this->cadastroClienteSocio_Externa_GCOM->CadastroCliente_id = null;
		$this->cadastroClienteSocio_Externa_GCOM->nome = null;
		$this->cadastroClienteSocio_Externa_GCOM->cpf = null;
	}
	abstract public function get();
	abstract public function set();
}