<?php
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.view');
class CadastroClienteViewConfirmarAcesso extends JView
{
	function display($tpl = null)
	{
		$model = new CadastroClienteModelConfirmarAcesso;
		CadastroClienteHelperUtilitarios::verificarSessao("cadastroNovoCliente") or CadastroClienteHelperUtilitarios::redireciona(Jtext::_("COM_CADASTROCLIENTE_LABEL_MENSAGEM_ERRO_EMAILEXPIRADO"), "acesso");
		$this->formularios = array();
		$this->formulario['email'] = $model->getFormulario('email');
		$this->nome = CadastroClienteHelperUtilitarios::pegarSessao("cadastroNovoCliente");
		$this->nome = $this->nome->nome;
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