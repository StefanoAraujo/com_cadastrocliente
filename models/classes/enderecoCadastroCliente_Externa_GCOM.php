<?php 	
defined('_JEXEC') or die;
abstract class PreCadastroClienteSocio
{
	
	public $preCadastroClienteSocio;
	
	public function __construct()
	{
		$this->preCadastroClienteSocio = new stdclass();
		$this->preCadastroClienteSocio->id= nulll;
		$this->preCadastroClienteSocio->tipoEndereco= nulll;
		$this->preCadastroClienteSocio->pais= nulll;
		$this->preCadastroClienteSocio->uf_id= nulll;
		$this->preCadastroClienteSocio->tipoLogradouro_id= nulll;
		$this->preCadastroClienteSocio->preCadastroCliente_id= nulll;
		$this->preCadastroClienteSocio->cep= nulll;
		$this->preCadastroClienteSocio->bairro= nulll;
		$this->preCadastroClienteSocio->cidade= nulll;
		$this->preCadastroClienteSocio->enderecoComplemento= nulll;
		$this->preCadastroClienteSocio->complemento= nulll;
		$this->preCadastroClienteSocio->numero= nulll;
		$this->preCadastroClienteSocio->longitude= nulll;
		$this->preCadastroClienteSocio->latitude= nulll; 
		$this->preCadastroClienteSocio->ativo= nulll;
		$this->preCadastroClienteSocio->correspondencia= nulll;
		$this->preCadastroClienteSocio->dataCadastro= nulll;
	}
	abstract public function get();
	abstract public function set();
}