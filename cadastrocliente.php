<?php
defined('_JEXEC') or die;
jimport('joomla.application.component.controller');
JLoader::register('CadastroClienteToolbar', JPATH_COMPONENT . DS . 'toolbars' . DS . 'cadastrocliente.php');
JLoader::register('CadastroClienteHelperWebservice', JPATH_COMPONENT . DS . 'helpers' . DS . 'webservice.php');
JLoader::register('CadastroClienteHelperMSSQLService', JPATH_COMPONENT . DS . 'helpers' . DS . 'mssqlservice.php');
JLoader::register('CadastroClienteHelperUtilitarios', JPATH_COMPONENT . DS . 'helpers' . DS . 'utilitarios.php');
JLoader::register('CadastroClienteHelperPersistencia', JPATH_COMPONENT . DS . 'helpers' . DS . 'persistencia.php');
JLoader::register('CadastroClienteHelperSoapService', JPATH_COMPONENT . DS . 'helpers' . DS . 'soapservice.php');
$language = JFactory::getLanguage();
$language->load('com_cadastrocliente', JPATH_SITE, 'en-GB', true);
//$language->load('com_cadastrocliente', JPATH_SITE, null, true);
$doc = JFactory:: getDocument();
$doc->addStyleSheet('components/com_cadastrocliente/assets/css/cadastrocliente.css','text/css');
$doc->addStyleSheet('components/com_cadastrocliente/assets/css/animate.css','text/css');
$doc->addStyleSheet('components/com_cadastrocliente/assets/css/hover-min.css','text/css');
$doc->addScriptDeclaration("
   function animationHover(element, animation){
	    element = $(element);
	    element.hover(
	        function() {
	            element.addClass('animated ' + animation);        
	        },
	         function(){
	            //wait for animation to finish before removing classes
	            window.setTimeout( function(){
	                element.removeClass('animated ' + animation);
	        }, 2000);         
	    });
	}
");
$doc->addScript('components/com_cadastrocliente/assets/js/cadastrocliente.js');
$doc->addScript('components/com_cadastrocliente/assets/js/jquery.mask.min.js');
$doc->addScript('components/com_cadastrocliente/assets/js/jquery.validate.min.js');
$doc->addScript('components/com_cadastrocliente/assets/js/additional-methods.min.js');
$toolbar = new CadastroClienteToolbar;
$toolbar = $toolbar->cadastroClienteToolbar();
$controller	= JControllerLegacy::getInstance('CadastroCliente');
$controller->execute(JRequest::getCmd('task'));
$controller->redirect();


