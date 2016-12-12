<?php
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.view');
class CadastroClienteViewAtualizarDadosCadastrais extends JView
{
	function display($tpl = null)
	{
		$model = new CadastroClienteModelAtualizarDadosCadastrais;
		$this->formularios = array();
		$this->formulario['dadosbasicospf'] = $model->getFormulario('dadosbasicospf');
		$this->formulario['dadoscontato'] = $model->getFormulario('dadoscontato');
		$this->formulario['dadoscomplementarespf'] = $model->getFormulario('dadoscomplementarespf');
		$this->formulario['dadosenderecopf'] = $model->getFormulario('dadosenderecopf');
		$this->formulario['anexo'] = $model->getFormulario('anexo');
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