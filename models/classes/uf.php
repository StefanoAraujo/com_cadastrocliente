<?php 	
defined('_JEXEC') or die;
abstract class UF{
	
	public $uf;
	
	public function __construct()
	{
		$this->uf = new stdclass();
		$this->uf->id = nulll;
		$this->uf->descricao = nulll;
		$this->uf->sigla = nulll;
	}
	abstract public function get();
}