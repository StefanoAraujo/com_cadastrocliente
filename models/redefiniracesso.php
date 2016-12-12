<?php
defined('_JEXEC') or die;
jimport('joomla.application.component.modelform');
jimport('joomla.event.dispatcher');
jimport('joomla.filesystem.file');

class CadastroClienteModelRedefinirAcesso extends JModelForm
{
	public function getForm($data = array(), $loadData = true)
	{

	}

	public function getFormulario($string)
	{
		$formulario = $this->loadForm("com_cadastrocliente".$string, $string, array('control' => $string, 'load_data' => true));
		if (empty($formulario)) {
			return false;
		}
		return $formulario;
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

	public function validarEmailRedefinirSenha(){
		try {
			$entrada = JFactory::getApplication()->input;
			$dados = $entrada->get('email', "", 'STRING');
			$dados2 = preg_replace('/\D+/', '', $entrada->get('login', "", 'STRING'));
			$query =   "SELECT *
			       		FROM login 
			       		WHERE email='".$dados."' and cpfCnpj='".$dados2."'";
		   	$soapcliente =  CadastroClienteHelperMSSQLService::getConnection($query); 

		   	if ($soapcliente->sucesso==true) {
		   		
		   		if( strtotime(date('Y-m-d H:i:s')) <= strtotime("+1 day", strtotime($soapcliente->conteudo[0]->dataCadastro)))
		   		{
		   			if(!CadastroClienteHelperUtilitarios::verificarSessao("cadastroRedefinirSenha"))
		   			{
		   				CadastroClienteHelperUtilitarios::criarSessao("cadastroRedefinirSenha",$soapcliente->conteudo[0]) or SELF::criarExececao("COM_CADASTROCLIENTE_LABEL_MENSAGEM_ERRO_EMAILEXPIRADO"); 
		   			}
		   			SELF::redirecionar("","redefiniracesso");
		   		}else {
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

	public function validarEmailIncluirCadastro(){
		try {
			$entrada = JFactory::getApplication()->input;
			$dados = $entrada->get('email', "", 'STRING');
			$query =   "SELECT *
			       		FROM login 
			       		WHERE email='".$dados."'";
		   	$soapcliente =  CadastroClienteHelperMSSQLService::getConnection($query); 
		   	if ($soapcliente->sucesso==true) {
		   		if( strtotime(date('Y-m-d H:i:s')) <= strtotime("+3 day", strtotime($soapcliente->conteudo[0]->dataCadastro)))
		   		{
		   			
		   			CadastroClienteHelperUtilitarios::criarSessao("cadastroNovoCliente",$soapcliente->conteudo[0]);
		   			SELF::redirecionar("teste","confirmaracesso");
		   		}else {
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

	public function redefinirsenha()
	{
		try {
			JSession::checkToken() or SELF::criarExececao("COM_CONTRATOCLIENTE_MESSAGE_TOKEN");
			CadastroClienteHelperUtilitarios::verificarSessao("cadastroRedefinirSenha") or CadastroClienteHelperUtilitarios::redireciona(Jtext::_("COM_CADASTROCLIENTE_LABEL_MENSAGEM_ERRO_EMAILEXPIRADO"), "acesso");
			$cadastro = CadastroClienteHelperUtilitarios::pegarSessao("cadastroRedefinirSenha");
			$entrada = JFactory::getApplication()->input;
			$dados = $entrada->get('email', array(), 'Array');
			$query =   "UPDATE login SET 
			       		senha = CONVERT(VARBINARY(128),'".$dados['senha']."')
			       		dataCadastro = '".date('Y-m-d', strtotime('-3 days'))."'
			       		WHERE cpfCnpj='".$cadastro->cpfCnpj."'";
		   	$soapcliente =  CadastroClienteHelperMSSQLService::getConnection($query);
            $query1 =   "INSERT INTO preCadastroCliente
                                     (tipoCliente_id
                                      ,cpfcnpj)
                             VALUES
                                     (".((strlen($cadastro->cpfCnpj)==11)?1:2)."
                                     ,'".$cadastro->cpfCnpj."')";
            $soapcliente1 =  CadastroClienteHelperMSSQLService::getConnection($query1);
            if ($soapcliente->sucesso==true and $soapcliente1->sucesso==true) {
		   		CadastroClienteHelperUtilitarios::deletarSessao("cadastroRedefinirSenha");
		   		SELF::redirecionar(Jtext::_("COM_CADASTROCLIENTE_LABEL_MENSAGEM_SENHALSUCESSO"),"acesso");
			}
		   	else
		   	{
		   		SELF::criarExececao("COM_CADASTROCLIENTE_LABEL_MENSAGEM_ERRO_EMAILEXPIRADO");
		   	}
		} catch (Exception $e) {
			SELF::redirecionar($e->getMessage(), "acesso");
		}
	}
}