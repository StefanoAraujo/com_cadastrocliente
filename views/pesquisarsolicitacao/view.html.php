<?php
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.view');
class CadastroClienteViewPesquisarSolicitacao extends JView
{
	function display($tpl = null)
	{
		$model = new CadastroClienteModelPesquisarSolicitacao;
		$this->formularios = array();
		$this->formulario['filtroprotocolo'] = $model->getFormulario('filtroprotocolo');
		if (count($errors = $this->get('Errors'))){
			JError::raiseError(500, implode('<br />', $errors));
			return false;
		};
		
		parent::display($tpl);
	}

	function debugaEU($print){
		echo "<pre style='margin:40px'>";print_r($print);echo "</pre>";
	}
}
?>