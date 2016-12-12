<?php 	
defined('_JEXEC') or die;
interface Acesso
{
	public function efetuarlogin();
	public function solicitarsenha();
	public function redefinirsenha();
	public function incluirsolicitacao();
	public function validarsolicitacao();
	public function pesquisartermosesso();
}