<?php
defined('_JEXEC') or die;
define("COM_CONTRATOCLIENTE_MESSAGE_DESCRICAOERRO",     "alguma coisa");
define("COM_CONTRATOCLIENTE_MESSAGE_DESCRICAOERRO_CASE_INI",     "alguma coisa");
define("COM_CONTRATOCLIENTE_MESSAGE_DESCRICAOERRO_1",     "alguma coisa");
define("COM_CONTRATOCLIENTE_MESSAGE_DESCRICAOERRO_CASE_END",     "alguma coisa");
define("COM_CONTRATOCLIENTE_MESSAGE_TOKEN",     "alguma coisa");
class CadastroClienteHelperWebservice
{
   private function getConnection($query){
		$curl = curl_init($query);
		curl_setopt($curl, CURLOPT_USERPWD, "UsuarioRestService:R35753rv1cE");
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
	    $curl_response = curl_exec($curl);
	    $info = curl_getinfo($curl);
		curl_close($curl);
		if ($curl_response === false){
		  	$decoded = new stdClass (); 
		  	$decoded->retorno = new stdClass (); 
		  	$decoded->retorno->sucesso = false;
		  	$decoded->retorno->descricaoErro = COM_CONTRATOCLIENTE_MESSAGE_DESCRICAOERRO;
		  	return $decoded;
		} else {
				$decoded = json_decode($curl_response);
				if (isset($decoded->retorno->sucesso)) 
				{
					if (empty($decoded->retorno->sucesso)) {
				 	$decoded->retorno->descricaoErro = COM_CONTRATOCLIENTE_MESSAGE_DESCRICAOERRO_CASE_INI.((preg_match("/rastreamento/",$decoded->retorno->descricaoErro)) ? COM_CONTRATOCLIENTE_MESSAGE_DESCRICAOERRO_1 : ($decoded->retorno->descricaoErro.COM_CONTRATOCLIENTE_MESSAGE_DESCRICAOERRO_CASE_END));
				}
				return $decoded;
			}
		}
	}

    public static function getServicePOST($form){
    	JSession::checkToken()or SELF::redireciona(COM_CONTRATOCLIENTE_MESSAGE_TOKEN);
    	$jinput = JFactory::getApplication()->input;
    	$data  = $jinput->post->get($form, array(), 'array');
    	$service = $data['service'];
    	unset($data['service']);
    	$service_url =  SELF::getURLService($service, $data);
		$retorno = SELF::getConnection($service_url);
		if ($retorno->retorno->sucesso===false) {
			return $retorno->retorno;
		}
		return $retorno;
	}

	public static function getServiceGET($form){
		JSession::checkToken('get')or SELF::redireciona(COM_CONTRATOCLIENTE_MESSAGE_TOKEN);
    	$jinput = JFactory::getApplication()->input;
    	$data  = $jinput->get($form, array(), 'array');
    	$service = $data['service'];
    	unset($data['service']);
    	$service_url = SELF::getURLService($service, $data);
		$retorno = SELF::getConnection($service_url);
		if ($retorno->retorno->sucesso===false) {
			return $retorno->retorno;
		}
		return $retorno;
	}

	public static function getService($service, $array=null){
    	$service_url = SELF::getURLService($service, $array);
		$retorno = SELF::getConnection($service_url);
		if ($retorno->retorno->sucesso===false) {
			return $retorno->retorno;
		}
		return $retorno;
	}


	private function getURLService($service, $array=null){
		if($array==null){
			$param = "";
		} else
		{
			$param = (is_array($array)) ? SELF::arraytoURLparam($array) : "?".$array;
		}
		
		switch ($service) {
			case 'cadastroclienteArquivo'  :$retorno = "http://homolog.caesb/gedocj/app/rest/cadastroclienteArquivo/pesquisarArquivo.json";break;//numero=8444&ano=2014 ?numero=8444&ano=2014
			case 'cadastroclienteAdicional':$retorno = "http://homolog.caesb/gedocj/app/rest/cadastroclienteAdicional/pesquisarArquivo.json";break;//idCadastroClienteAquivo=3819	 ?idCadastroClienteAquivo=3819
			case 'download': $retorno = "http://homolog.caesb/gedocj/app/rest/arquivoBinario/recuperarArquivo.json";break;//nome
			case 'ListarConvenio':$retorno = "";break;
			case 'EmailSemAnexo':$retorno = "";break;
			case 'arquivoBase64':$retorno = "";break;////src-ticcor01/SHARED/Arquivos/GEDOC/
			default: return false;break;
		}
		return $retorno.$param ;
	}

	private function arraytoURLparam($array)
	{
		$url ="";
		$param = "?"; 
		foreach ($array as $key =>$value) {
			$url .= $param.$key."=".$value;
			$param = "&"; 
		}
		return $url;
	}

	private function redireciona($RetornoMensagem)
	{
		$application = JFactory::getApplication();
		$url = JURI::current();
		$application->redirect($url, $RetornoMensagem, $msgType='message');
	}


}