<?php
defined('_JEXEC') or die;
jimport('joomla.application.component.modelform');
jimport('joomla.event.dispatcher');
jimport('joomla.filesystem.file');

class CadastroClienteModelAcesso extends JModelForm
{
	private function setObj($string)
	{
		$entrada = JFactory::getApplication()->input;
        $dados = $entrada->post->get($string,null, 'Array');
		$login = new stdclass();
		$login->cpfCnpj = preg_replace('/\D+/', '', ((isset($dados['cpfCnpj']))?$dados['cpfCnpj']:null));
		$login->inscricaoEstadual = preg_replace('/\D+/', '', ((isset($dados['inscricaoEstadual']))?$dados['inscricaoEstadual']:null));
		$login->nome = (isset($dados['nome']))?$dados['nome']:null;
		$login->dataNascimento = (isset($dados['dataNascimento']))?$dados['dataNascimento']:null;
		$login->email = (isset($dados['email']))?$dados['email']:null;
		$login->senha = (isset($dados['senha']))?$dados['senha']:null;
		$login->dataCadastro = (isset($dados['dataCadastro']))?$dados['dataCadastro']:null;
		return $login;
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

	//RS001
	public function validarJaSouCadastrado()
	{
		try {
			JSession::checkToken() or SELF::criarExececao("COM_CONTRATOCLIENTE_MESSAGE_TOKEN");
			$setObjeto = SELF::setObj("acessoprincipal");

			if($setObjeto->cpfCnpj==null or $setObjeto->cpfCnpj == "")
			{
				SELF::criarExececao("COM_CADASTROCLIENTE_LABEL_MENSAGEM_ERRO_CPFCNPJVAZIO"."teste");
			}

			if($setObjeto->senha==null or $setObjeto->senha == "")
			{
				SELF::criarExececao("COM_CADASTROCLIENTE_LABEL_MENSAGEM_ERRO_SENHAVAZIO");
			}

			if(strlen($setObjeto->senha) <6 or strlen($setObjeto->senha) >8)
			{
				SELF::criarExececao("COM_CADASTROCLIENTE_LABEL_MENSAGEM_ERRO_SENHAMAIOROUMENOR");
			}

			if (!SELF::consultarCPFCNPJ($setObjeto->cpfCnpj)) {
				SELF::criarExececao("COM_CADASTROCLIENTE_LABEL_MENSAGEM_ERRO_CPFNAOCADASTRADO");
			} 

			if (!SELF::consultarCPFSenha($setObjeto)) {
				SELF::criarExececao("COM_CADASTROCLIENTE_LABEL_MENSAGEM_ERRO_SENHAINVALIDO");
			}
		} catch (Exception $e) {
			SELF::redirecionar($e->getMessage(), "acesso");
		}
	}

	//RS002
	public function validarEsqueciMinhaSenha()
	{
		try {
			$setOBjeto = SELF::setObj("acessoredefinir");
			if(($setOBjeto->email!="" or $setOBjeto->email!=null) and ($setOBjeto->cpfCnpj!="" or $setOBjeto->cpfCnpj!=null))
			{
				if(SELF::consultarEmail($setOBjeto))
				{
					if(SELF::enviarEmailRedefinirSenha())
					{
						return SELF::enviarSucesoPOPUP(str_replace("%email%", $setOBjeto->email, Jtext::_("COM_CADASTROCLIENTE_LABEL_MENSAGEM_EMAILENVIADO")));
					} 
					else
					{
						SELF::criarExececao("COM_CADASTROCLIENTE_LABEL_MENSAGEM_ERRO_NAREQUISICAO");
					}
				}
				else{
					SELF::criarExececao("COM_CADASTROCLIENTE_LABEL_MENSAGEM_ERRO_EMAILINVALIDO");
				}
			
			}
		} catch (Exception $e) {
			SELF::redirecionar($e->getMessage(), "acesso");
		}
	}

	//RS003
	public function redefinirSenhaAcesso(){
		try {
			$setOBjeto = SELF::setObj("acessoredefinir");
			if($setOBjeto->senha!="" or $setOBjeto->senha!=null or $setOBjeto->cpfcnpj!="" or $setOBjeto->cpfcnpj!=null)
			{
				//24hosras expirado
				//Este link é inválido ou expirou! Por favor faça uma nova solicitação
				//Senha alterada com sucesso redurecuibar para acesso
			}
			else
			{
				SELF::criarExececao("COM_CADASTROCLIENTE_LABEL_MENSAGEM_ERRO_NAREQUISICAO");
			}
		} catch (Exception $e) {
			SELF::redirecionar($e->getMessage(), "acesso");
		}
	}

	//rs004
	public function inserirNovoAcesso()
	{
		try {
			JSession::checkToken() or SELF::criarExececao(Jtext::_("COM_CONTRATOCLIENTE_MESSAGE_TOKEN"));
			$setOBjeto = SELF::setObj("acessoinicial");
			if($setOBjeto->cpfCnpj!=null and $setOBjeto->email!=null)
			{
				$query =   "INSERT INTO login
						           (cpfCnpj
						           ,inscricaoEstadual
						           ,nome
						           ,dataNascimento
						           ,email
						           ,senha
						           ,dataCadastro)
						     VALUES
						           ('".$setOBjeto->cpfCnpj."'
						           ,'".$setOBjeto->inscricaoEstadual."'
						           ,'".$setOBjeto->nome."'
						           ,'".date("Y-m-d",strtotime($setOBjeto->dataNascimento))."'
						           ,'".$setOBjeto->email."'
						           ,1
						           ,'".date("Y-m-d")."')";
						           
				$query = CadastroClienteHelperUtilitarios::decodeCharset($query, 4);
				
		   		$soapcliente =  CadastroClienteHelperMSSQLService::getConnection($query); 
		   		if($soapcliente->sucesso==true)
		   		{
		   			SELF::enviarEmailCadastro();
		   			SELF::redirecionar(CadastroClienteHelperUtilitarios::messagemPOPUP(str_replace("%email%",$setOBjeto->email , Jtext::_("COM_CADASTROCLIENTE_LABEL_MENSAGEM_EMAILCADASTRO"))), "acesso");
		   		}
		   		else
		   		{
		   			SELF::criarExececao("COM_CADASTROCLIENTE_LABEL_MENSAGEM_ERRO_NAREQUISICAO");
		   		}
			} else
			{
				SELF::criarExececao("COM_CADASTROCLIENTE_LABEL_MENSAGEM_ERRO_CAMPOOBRIGATORIO");
			}
		} catch (Exception $e) {
			SELF::redirecionar($e->getMessage(), "acesso");
		}
	}

	public function enviarEmailCadastro()
	{
		$setOBjeto = SELF::setObj("acessoinicial");
		CadastroClienteHelperUtilitarios::EnviarEmail($setOBjeto->email, SELF::pegarMensagemEmailCadastroAcesso(), "Solicitação de Cadastro de acesso");
		return true;
	}

	public function pegarMensagemEmailCadastroAcesso()
	{
		try {
			date_default_timezone_set('America/Sao_Paulo');
			$data = date('Y-m-d');
			$setOBjeto = SELF::setObj("acessoinicial");
			return str_replace("%nome%", $setOBjeto->nome , str_replace("%link%", JURI::root().JRoute::_('index.php?option=com_cadastrocliente&task=perfil.incluirCadastro&email='.$setOBjeto->email), Jtext::_('COM_CADASTROCLIENTE_EMAIL_REDEFINIRSENHA')));

		} catch (Exception $e) {
			SELF::redirecionar($e->getMessage(), "acesso");
		}
	}

	public function validarCaractererSenha($senha){
		try {
			$senha = trim($senha);
			if(strlen($senha)<6 and strlen($senha)>8)
			{	
				$senhasNulas = array(
					"01234567890", 
					"abcdefghijklmnoprstuvxyzw", 
					"11111111",
					"22222222",
					"33333333",
					"44444444",
					"55555555",
					"66666666",
					"77777777",
					"88888888",
					"00000000",
					"99999999",
					);

		   		if (strlen($senha) < 6 or strlen($senha) >8 ) {
		        	//retorna entre 6 e 8 caracteres
		        	SELF::criarExececao("COM_CADASTROCLIENTE_LABEL_MENSAGEM_ERRO_QTDDIGITOSENHA");
		   		}

			    if (!preg_match("#[0-9]+#", $senha)) {
			        // Usar pelo menos um numero;
			        SELF::criarExececao("COM_CADASTROCLIENTE_LABEL_MENSAGEM_ERRO_QTDDIGITOSENHA");
			    }

			    if (!preg_match("#[a-zA-Z]+#", $senha)) {
			        //usar pelo menos uma letra.
			        SELF::criarExececao("COM_CADASTROCLIENTE_LABEL_MENSAGEM_ERRO_QTDDIGITOSENHA");
			    }

			    if(in_array($senha, $senhasNulas)){
 					SELF::criarExececao("COM_CADASTROCLIENTE_LABEL_MENSAGEM_ERRO_QTDDIGITOSENHA");
			    }
			}
		} catch (Exception $e) {
			SELF::redirecionar($e->getMessage(), "acesso");
		}
	}

	public function validarSolicitacaoAcesso()
	{
		//validacao e prazo 72hora
		//verificar senha
		//Cadastro confirmado com sucesso”, o sistema deve apresentar a tela
		//Este link é inválido ou expirou! Por favor faça uma nova solicitação de acesso”;
		//redirecionar para login se verdadeiro
	}	

	public function pergarTermoUso(){
		//RS007 – Pesquisar termo de uso para visualização

	}

	public function enviarEmailRedefinirSenha(){
		//setar redefinir senah
		//r002
		$setOBjeto = SELF::setObj("acessoredefinir");
		CadastroClienteHelperUtilitarios::EnviarEmail($setOBjeto->email, SELF::pegarMensagemEmailTrocarSenha(), "Solicitação de troca de senha");
		return true;
	}

	public function enviarSucesoPOPUP($mensagem)
	{
		return CadastroClienteHelperUtilitarios::messagemPOPUP(Jtext::_($mensagem));
	}

	public function pegarMensagemEmailTrocarSenha()
	{
		try {
			date_default_timezone_set('America/Sao_Paulo');
			$data = date('Y-m-d');
			$setOBjeto = SELF::setObj("acessoredefinir");
			$query =   "SELECT nome 
			       		FROM login 
			       		WHERE email='".$setOBjeto->email."' and cpfCnpj='".$setOBjeto->cpfCnpj."'";
		   	$soapcliente =  CadastroClienteHelperMSSQLService::getConnection($query); 
			$query1 =   "UPDATE login SET 
			       		dataCadastro = '".$data."' 
			       		WHERE email='".$setOBjeto->email."' and cpfCnpj='".$setOBjeto->cpfCnpj."'";
		   	$soapcliente1=  CadastroClienteHelperMSSQLService::getConnection($query1); 

		   	if ($soapcliente->sucesso==true) {
		   			
		   			if ($soapcliente1->sucesso==true) {

				   			die(str_replace("%nome%", $soapcliente->conteudo[0]->nome , str_replace("%link%", JRoute::_('index.php?option=com_cadastrocliente&task=perfil.redefinirSenha&login='.$setOBjeto->cpfCnpj.'&email='.$setOBjeto->email), Jtext::_('COM_CADASTROCLIENTE_EMAIL_REDEFINIRSENHA'))));

				   			
				   			return str_replace("%nome%", $soapcliente->conteudo[0]->nome , str_replace("%link%", $_SERVER['SERVER_NAME'].JRoute::_('index.php?option=com_cadastrocliente&task=perfil.redefinirSenha&login='.$setOBjeto->cpfCnpj.'&email='.$setOBjeto->email), Jtext::_('COM_CADASTROCLIENTE_EMAIL_REDEFINIRSENHA')));
				   	}
				   	else
				   	{
				   			SELF::criarExececao("COM_CADASTROCLIENTE_LABEL_MENSAGEM_ERRO_NAREQUISICAO");
				   	}
			}
		   	else
		   	{
		   		SELF::criarExececao("COM_CADASTROCLIENTE_LABEL_MENSAGEM_ERRO_NAREQUISICAO");
		   	}
		} catch (Exception $e) {
			SELF::redirecionar($e->getMessage(), "acesso");
		}
	}

	
	public function consultarEmail($email)
	{
		try{
		   	$query =   "SELECT 
		   					CASE WHEN COUNT(*) > 0 
			            	THEN 'true'
			            	ELSE 'false'
			       			END AS retorno 
			       		FROM login 
			       		WHERE email='".$email->email."' and cpfCnpj='".$email->cpfCnpj."'";
			       		
		   	$soapcliente =  CadastroClienteHelperMSSQLService::getConnection($query); 
		   	if ($soapcliente->sucesso==true) {
		   		if ($soapcliente->conteudo[0]->retorno== "true") {
		   			return true;
		   		}
		   		else{
		   			return false;
		   		}
		   	} else 
		   	{
		   		SELF::criarExececao("COM_CADASTROCLIENTE_LABEL_MENSAGEM_ERRO_NAREQUISICAO");
		   	}
		}
		catch(Exception $e){
			SELF::redirecionar($e->getMessage(), "acesso");
		}
	}

	public function consultarCPFCNPJ($CPFCNPJ)
	{
		try{
			$query =   "SELECT 
		   					CASE WHEN COUNT(*) > 0 
			            	THEN 'true'
			            	ELSE 'false'
			       			END AS retorno 
			       		FROM login 
			       		WHERE cpfCnpj='".$CPFCNPJ."'";
		   	$soapcliente =  CadastroClienteHelperMSSQLService::getConnection($query); 
		   	if ($soapcliente->sucesso==true) {
		   		if ($soapcliente->conteudo[0]->retorno== "true") {
		   			return true;
		   		}
		   		else{
		   			return false;
		   		}
		   	} else 
		   	{
		   		SELF::criarExececao("COM_CADASTROCLIENTE_LABEL_MENSAGEM_ERRO_NAREQUISICAO");
		   	}
		}
		catch(Exception $e){
			SELF::redirecionar($e->getMessage(), "acesso");
		}
	}

	public function consultarCPFSenha($setObjeto)
	{
		try{
			$query ="SELECT 
						CASE WHEN COUNT(*) > 0 
						THEN 'true'
						ELSE 'false'
						END AS retorno 
					FROM login 
					WHERE cpfCnpj='".$setObjeto->cpfCnpj."' and senha=CONVERT(VARBINARY(128),'".$setObjeto->senha."')";
						
		   	$soapcliente =  CadastroClienteHelperMSSQLService::getConnection($query); 
		   	if ($soapcliente->sucesso==true) {
		   		if ($soapcliente->conteudo[0]->retorno== "true") {
		   			return SELF::consultarUsuaio($setObjeto);
		   		}
		   		else{
		   			return false;
		   		}
		   	} else 
		   	{
		   		SELF::criarExececao("COM_CADASTROCLIENTE_LABEL_MENSAGEM_ERRO_NAREQUISICAO");
		   	}
		}
		catch(Exception $e){
			SELF::redirecionar($e->getMessage(), "acesso");
		}
	}

	public function consultarUsuaio($setObjeto)
	{
		try{
			$query ="SELECT ecc.id ,l.cpfcnpj , l.inscricaoEstadual, l.nome, l.dataNascimento, l.email
					FROM login as l
					inner join preCadastroCliente as ecc on ecc.cpfcnpj = l.cpfcnpj
					WHERE l.cpfCnpj='".$setObjeto->cpfCnpj."' and l.senha=CONVERT(VARBINARY(128),'".$setObjeto->senha."')";
						
		   	$soapcliente =  CadastroClienteHelperMSSQLService::getConnection($query); 
		   	if ($soapcliente->sucesso==true) {
		   			return CadastroClienteHelperUtilitarios::criarSessao("cadastraoCLienteLogin", $soapcliente->conteudo[0]);
	   		}
	   		else{
	   			return false;
	   		}
		}
		catch(Exception $e){
			SELF::redirecionar($e->getMessage(), "acesso");
		}
	}

	public function criarRequisicao()
	{
		$objeto =new stdclass();
		$objeto->email = "25";
		$objeto->token = JSession::getFormToken("true");
		$objeto->dataExpiracao = date('Y-m-d H:i');
		$objeto->dataRequisicao = date('Y-m-d H:i', strtotime("+2 days",strtotime($objeto->dataExpiracao)));
		$objeto->requisicao = "teste";
		echo CadastroClienteHelperPersistencia::inserir("#__cadastrocliente_requisicao",$objeto);
	}

	public function criarCadastro(){
		$cadastro = SELF::setObj("acessoinicial");
		$login = new stdclass();
		$login->cpfCnpj = "82305188153";
		$login->inscricaoEstadual = null;
		$login->nome = "Stefano araujo pereira";
		$login->dataNascimento = "11/05/1979";
		$login->email = "beingsane@gmail.com";
		$login->senha = (binary)"123"; //campo nao pode ficar 
		$login->dataCadastro = date("Y-m-d");
		CadastroClienteHelperMSSQLService::inserir("login",$login);
	}

}