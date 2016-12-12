<?php
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.view');
class CadastroClienteViewRedefinirAcesso extends JView
{
	function display($tpl = null)
	{
		$model = new CadastroClienteModelAcesso;
		$this->formularios = array();
		$this->formulario['acessoinicial'] = $model->getFormulario('acessoinicial');
		$this->formulario['acessoprincipal'] = $model->getFormulario('acessoprincipal');
		$this->formulario['acessoredefinir'] = $model->getFormulario('acessoredefinir');

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