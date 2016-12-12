<?php 	
defined('_JEXEC') or die;
abstract class TipoLogradouro
{
	
	public $tipoLogradouro;
	
	public function __construct()
	{
		$this->tipoLogradouro = new stdclass();
		$this->tipoLogradouro->id = nulll;
		$this->tipoLogradouro->descricao = nulll;
		$this->tipoLogradouro->abreviatura = nulll;
	}
	abstract public function get();
}