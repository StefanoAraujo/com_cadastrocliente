<?php 	
defined('_JEXEC') or die;
abstract class CadastroCliente_Externa_GCOM
{
	
	public $cadastroCliente_Externa_GCOM;
	
	public function __construct()
	{
		$this->cadastroCliente_Externa_GCOM  = new stdclass();
		$this->cadastroCliente_Externa_GCOM->id = null;
		$this->cadastroCliente_Externa_GCOM->tipoCliente_id = null;
		$this->cadastroCliente_Externa_GCOM->estadoCivil_id = null;
		$this->cadastroCliente_Externa_GCOM->inscricaoEstadual = null;
		$this->cadastroCliente_Externa_GCOM->nomeClienteConta = null;
		$this->cadastroCliente_Externa_GCOM->nome = null;
		$this->cadastroCliente_Externa_GCOM->Razaosocial = null;
		$this->cadastroCliente_Externa_GCOM->nomeFantasia = null;
		$this->cadastroCliente_Externa_GCOM->sexo = null;
		$this->cadastroCliente_Externa_GCOM->docIdentificacao = null;
		$this->cadastroCliente_Externa_GCOM->orgaoEmissor = null;
		$this->cadastroCliente_Externa_GCOM->dataNascimento = null;
		$this->cadastroCliente_Externa_GCOM->nomeMae = null;
		$this->cadastroCliente_Externa_GCOM->nomeConjugue = null;
		$this->cadastroCliente_Externa_GCOM->cpfConjugue = null;
		$this->cadastroCliente_Externa_GCOM->email = null;
		$this->cadastroCliente_Externa_GCOM->dataCadastro = null;
		$this->cadastroCliente_Externa_GCOM->autorizadoDescarteETE = null;
		$this->cadastroCliente_Externa_GCOM->bloqueado = null;
		$this->cadastroCliente_Externa_GCOM->nomeRepresentante = null;
		$this->cadastroCliente_Externa_GCOM->cpfRepresentante = null;
	}
	abstract public function get();
	abstract public function set();
}