<?php
defined('_JEXEC') or die;
jimport('joomla.application.component.controllerform');
jimport('joomla.user.helper');
class CadastroClienteControllerPerfil extends JControllerForm
{
	public function pegarSessao()
	{
		try {
			verificarSessao("cadastraoCLienteLogin") or SELF::criarExececao("COM_CADASTROCLIENTE_LABEL_MENSAGEM_ERRO_SESSAOEXPIRADA");	
			$this->SessaoUsuario = CadastroClienteHelperUtilitarios::pegarSessao("cadastraoCLienteLogin");
			return $this->SessaoUsuario;
		} catch (Exception $e) {
			SELF::redirecionar($e->getMessage(), "acesso");
		}
	}

	//RS024
	public function alterarCadastro()
	{
		try {
			JSession::checkToken() or SELF::criarExececao("COM_CONTRATOCLIENTE_MESSAGE_TOKEN");
			$model = $this->getModel('alterarPerfil', 'CadastroClienteModel');
			$model->alterarPerfil();
			SELF::redirecionar(SELF::criarAlerta("COM_CADASTROCLIENTE_LABEL_MENSAGEM_ALTERACAOREALIZADA"),"cadastrocliente");
		} catch (Exception $e) {
			SELF::redirecionar($e->getMessage(), "acesso");
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
		return "<div class='alert alert-".$tipo."'>".Jtext::_($menssagem)."<div>";
	}

	private function criarExececao($erro)
	{
		throw new Exception(SELF::criarAlerta(Jtext::_($erro), "erro"));
	}

	public function download()
	{
		$entrada = JFactory::getApplication()->input;
		$dados = $entrada->get('cadastrocliente', "", 'STRING');
		$dados = iconv('UTF-8//TRANSLIT','ISO-8859-1',  $dados);
		if($dados!="")
		{
			$params = array("nome"=>$dados);
			$retorno = CadastroClienteHelperWebservice::getService('download', $params);
			if($retorno->retorno->sucesso===true)
			{
				foreach ($retorno->retorno->arquivos as $key) {
					$arquivo = $key->arquivo;
				}
			}
			header('Cache-Control: public'); 
			header('Content-type: application/pdf');
			header('Content-Disposition: inline; filename=ARQUIV.PDF');
			echo file_get_contents('data://application/pdf;base64,'. $arquivo);
			die();
		} else {
			SELF::redireciona('CadastroCliente não informado', 'cadastrocliente');
		}
	
	}

	public function redefinirSenha()
	{
		
		try {
			$entrada = JFactory::getApplication()->input;
			$dados = $entrada->get('email', "", 'STRING');
			$dados2 = preg_replace('/\D+/', '', $entrada->get('login', "", 'STRING'));
			if($dados!="" and $dados2!="")
			{
				if (filter_var($dados, FILTER_VALIDATE_EMAIL)) {
					
				   $model = $this->getModel('redefiniracesso', 'CadastroClienteModel');
				   $model->validarEmailRedefinirSenha();
				}
				else
				{
					SELF::criarExececao("COM_CADASTROCLIENTE_LABEL_MENSAGEM_ERRO_EMAILEXPIRADO");
				}
			} 
			else
			{
				SELF::criarExececao("COM_CADASTROCLIENTE_LABEL_MENSAGEM_ERRO_EMAILEXPIRADO");	
			}
		} catch (Exception $e) {
			SELF::redirecionar($e->getMessage(), "acesso");
		}
	}

	public function alterarsenha()
	{
		try {
			JSession::checkToken() or SELF::criarExececao("COM_CONTRATOCLIENTE_MESSAGE_TOKEN");
			$model = $this->getModel('redefiniracesso', 'CadastroClienteModel');
			$model->redefinirsenha();
		} catch (Exception $e) {
			SELF::redirecionar($e->getMessage(), "acesso");
		}
	}

	public function incluirCadastro()
	{
		try {
			$entrada = JFactory::getApplication()->input;
			$dados = $entrada->get('email', "", 'STRING');
			if($dados!="")
			{
				if (filter_var($dados, FILTER_VALIDATE_EMAIL)) {
				  $model = $this->getModel('confirmaracesso', 'CadastroClienteModel');
				  $model->validarEmailIncluirCadastro();
				}
				else
			 	{
					SELF::criarExececao("COM_CADASTROCLIENTE_LABEL_MENSAGEM_ERRO_EMAILEXPIRADO");	
				}
			} 
			else
			{
				SELF::criarExececao("COM_CADASTROCLIENTE_LABEL_MENSAGEM_ERRO_EMAILEXPIRADO");	
			}
		} catch (Exception $e) {
			SELF::redirecionar($e->getMessage(), "acesso");
		}
	}

	public function cadastrarSenha()
	{
		try {
			JSession::checkToken() or SELF::criarExececao("COM_CONTRATOCLIENTE_MESSAGE_TOKEN");
			$model = $this->getModel('confirmaracesso', 'CadastroClienteModel');
			$model->incluirsenha();
		} catch (Exception $e) {
			SELF::redirecionar($e->getMessage(), "acesso");
		}
	}
}