<?php
defined('_JEXEC') or die;
jimport('joomla.application.component.controller');
require_once JPATH_COMPONENT.'/models/acesso.php';
jimport('joomla.user.helper');
JLoader::register('Acesso', JPATH_COMPONENT . DS . 'models/interfaces' . DS . 'acesso.php');
class CadastroClienteControllerAcesso extends JController implements Acesso
{

	//RS001 – Efetuar login
	public function efetuarlogin()
	{
		try {
			JSession::checkToken() or SELF::criarExececao("COM_CONTRATOCLIENTE_MESSAGE_TOKEN");
			$model = $this->getModel('acesso', 'CadastroClienteModel');
			$model->validarJaSouCadastrado();
			$sessao = CadastroClienteHelperUtilitarios::pegarSessao("cadastraoCLienteLogin");
			SELF::redirecionar(SELF::criarAlerta(str_replace("%nome%", $sessao->nome, Jtext::_("COM_CADASTROCLIENTE_LABEL_USUARIO"))),"cadastrocliente");
		} catch (Exception $e) {
			SELF::redirecionar(SELF::criarAlerta($e->getMessage(), "erro"),"acesso");
		}
	}

	//RS002 – Solicitar redefinição de senha de acesso
	public function solicitarsenha()
	{
		try {
			JSession::checkToken() or SELF::criarExececao("COM_CONTRATOCLIENTE_MESSAGE_TOKEN");
			$model = $this->getModel('acesso', 'CadastroClienteModel');
			SELF::redirecionar($model->validarEsqueciMinhaSenha(),"acesso");
		} catch (Exception $e) {
			SELF::redirecionar($e->getMessage(),"acesso");
		}
	}

	//RS003 – Redefinir senha de acesso
	public function redefinirsenha()
	{
		try {
			$model = $this->getModel('acesso', 'CadastroClienteModel');
			$model::alterar();
			SELF::redirecionar(SELF::criarAlerta("mesagem"),"acesso");
		} catch (Exception $e) {
			SELF::redirecionar($e->getMessage(),"acesso");
		}

	}

	//RS004 – Incluir solicitação de acesso pessoa física
	public function incluirsolicitacao()
	{
		try {
			JSession::checkToken() or SELF::criarExececao("COM_CONTRATOCLIENTE_MESSAGE_TOKEN");
			$model = $this->getModel('acesso', 'CadastroClienteModel');
			$model::inserirNovoAcesso();
		} catch (Exception $e) {
			SELF::redirecionar($e->getMessage(),"acesso");
		}
	}

	//RS006 – Validar solicitação de acesso											  
	public function validarsolicitacao()
	{
		$model = $this->getModel('acesso', 'CadastroClienteModel');
		$model::selecionar();
		SELF::redirecionar(SELF::criarAlerta("mesagem"),"acesso");
	}

	//RS007 – Pesquisar termo de uso para visualização
	public function pesquisartermosesso()
	{
		try {
			JSession::checkToken() or SELF::criarExececao("COM_CONTRATOCLIENTE_MESSAGE_TOKEN");
			$model = $this->getModel('acesso', 'CadastroClienteModel');
			SELF::redirecionar(SELF::criarAlerta("mesagem"),"acesso");
		} catch (Exception $e) {
			SELF::redirecionar($e->getMessage(),"acesso");
		}
	}

	//RS00ção
	public function atualizardados()
	{
		try {
			JSession::checkToken('get') or SELF::criarExececao("COM_CONTRATOCLIENTE_MESSAGE_TOKEN");
			$model = $this->getModel('acesso', 'CadastroClienteModel');
			SELF::redirecionar(SELF::criarAlerta("mesagem"),"atualizardadoscadastrais");
		} catch (Exception $e) {
			SELF::redirecionar($e->getMessage(),"acesso");
		}
	}

	//RS00ção
	public function continuaratualizacao()
	{
		try {
			JSession::checkToken('get') or SELF::criarExececao("COM_CONTRATOCLIENTE_MESSAGE_TOKEN");
			$model = $this->getModel('acesso', 'CadastroClienteModel');
			SELF::redirecionar(SELF::criarAlerta("mesagem"),"atualizardadoscadastrais");
		} catch (Exception $e) {
			SELF::redirecionar($e->getMessage(),"acesso");
		}
	}

	//RS00
	public function acompanharsolicitacao()
	{
		try {
			JSession::checkToken('get') or SELF::criarExececao("COM_CONTRATOCLIENTE_MESSAGE_TOKEN");
			$model = $this->getModel('acesso', 'CadastroClienteModel');
			SELF::redirecionar(SELF::criarAlerta(""),"pesquisarsolicitacao");
		} catch (Exception $e) {
			SELF::redirecionar($e->getMessage(),"acesso");
		}
	}

	//RS00ção
	public function alterarperfil()
	{
		try {
			JSession::checkToken('get') or SELF::criarExececao("COM_CONTRATOCLIENTE_MESSAGE_TOKEN");
			SELF::redirecionar("","alterarperfil");
		} catch (Exception $e) {
			SELF::redirecionar($e->getMessage(),"acesso");
		}
	}
	
	private function redirecionar($RetornoMensagem, $view = null)
	{

		$application = JFactory::getApplication();
		$url = ($view) ? JRoute::_('index.php?option=com_cadastrocliente&view='.$view): JURI::current();
		$application->redirect($url, $RetornoMensagem, $msgType='message');
	}

	// tipo: erro, sucesso, informacao
	private function criarAlerta($menssagem, $tipo=informacao)
	{
		switch ($tipo) {
			case 'erro':$tipo = "error";break;
			case 'sucesso':$tipo = "success";break;
			default:$tipo = "info";break;
		}
		return "<div class='alert alert-".$tipo."'>".$menssagem."<div>";
	}

	private function criarExececao($erro)
	{
		throw new Exception(SELF::criarAlerta(Jtext::_($erro), "erro"));
	}

	public function criarRequisicao()
	{
		$objeto =new stdclass();
		$objeto->email = "email";
		$objeto->token = JSession::getFormToken("true");
		$objeto->dataExpiracao = date('Y-m-d H:i');
		$objeto->dataRequisicao = date('Y-m-d H:i', strtotime("+2 days",strtotime($objeto->dataExpiracao)));
		$objeto->requisicao = "teste";
		echo CadastroClienteHelperPersistencia::inserir("#__cadastrocliente_requisicao",$objeto);
	}


}