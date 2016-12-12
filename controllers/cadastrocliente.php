<?php
defined('_JEXEC') or die;
jimport('joomla.application.component.controller');
require_once JPATH_COMPONENT.'/models/cadastrocliente.php';
jimport('joomla.user.helper');
class CadastroClienteControllerCadastroCliente extends JController
{
	
	public function formularioContato()
	{
		try {
			//JSession::checkToken() or SELF::criarExececao("COM_CONTRATOCLIENTE_MESSAGE_TOKEN");
			$model = $this->getModel('atualizardadoscadastrais', 'CadastroClienteModel');
			$model->formularioContato() or SELF::criarExececao("O e-mail informado é inválido");
		} catch (Exception $e) {
			die(json_encode(array("success" => false, "error"=>$e->getMessage())));
		}
	}	

	public function formularioEndereco()
	{
		try {
			//JSession::checkToken() or SELF::criarExececao("COM_CONTRATOCLIENTE_MESSAGE_TOKEN");
			$model = $this->getModel('atualizardadoscadastrais', 'CadastroClienteModel');
			$model->formularioEndereco() or SELF::criarExececao("O e-mail informado é inválido");
		} catch (Exception $e) {
			die(json_encode(array("success" => false, "error"=>$e->getMessage())));
		}
	}	

	public function excluirContato()
	{
		try {
			JSession::checkToken() or SELF::criarExececao("COM_CONTRATOCLIENTE_MESSAGE_TOKEN");
			$model = $this->getModel('cadastrocliente', 'CadastroClienteModel');
			$model->excluirContato() or SELF::criarExececao("O e-mail informado é inválido");
		} catch (Exception $e) {
			die(json_encode(array("success" => false, "error"=>$e->getMessage())));
		}
	}

	public function listarAnexo()
	{
		try {
			JSession::checkToken() or SELF::criarExececao("COM_CONTRATOCLIENTE_MESSAGE_TOKEN");
			$model = $this->getModel('cadastrocliente', 'CadastroClienteModel');
			$model->listarAnexo() or SELF::criarExececao("O e-mail informado é inválido");
		} catch (Exception $e) {
			die(json_encode(array("success" => false, "error"=>$e->getMessage())));
		}
	}	

	public function cadastrarAnexo()
	{
		try {
			JSession::checkToken() or SELF::criarExececao("COM_CONTRATOCLIENTE_MESSAGE_TOKEN");
			$model = $this->getModel('cadastrocliente', 'CadastroClienteModel');
			$model->cadastrarAnexo() or SELF::criarExececao("O e-mail informado é inválido");
		} catch (Exception $e) {
			die(json_encode(array("success" => false, "error"=>$e->getMessage())));
		}
	}

	public function listarContato()
	{
		try {
			JSession::checkToken() or SELF::criarExececao("COM_CONTRATOCLIENTE_MESSAGE_TOKEN");
			$model = $this->getModel('cadastrocliente', 'CadastroClienteModel');
			$model->listarContato() or SELF::criarExececao("O e-mail informado é inválido");
		} catch (Exception $e) {
			die(json_encode(array("success" => false, "error"=>$e->getMessage())));
		}
	}

	public function listarPrincipalEndereco()
	{
		try {
			JSession::checkToken() or SELF::criarExececao("COM_CONTRATOCLIENTE_MESSAGE_TOKEN");
			$model = $this->getModel('cadastrocliente', 'CadastroClienteModel');
			$model->listarPrincipalEndereco() or SELF::criarExececao("O e-mail informado é inválido");
		} catch (Exception $e) {
			die(json_encode(array("success" => false, "error"=>$e->getMessage())));
		}
	}

	public function listarEndereco()
	{
		try {
			JSession::checkToken() or SELF::criarExececao("COM_CONTRATOCLIENTE_MESSAGE_TOKEN");
			$model = $this->getModel('cadastrocliente', 'CadastroClienteModel');
			$model->listarEndereco() or SELF::criarExececao("O e-mail informado é inválido");
		} catch (Exception $e) {
			die(json_encode(array("success" => false, "error"=>$e->getMessage())));
		}
	}

	public function atualizar()
	{
		try {
			JSession::checkToken() or SELF::criarExececao("COM_CONTRATOCLIENTE_MESSAGE_TOKEN");
			$entrada = JFactory::getApplication()->input;
			$rascunho = $entrada->get('rascunho', "", 'STRING');
			$finalizar = $entrada->get('finalizar', "", 'STRING');
			var_dump($rascunho);
			var_dump($finalizar);
		} catch (Exception $e) {
			SELF::redirecionar(SELF::criarAlerta($e->getMessage(), "erro"),"acesso");
		}
	}

	public function incluirEndereco()
	{
		try {
			JSession::checkToken() or SELF::criarExececao("COM_CONTRATOCLIENTE_MESSAGE_TOKEN");
			$model = $this->getModel('cadastrocliente', 'CadastroClienteModel');
			$model->incluirEndereco();
			die(json_encode(array("success" => true)));
		} catch (Exception $e) {
			SELF::redirecionar(SELF::criarAlerta($e->getMessage(), "erro"),"acesso");
		}
	}

	public function incluirContato()
	{
		try {
			JSession::checkToken() or SELF::criarExececao("COM_CONTRATOCLIENTE_MESSAGE_TOKEN");
			$model = $this->getModel('cadastrocliente', 'CadastroClienteModel');
			$model->incluirContato();
			die(json_encode(array("success" => true)));
		} catch (Exception $e) {
			SELF::redirecionar(SELF::criarAlerta($e->getMessage(), "erro"),"acesso");
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