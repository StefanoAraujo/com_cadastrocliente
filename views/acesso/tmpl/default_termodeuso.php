<?php
defined('_JEXEC') or die('Restricted access');
jimport('joomla.filter.output');
JHtml::_('behavior.formvalidation');
JHtml::_('behavior.keepalive');
JHtml::_('behavior.tooltip');
?>
<a href="#TermoDeUsu" role="button" class="btn-link" data-toggle="modal"><?php echo JText::_('COM_CADASTROCLIENTE_LABEL_BTN_TERMODEUSO')  ?></a>
<div id="TermoDeUsu" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="TermoDeUsuLabel" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="TermoDeUsuLabel"><?php echo JText::_('COM_CADASTROCLIENTE_LABEL_BTN_TERMODEUSO')  ?></h3>
	</div>
	<div class="modal-body">
		<?php echo $this->loadTemplate("documento_termodeuso");  ?>
	</div>
</div>