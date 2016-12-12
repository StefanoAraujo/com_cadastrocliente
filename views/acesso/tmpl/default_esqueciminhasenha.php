<?php
defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.formvalidation');

?>
<a href="#EqueciSenha" role="button" class="btn-link" data-toggle="modal"><?php echo JText::_('COM_CADASTROCLIENTE_LABEL_BTN_ESQUECISENHA')  ?></a>
<div id="EqueciSenha" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="EqueciSenhaLabel" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="EqueciSenhaLabel"><?php  echo  JText::_('COM_CADASTROCLIENTE_LABEL_TITLE_TROCASENHA')  ?></h3>
	</div>
	<div class="modal-body">
	<?php echo $this->loadTemplate("form_esqueciminhasenha"); ?>
	</div>
</div>
