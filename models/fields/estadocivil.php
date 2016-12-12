<?php
defined('_JEXEC') or die('Restricted access');
jimport('joomla.form.helper');
JFormHelper::loadFieldClass('list');
class JFormFieldEstadoCivil extends JFormFieldList
{

	protected $type = 'estadocivil';
	
	public function getLista(){
		$retorno =  array();
		$query =   "SELECT 	id, descricao 
					FROM 		estadoCivil 
					ORDER BY 	descricao ASC";
		$ano =	CadastroClienteHelperMSSQLService::getConnection($query);   
		if($ano->sucesso===true)
		{

			$ano = $ano->conteudo;
			$return = array();
			$return[]= JHtml::_('select.option', "", "Selecione");
			foreach ($ano as $key) 
			{
				$return[]= JHtml::_('select.option', $key->id, iconv('CP850','UTF-8//TRANSLIT',  $key->descricao));
			}
			return $return ;
		}
	}

	protected function getOptions()
	{
		$options=$this->getLista();
		$options = array_merge(parent::getOptions(), $options);
		return $options;
		
	}
}
?>