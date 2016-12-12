<?php
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.view');
class CadastroClienteViewAlterarPerfil extends JView
{
	function display($tpl = null)
	{
		$model = new CadastroClienteModelAlterarPerfil;
		$this->formularios = array();
		$this->formulario['perfilpf'] = $model->getFormulario('perfilpf');
		$this->formulario['perfilpj'] = $model->getFormulario('perfilpj');
		$this->SessaoUsuario =  $model->pegarSessao("cadastraoCLienteLogin");
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