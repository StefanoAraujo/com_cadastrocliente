<?php 	
defined('_JEXEC') or die;
abstract class TipoSituacaoCadastroCliente_Externa_GCOM
{
	
	public $TipoSituacaoCadastroCliente_Externa_GCOM;
	
	public function __construct()
	{
		$this->TipoSituacaoCadastroCliente_Externa_GCOM  = new stdclass();
		$this->TipoSituacaoCadastroCliente_Externa_GCOM->id = null;
		$this->TipoSituacaoCadastroCliente_Externa_GCOM->descricao = null;
	}
	abstract public function get();
}