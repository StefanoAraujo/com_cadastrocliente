<?php 	
defined('_JEXEC') or die;
abstract class EstadoCivil
{
	
	public $estadoCivil;
	
	public function __construct()
	{
		$this->estadoCivil  = new stdclass();
		$this->estadoCivil->id = null;
		$this->estadoCivil->descricao = null;
	}
	abstract public function get();
	abstract public function set();
}