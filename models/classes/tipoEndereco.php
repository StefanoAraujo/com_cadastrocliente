<?php 	
defined('_JEXEC') or die;
abstract class TipoEndereco
{
	
	public $tipoEndereco;
	
	public function __construct()
	{
		$this->tipoEndereco = new stdclass();
		$this->tipoEndereco->id = nulll;
		$this->tipoEndereco->descricao = nulll;
	}
	abstract public function get();
}