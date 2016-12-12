<?php
defined('_JEXEC') or die;
jimport('joomla.application.component.controller');
class CadastroClienteController extends JControllerLegacy
{
	public function display($cachable = false, $urlparams = false)
	{
		$cachable	= true;
		$user		= JFactory::getUser();
		$id	= JRequest::getInt('sub_id');
		$vName = JRequest::getCmd('view', 'category');
		JRequest::setVar('view', $vName);
		if ($user->get('id')) {
			$cachable = false;
		}
		$safeurlparams = array(
			'id'				=> 'INT',
			'limit'				=> 'INT',
			'limitstart'		=> 'INT',
			'filter_order'		=> 'CMD',
			'filter_order_Dir'	=> 'CMD',
			'lang'				=> 'CMD'
		);
		if ($vName == 'form' && !$this->checkEditId('com_cadastrocliente.edit.subscription', $id)) {
			return JError::raiseError(403, JText::sprintf('JLIB_APPLICATION_ERROR_UNHELD_ID', $id));
		}
		return parent::display($cachable,$safeurlparams);
	}
}
