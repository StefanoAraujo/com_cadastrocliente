<?php 	
defined('_JEXEC') or die;
abstract class CadastroClienteArquivo_Externa_GCOM
{
	
	public $cadastroClienteArquivo_Externa_GCOM;
	
	public function __construct()
	{
		$this->cadastroClienteArquivo_Externa_GCOM  = new stdclass();
		$this->cadastroClienteArquivo_Externa_GCOM->id = null;
		$this->cadastroClienteArquivo_Externa_GCOM->arquivoGCOM_id = null;
		$this->cadastroClienteArquivo_Externa_GCOM->preCadastroCliente_id = null;
	}
	abstract public function get();
	abstract public function set();
}