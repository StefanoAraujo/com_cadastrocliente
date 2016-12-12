<?php
defined('_JEXEC') or die('Restricted access');
jimport('joomla.form.helper');
jimport('joomla.model.classes.pais');
JFormHelper::loadFieldClass('list');
class JFormFieldUF extends JFormFieldList
{

	protected $type = 'uf';
	
	public function getConveniadoLista(){
		$retorno =  array();
		$query =   "SELECT 	id, sigla, descricao 
					FROM 		uf 
					ORDER BY 	sigla ASC";
		$ano =	CadastroClienteHelperMSSQLService::getConnection($query);   
		if($ano->sucesso===true)
		{

			$ano = $ano->conteudo;
			$return = array();
			$return[]= JHtml::_('select.option', "", "Selecione");
			foreach ($ano as $key) 
			{
				$return[]= JHtml::_('select.option', $key->id, iconv('CP850','UTF-8//TRANSLIT',  $key->sigla. " - ". $key->descricao ));
			}
			return $return ;
		}
	}

	protected function getOptions()
	{
		$options=$this->getConveniadoLista();
		$options = array_merge(parent::getOptions(), $options);
		return $options;
		
	}
}
?>