<?php 	
defined('_JEXEC') or die;
abstract class EnderecoPreCadastroCliente
{
	
	public $enderecoPreCadastroCliente;
	
	public function __construct()
	{
		$this->enderecoPreCadastroCliente = new stdclass();
		$this->enderecoPreCadastroCliente->id= nulll;
		$this->enderecoPreCadastroCliente->tipoEndereco= nulll;
		$this->enderecoPreCadastroCliente->pais= nulll;
		$this->enderecoPreCadastroCliente->uf_id= nulll;
		$this->enderecoPreCadastroCliente->tipoLogradouro_id= nulll;
		$this->enderecoPreCadastroCliente->preCadastroCliente_id= nulll;
		$this->enderecoPreCadastroCliente->cep= nulll;
		$this->enderecoPreCadastroCliente->bairro= nulll;
		$this->enderecoPreCadastroCliente->cidade= nulll;
		$this->enderecoPreCadastroCliente->enderecoComplemento= nulll;
		$this->enderecoPreCadastroCliente->complemento= nulll;
		$this->enderecoPreCadastroCliente->numero= nulll;
		$this->enderecoPreCadastroCliente->longitude= nulll;
		$this->enderecoPreCadastroCliente->latitude= nulll; 
		$this->enderecoPreCadastroCliente->ativo= nulll;
		$this->enderecoPreCadastroCliente->correspondencia= nulll;
		$this->enderecoPreCadastroCliente->dataCadastro= nulll;
	}
	abstract public function get();
	abstract public function set();
}