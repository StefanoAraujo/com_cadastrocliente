<?php
defined('_JEXEC') or die;
jimport('joomla.application.component.controller');
require_once JPATH_COMPONENT.'/models/servicos.php';
jimport('joomla.user.helper');
class CadastroClienteControllerServicos extends JController
{

	private function criarExececao($erro)
	{
		throw new Exception($erro);
	}

	public function validarEmail()
	{
		try {
			$exp = "^[a-z\'0-9]+([._-][a-z\'0-9]+)*@([a-z0-9]+([._-][a-z0-9]+))+$";
		   	$entrada = JFactory::getApplication()->input;
		   	$email = ($entrada->post->get('email', false , 'string'))? $entrada->post->get('email', false , 'string'): ($entrada->get->get('email', false , 'string'))? $entrada->get->get('email', false , 'string') : SELF::criarExececao("Campo Obrigatório não informado"); 
		   	if(eregi($exp,$email))
		   	{
				if(checkdnsrr(array_pop(explode("@",$email)),"MX"))
					{
						 die(json_encode(array("success" => true)));
					}
					else
					{
					SELF::criarExececao("O domínio do e-mail informado é invalido"); 
				}

		   	}else
		   	{
				SELF::criarExececao("O e-mail informado é inválido");
		   	}    
		} catch (Exception $e) {
		    die(json_encode(array("success" => false, "error"=>$e->getMessage())));
		}
	}

	public function validarCEP()
	{
		try{
			$soapcliente =  new CadastroClienteHelperSoapService();
		   	$parametros = array(
	           'proxy_host'        => 'proxy.caesb',
	           'proxy_port'        => 8080,
	           'proxy_login'       => 'caesb_net\stefanopereira',
	           'proxy_password'    => 'Agaa112016',
	           );
			$cliente = $soapcliente->clientesoap('https://apps.correios.com.br/SigepMasterJPA/AtendeClienteService/AtendeCliente?wsdl',$parametros);
	            $entrada = JFactory::getApplication()->input;
	            $getcep = ($entrada->post->get('cep', false , 'string'))? $entrada->post->get('cep', false , 'string'): ($entrada->get->get('cep', false , 'string'))? $entrada->get->get('cep', false , 'string') : die(json_encode(array("success" => false, "error"=>"Campo obrigatório não informado")));
	            $cep =  array( 'cep' => $getcep);
				$resultado = $cliente->consultaCEP($cep);
				Jexit(json_encode($resultado));
		}
		catch(Exception $e){
		    die(json_encode(array("success" => false, "error"=>$e->getMessage())));
		}

	}

	public function consultarCPFCNPJ()
	{
		try{
			$entrada = JFactory::getApplication()->input;
		   	$CPFCNPJ = ($entrada->post->get('cpfcnpj', false , 'string'))? $entrada->post->get('cpfcnpj', false , 'string'): (($entrada->get->get('cpfcnpj', false , 'string'))? $entrada->get->get('cpfcnpj', false , 'string') : SELF::criarExececao("Campo Obrigatório não informado"));
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
		   			die(json_encode(array("success" => true, "retorno"=>"O CPF/CNPJ de  informado foi encontrado")));
		   		}
		   		else{
		   			die(json_encode(array("success" => false, "retorno"=>"O CPF/CNPJ informado não foi  Cadastrado")));
		   		}
		   	} else 
		   	{
		   		 SELF::criarExececao("Erro na requisição web");
		   	}
		}
		catch(Exception $e){
		    die(json_encode(array("success" => false, "error"=>$e->getMessage())));
		}

	}
}
