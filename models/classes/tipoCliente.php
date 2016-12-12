<?php 	
defined('_JEXEC') or die;
abstract class TipoCliente
{
	
	public $tipoCliente;
	
	public function __construct()
	{
		$this->tipoCliente  = new stdclass();
		$this->tipoCliente->id = null;
		$this->tipoCliente->descricao = null;
	}
	abstract public function get();
}