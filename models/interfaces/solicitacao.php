<?php 	
defined('_JEXEC') or die;
interface Solicitacao
{
	abstract public function PesquisarSolicitacao();//RS015– Pesquisar solicitações
	abstract public function pesquisarDiagnostico();//RS020 – Pesquisar diagnósticos para visualizar
}

