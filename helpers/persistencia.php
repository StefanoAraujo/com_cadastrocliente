<?php
defined('_JEXEC') or die;
jimport('joomla.factory');

class CadastroClienteHelperPersistencia
{
	public static function inserir($tabela,$objeto)
	{
		$db = JFactory::getDbo();
		return $db->insertObject($tabela, $objeto);
	}

	public static function alterar($tabela,$objeto,$id)
	{
		$result = JFactory::getDbo()->updateObject($tabela,$objeto, $id);
	}

	public static function deletar($tabela , $condicao)
	{
		$db = JFactory::getDbo();
 		$query = $db->getQuery(true);
		$query->delete($db->quoteName($tabela));
		$query->where($condicao);
		$db->setQuery($query);
		return $db->execute();
	}

	public static function selecionar($query)
	{
		$db = JFactory::getDbo();
		$db->setQuery($query);
		return $db->loadObjectList();
	}

	public static function extendQuery(){
		$db = JFactory::getDbo();
		return $db->getQuery(true);
	}

	public static function protegerQuery($variavel, $valor, $tipo=1)
	{
		$db = JFactory::getDbo();
		return array($db->quoteName($variavel) . ' = ' . (($tipo==1)? $db->quote('$valor'):$valor));
	}

	public static function pegarInstancia($option = array())
	{
		$option['driver']   = 'mysql';            // Database driver name
		$option['host']     = '192.168.103.21';    // Database host name
		$option['user']     = 'internet';       // User for database authentication
		$option['password'] = '1User@Site2';   // Password for database authentication
		$option['database'] = 'internet2012';      // Database name
		$option['prefix']   = 'prt_';
		//$db = JFactory::getDBO();
		try
		{
		    //$db = JDatabase::getInstance($option);
		    $db = JDatabaseDriver::getInstance( $option );	
		}
		catch (RuntimeException $e)
		{
		    JFactory::getApplication()->enqueueMessage($e->getMessage());
		    $db->setDebug($debug);
		    return false;
		}
		return $db;		 
	}


	public static function selecionarInstancia($query)
	{
		$db = SELF::pegarInstancia();
		$db->setQuery($query);
		return $db->loadObjectList();
	}

	public static function retornoErro(){
		if ($db->getErrorNum()) {
    		JError::raiseWarning(500, $db->getErrorMsg());
		} 
	}
}

	