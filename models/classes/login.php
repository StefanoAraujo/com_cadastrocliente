<?php 	
defined('_JEXEC') or die;
abstract class Login
{
	
	public $login;
	
	public function __construct()
	{
		$this->login = new stdclass();
		$this->login->cpfCnpj = nulll;
		$this->login->inscricaoEstadual = nulll;
		$this->login->nome = nulll;
		$this->login->dataNascimento = nulll;
		$this->login->email = nulll;
		$this->login->Senha = nulll;
		$this->login->dataCadastro = nulll;
	}
}