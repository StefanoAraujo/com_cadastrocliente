<?php
defined('_JEXEC') or die;
jimport('joomla.application.component.modelform');
jimport('joomla.event.dispatcher');
jimport('joomla.filesystem.file');

class CadastroClienteModelCadastroCliente extends JModelForm
{
	public function excluirEndereco()
	{
		//pegar webservice para pegar os anexos com id:
		$sessao = CadastroClienteHelperUtilitarios::pegarSessao('cadastraoCLienteLogin');
		$entrada = JFactory::getApplication()->input;
        $dados = $entrada->post->get("id",null, 'INT');
        if($dados!=null)
        {
        	$query ="DELETE FROM enderecoprecadastrocliente WHERE id = ".$dados;		
		   	$soapcliente =  CadastroClienteHelperMSSQLService::getConnection($query); 
		   	if ($soapcliente->sucesso==true) {
		   		die(json_encode(array("success" => true , "conteudo" => $soapcliente->conteudo)));
	   		}
	   		else{
	   			return false;
   			}
        } else
        	return false;
	}

	public function excluirAnexo()
	{
		//pegar webservice para pegar os anexos com id:
		$sessao = CadastroClienteHelperUtilitarios::pegarSessao('cadastraoCLienteLogin');
		$entrada = JFactory::getApplication()->input;
        $dados = $entrada->post->get("id",null, 'INT');
        if($dados!=null)
        {
        	$query ="DELETE FROM precadastroclienteArquivo WHERE id = ".$dados;		
		   	$soapcliente =  CadastroClienteHelperMSSQLService::getConnection($query); 
		   	if ($soapcliente->sucesso==true) {
		   		die(json_encode(array("success" => true , "conteudo" => $soapcliente->conteudo)));
	   		}
	   		else{
	   			return false;
   			}
        } else
        	return false;
	}

	public function excluirContato()
	{
		//pegar webservice para pegar os anexos com id:
		$sessao = CadastroClienteHelperUtilitarios::pegarSessao('cadastraoCLienteLogin');
		$entrada = JFactory::getApplication()->input;
        $dados = $entrada->post->get("id",null, 'INT');
        if($dados!=null)
        {
        	$query ="DELETE FROM telefonePreCadastroCliente WHERE id = ".$dados;	
		   	$soapcliente =  CadastroClienteHelperMSSQLService::getConnection($query); 
		   	if ($soapcliente->sucesso==true) {
		   		die(json_encode(array("success" => true , "conteudo" => $soapcliente->conteudo)));
	   		}
	   		else{
	   			return false;
   			}
        } else
        	return false;
        
	}

	public function listarAnexo()
	{
		//pegar webservice para pegar os anexos com id:
		$sessao = CadastroClienteHelperUtilitarios::pegarSessao('cadastraoCLienteLogin');
        $query ="SELECT * FROM precadastroclienteArquivo WHERE preCadastroCliente_id = ".$sessao->id;		
	   	$soapcliente =  CadastroClienteHelperMSSQLService::getConnection($query); 
	   	if ($soapcliente->sucesso==true) {
	   		die(json_encode(array("success" => true , "conteudo" => $soapcliente->conteudo)));
   		}
   		else{
   			return false;
   		}
	}

	public function listarContato()
	{
		$sessao = CadastroClienteHelperUtilitarios::pegarSessao('cadastraoCLienteLogin');
        $query ="SELECT * FROM telefonePreCadastroCliente WHERE preCadastroCliente_id = ".$sessao->id;	
	   	$soapcliente =  CadastroClienteHelperMSSQLService::getConnection($query); 
	   	if ($soapcliente->sucesso==true) {
	   		die(json_encode(array("success" => true , "conteudo" => $soapcliente->conteudo)));
   		}
   		else{
   			return false;
   		}
	}

	public function listarPrincipalEndereco()
	{
		$sessao = CadastroClienteHelperUtilitarios::pegarSessao('cadastraoCLienteLogin');
		$query ="SELECT * FROM enderecoprecadastrocliente WHERE preCadastroCliente_id = ".$sessao->id;		
	   	$soapcliente =  CadastroClienteHelperMSSQLService::getConnection($query); 
	   	if ($soapcliente->sucesso==true) {
	   		die(json_encode(array("success" => true , "conteudo" => $soapcliente->conteudo[0])));
   		}
   		else{
   			return false;
   		}
	}

	public function listarEndereco()
	{
		$sessao = CadastroClienteHelperUtilitarios::pegarSessao('cadastraoCLienteLogin');
		$query ="SELECT * FROM enderecoprecadastrocliente WHERE preCadastroCliente_id = ".$sessao->id;		
	   	$soapcliente =  CadastroClienteHelperMSSQLService::getConnection($query); 
	   	if ($soapcliente->sucesso==true) {
	   		die(json_encode(array("success" => true , "conteudo" => $soapcliente->conteudo)));
   		}
   		else{
   			return false;
   		}
	}	

	public function cadastrarAnexo()
	{
		$entrada = JFactory::getApplication()->input;
        $dados = $entrada->post->get("anexo",null, 'Array');
		$files = $entrada->files->get('anexo');
		$data = file_get_contents($files['anexo']['tmp_name']);
		$src = 'data: '.$files['anexo']['type'].';base64,'.base64_encode($data);
		//echo "<img src=\"$src\" alt=\"\" />";
		//recebe arquivo base64 envia para o service do gcom retornar o id do arquivo;
		// var_dump($src);
		//echo "<img src=\"$src\" alt=\"\" />";
		// echo base64_decode($src);
        $sessao = CadastroClienteHelperUtilitarios::pegarSessao('cadastraoCLienteLogin');
        //var_dump($sessao);
        $arquivoGCOM_id  = 12; //receber o id do aqruivo vindo do webservice do fcom
        $query ="
		INSERT INTO [dbo].[preCadastroClienteArquivo]
           ([arquivoGCOM_id]
           ,[preCadastroCliente_id])
     	VALUES
           (".$arquivoGCOM_id."
           ,".$sessao->id.")
        ";	
	   	$soapcliente =  CadastroClienteHelperMSSQLService::getConnection($query); 
	   	return true;
	}


	public function incluirContato()
	{
		$entrada = JFactory::getApplication()->input;
        $dados = $entrada->post->get("dadoscontato",null, 'Array');
        $sessao = CadastroClienteHelperUtilitarios::pegarSessao('cadastraoCLienteLogin');
        $query ="
		INSERT INTO [dbo].[telefonePreCadastroCliente]
           ([tipoTelefone_id]
           ,[pais_id]
           ,[preCadastroCliente_id]
           ,[nome]
           ,[ddd]
           ,[numero]
           ,[ramal]
           ,[principal]
           ,[nacional])
     VALUES
           (".$dados['tipoTelefone_id']."
           ,".$dados['pais_id']."
           ,".$sessao->id."
           ,'".$dados['nome']."'
           ,'".$dados['ddd']."'
           ,'".$dados['numero']."'
           ,'".$dados['ramal']."'
           ,".$dados['principal']."
           ,".$dados['nacional'].")
        ";	
	   	$soapcliente =  CadastroClienteHelperMSSQLService::getConnection($query); 
	   	return true;
	}

	public function incluirEndereco()
	{
		$entrada = JFactory::getApplication()->input;
        $dados = $entrada->post->get("dadosenderecopf",null, 'Array');
        $sessao = CadastroClienteHelperUtilitarios::pegarSessao('cadastraoCLienteLogin');
        date_default_timezone_set('America/Sao_Paulo');
		$data = date('Y-m-d');
        $query ="INSERT INTO [dbo].[enderecoPreCadastroCliente]
			           ([tipoEndereco_id]
			           ,[pais_id]
			           ,[uf_id]
			           ,[tipoLogradouro_id]
			           ,[preCadastroCliente_id]
			           ,[cep]
			           ,[bairro]
			           ,[cidade]
			           ,[enderecoCompleto]
			           ,[complemento]
			           ,[numero]
			           ,[longitude]
			           ,[latitude]
			           ,[ativo]
			           ,[correspondencia]
			           ,[dataCadastro])
			     VALUES
			           (".$dados['tipoEndereco_id']."
			           ,".$dados['pais_id']."
			           ,".$dados['uf_id']."
			           ,".$dados['tipoLogradouro_id']."
			           ,".$sessao->id."
			           ,".$dados['cep']."
			           ,'".$dados['bairro']."'
			           ,'".$dados['cidade']."'
			           ,'".$dados['enderecoCompleto']."'
			           ,'".$dados['complemento']."'
			           ,'".$dados['numero']."'
			           ,'".$dados['longitude']."'
			           ,'".$dados['latitude']."'
			           ,".$dados['ativo']."
			           ,".$dados['correspondencia']."
			           ,'".$data."')";		
		   	$soapcliente =  CadastroClienteHelperMSSQLService::getConnection($query); 
		   	return true;
	}

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


}