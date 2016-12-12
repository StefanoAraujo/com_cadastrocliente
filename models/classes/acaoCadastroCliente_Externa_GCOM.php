<?php 	
defined('_JEXEC') or die;
abstract class AcaoCadastroCliente_Externa_GCOM
{
	
	public $acaoCadastroCliente_Externa_GCOM;
	
	public function __construct()
	{
		$this->acaoCadastroCliente_Externa_GCOM  = new stdclass();
		$this->acaoCadastroCliente_Externa_GCOM->id = null;
		$this->acaoCadastroCliente_Externa_GCOM->descricao = null;
	}
	abstract public function get();
	abstract public function set();
}