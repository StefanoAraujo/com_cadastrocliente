<?php
defined('_JEXEC') or die;
class CadastroClienteDispatcherDispatcher extends JControllerForm
{
	public  function InportarPlugin($evento, $dados)
	{
		$dispatcher = JDispatcher::getInstance();
		return $dispatcher->trigger($evento, $dados);
	}
}