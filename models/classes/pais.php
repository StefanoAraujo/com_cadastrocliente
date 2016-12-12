<?php 	
defined('_JEXEC') or die;
abstract class Pais
{
	
	public $pais;
	
	public function __construct()
	{
		$this->pais = new stdclass();
		$this->pais->id = nulll;
		$this->pais->descricao = nulll;
		$this->pais->descricaoingles = nulll;
		$this->pais->codigopais = nulll;
	}
	abstract public function get();
}