<?php
defined('_JEXEC') or die;
jimport('joomla.application.component.modelform');
jimport('joomla.event.dispatcher');
jimport('joomla.filesystem.file');

class CadastroClienteModelAlterarPerfil extends JModelForm
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

	private function setObj($string)
	{
		$entrada = JFactory::getApplication()->input;
        $dados = $entrada->post->get($string,null, 'Array');
		$login = new stdclass();
		$login->cpfCnpj = preg_replace('/\D+/', '', ((isset($dados['cpfCnpj']))?$dados['cpfCnpj']:null));
		$login->inscricaoEstadual = preg_replace('/\D+/', '', ((isset($dados['inscricaoEstadual']))?$dados['inscricaoEstadual']:null));
		$login->nome = (isset($dados['nome']))?$dados['nome']:null;
		$login->dataNascimento = (isset($dados['datanascimento']))?$dados['datanascimento']:null;
		$login->email = (isset($dados['email']))?$dados['email']:null;
		$login->senha = (isset($dados['senha']))?$dados['senha']:null;
		$login->dataCadastro = (isset($dados['dataCadastro']))?$dados['dataCadastro']:null;
		return $login;
	}

	public function pegarSessao()
	{
		try {
			CadastroClienteHelperUtilitarios::verificarSessao("cadastraoCLienteLogin") or SELF::criarExececao("COM_CADASTROCLIENTE_LABEL_MENSAGEM_ERRO_SESSAOEXPIRADA");	
			$SessaoUsuario = CadastroClienteHelperUtilitarios::pegarSessao("cadastraoCLienteLogin");
			$query ="SELECT * 
					FROM login 
					WHERE cpfCnpj='".$SessaoUsuario->cpfcnpj."'";
            $soapcliente =  CadastroClienteHelperMSSQLService::getConnection($query);
            if ($soapcliente->sucesso==true) {
                return $soapcliente->conteudo[0];
            }
            else{
                return false;
            }
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
		return "<div class='alert alert-".$tipo."'>".$menssagem."<div>";
	}

	private function criarExececao($erro)
	{
		throw new Exception(SELF::criarAlerta(Jtext::_($erro), "erro"));
	}

	public function alterarPerfil()
	{
		try {
			$cadastroCliente = SELF::pegarSessao("cadastraoCLienteLogin");
			$formulario = (strlen($cadastroCliente->cpfCnpj)==11) ?SELF::setObj("perfilpf"): SELF::setObj("perfilpj");
			$sqlQuery = "UPDATE login SET
				".(($formulario->inscricaoEstadual)? (" inscricaoEstadual = '".$formulario->inscricaoEstadual."',"): "")."
	  			".(($formulario->nome)? (" nome = '".$formulario->nome."',"): "")."
	  			".(($formulario->dataNascimento)? (" dataNascimento = '".CadastroClienteHelperUtilitarios::formatarData("Y-m-d", $formulario->dataNascimento)."',"): "")."
	  			".(($formulario->email)? (" email = '".$formulario->email."'"): "")."
				WHERE cpfcnpj= '".$cadastroCliente->cpfCnpj."'";
			$sqlQuery = CadastroClienteHelperUtilitarios::decodeCharset($sqlQuery, 4);
			CadastroClienteHelperMSSQLService::getConnection($sqlQuery);
			//SELF::renovarSessao($setObjeto) or SELF::criarExececao("COM_CADASTROCLIENTE_LABEL_MENSAGEM_ERRO_CRIARSESSAO");;
		} catch (Exception $e) {
			SELF::redirecionar($e->getMessage(), "acesso");
		}
	}

	private function renovarSessao($setObjeto)
	{
		try{
			$query ="SELECT cpfcnpj , inscricaoEstadual, nome, dataNascimento, email
					FROM login 
					WHERE cpfCnpj='".$setObjeto->cpfCnpj."'";
						
		   	$soapcliente =  CadastroClienteHelperMSSQLService::getConnection($query); 
		   	if ($soapcliente->sucesso==true) {
		   		CadastroClienteHelperUtilitarios::deletarSessao("cadastraoCLienteLogin");
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



}
