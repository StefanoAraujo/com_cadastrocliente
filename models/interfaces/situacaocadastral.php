situacaocadastralphp<?php 	
defined('_JEXEC') or die;
interface Situacaocadastral
{
	abstract public function pesquisarSituacao();//RS008 – Pesquisar situação cadastral do cliente 
	abstract public function incluirRascunho();//RS009 – Incluir rascunho de solicitação cadastral - Cliente pessoa física
	                                           //RS010 – Incluir rascunho de solicitação cadastral - Cliente pessoa jurídica
	abstract public function alterarRascunho();//RS011 – Alterar rascunho da solicitação cadastral - Cliente pessoa física
	                                           //RS012 – Alterar rascunho da solicitação cadastral - Cliente pessoa jurídica 
	abstract public function finalizarrascunho();//RS013 – Finalizar solicitação cadastral - Cliente pessoa física  
	                                             //RS014 – Finalizar solicitação cadastral - Cliente pessoa jurídica  
	abstract public function AjustarPendencia();//RS016– Ajustar pendencia cadastral – Cliente pessoa física  
	                                            //RS017– Ajustar pendencia cadastral – Cliente pessoa jurídica  
	abstract public function AlterarCadastro();//RS018 – Alterar cadastro de cliente pessoa física 
	                                           //RS019 – Alterar cadastro de cliente pessoa jurídica 
	abstract public function AnexarArquivo();//RS022 – Anexar arquivo  
	abstract public function PesquisarEnderecoCorreios();//RS021 – Pesquisar dados do Endereço na base Correios  
	abstract public function PesquisarPais();//RS023 – Pesquisar país (lista suspensa)  
}






