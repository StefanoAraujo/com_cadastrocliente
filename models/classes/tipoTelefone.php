<?php 	
defined('_JEXEC') or die;
abstract class TipoTelefone
{
	
	public $tipoTelefone;
	
	public function __construct()
	{
		$this->tipoTelefone  = new stdclass();
		$this->tipoTelefone->id = null;
		$this->tipoTelefone->descricao = null;
	}
	abstract public function get();
}