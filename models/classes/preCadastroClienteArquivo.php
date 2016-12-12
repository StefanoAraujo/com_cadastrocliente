<?php 	
defined('_JEXEC') or die;
abstract class PreCadastroClienteArquivo
{
	
	public $preCadastroClienteArquivo;
	
	public function __construct()
	{
		$this->preCadastroClienteArquivo  = new stdclass();
		$this->preCadastroClienteArquivo->id = null;
		$this->preCadastroClienteArquivo->arquivoGCOM_id = null;
		$this->preCadastroClienteArquivo->preCadastroCliente_id = null;
	}
	abstract public function get();
	abstract public function set();
}