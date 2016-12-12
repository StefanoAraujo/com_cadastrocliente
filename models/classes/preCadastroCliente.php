<?php 	
defined('_JEXEC') or die;
abstract class PreCadastroCliente
{
	
	public $preCadastroCliente;
	
	public function __construct()
	{
		$this->preCadastroCliente  = new stdclass();
		$this->preCadastroCliente->id = null;
		$this->preCadastroCliente->tipoCliente_id = null;
		$this->preCadastroCliente->estadoCivil_id = null;
		$this->preCadastroCliente->inscricaoEstadual = null;
		$this->preCadastroCliente->nomeClienteConta = null;
		$this->preCadastroCliente->nome = null;
		$this->preCadastroCliente->Razaosocial = null;
		$this->preCadastroCliente->nomeFantasia = null;
		$this->preCadastroCliente->sexo = null;
		$this->preCadastroCliente->docIdentificacao = null;
		$this->preCadastroCliente->orgaoEmissor = null;
		$this->preCadastroCliente->dataNascimento = null;
		$this->preCadastroCliente->nomeMae = null;
		$this->preCadastroCliente->nomeConjugue = null;
		$this->preCadastroCliente->cpfConjugue = null;
		$this->preCadastroCliente->email = null;
		$this->preCadastroCliente->dataCadastro = null;
		$this->preCadastroCliente->autorizadoDescarteETE = null;
		$this->preCadastroCliente->bloqueado = null;
		$this->preCadastroCliente->nomeRepresentante = null;
		$this->preCadastroCliente->cpfRepresentante = null;
	}
	abstract public function get();
	abstract public function set();
}