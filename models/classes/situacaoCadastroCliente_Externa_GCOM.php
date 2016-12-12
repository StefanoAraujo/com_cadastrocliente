<?php 	
defined('_JEXEC') or die;
abstract class SituacaoCadastroCliente_Externa_GCOM
{
	
	public $situacaoCadastroCliente_Externa_GCOM;
	
	public function __construct()
	{
		$this->situacaoCadastroCliente_Externa_GCOM  = new stdclass();
		$this->situacaoCadastroCliente_Externa_GCOM->id = null;
		$this->situacaoCadastroCliente_Externa_GCOM->atendimento_id = null;
		$this->situacaoCadastroCliente_Externa_GCOM->cadastroCliente_id = null;
		$this->situacaoCadastroCliente_Externa_GCOM->tipoSituaçãoCadastroCliente_id = null;
		$this->situacaoCadastroCliente_Externa_GCOM->acaoCadastroCliente_id = null;
		$this->situacaoCadastroCliente_Externa_GCOM->dataOperacao = null;
		$this->situacaoCadastroCliente_Externa_GCOM->justificativa = null;
		$this->situacaoCadastroCliente_Externa_GCOM->atual = null;
	}
	abstract public function get();
	abstract public function set();
}