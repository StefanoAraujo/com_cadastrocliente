<?php 
defined('_JEXEC') or die;
jimport('joomla.factory');


class CadastroClienteHelperSoapService
{
    var $contexto = array(
            'http'=>array('user_agent' => 'PHPSoapClient', 
                            'protocol_version'=>'1.0',
                            'header' => 'Connection: Close'),
            'ssl' => array('verify_peer' => false,
                            'verify_peer_name' => false,
                            'allow_self_signed' => true),
            );
    var $parametros = array(
                'encoding'          => 'UTF-8',
                'verify_peer'       => false, 
                'verify_peer_name'  => false,
                'soap_version'      => SOAP_1_1,
                'style'             => SOAP_DOCUMENT,
                'use'               => SOAP_LITERAL,
                'cache_wsdl'        => WSDL_CACHE_NONE,
                'trace'             => true,
                'exceptions'        => 1, 
                "connection_timeout"=> 180, 
            );

    private function redirecionar($RetornoMensagem, $view = null)
    {

        $application = JFactory::getApplication();
        $url = ($view) ? JRoute::_('index.php?option=com_cadastrocliente&view='.$view): JURI::current();
        $application->redirect($url, $RetornoMensagem, $msgType='message');
    }

    public function clientesoap($endereco, $parametro = null, $contexto = null )
    {
        ini_set('soap.wsdl_cache_enabled', '0'); 
        ini_set('soap.wsdl_cache_ttl', '0'); 
        try{
            if(is_array($contexto))
            {
                if(!is_null($contexto))
                {
                   SELF::setContexto($contexto);
                }
            }
            if(is_array($parametro))
            {
                if(!is_null($parametro))
                {
                   SELF::setParamentro($parametro);
                }
            }
            SELF::setParamentro(array('stream_context' => stream_context_create($this->contexto)));
            return new SoapClient($endereco,$this->parametros);
        }
        catch(Exception $e){
           SELF::redirecionar($e->getMessage(),"acesso");
        }
    }

    public function setContexto($valor = array())
    {
        $this->contexto  += $valor;
    }

    public function setParamentro($valor = array())
    {
        $this->parametros  += $valor;
    }
}



?>