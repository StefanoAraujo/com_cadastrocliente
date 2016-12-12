<?php
defined('_JEXEC') or die('Acesso Restrito!');
jimport('joomla.filter.output');
JHtml::_('behavior.formvalidation');
JHtml::_('behavior.keepalive');
JHtml::_('behavior.tooltip');
?>

<form action="" id="acessoinicial" method="post" class="">
	<fieldset>
			<?php foreach ($this->formulario['acessoinicial']->getFieldsets() as $fieldset): ?>
	     	  	<legend><?php echo  JText::_($fieldset->label);$fields = $this->formulario['acessoinicial']->getFieldset($fieldset->name);?></legend>
	     	  	<label class="radio inline">
			  <input type="radio" id="optCPF" name="optCPFCNPJ" value="0" checked><?php echo JText::_('COM_CADASTROCLIENTE_LABEL_FORM_CPF')  ?> 
			</label>
			<label class="radio inline">
			  <input type="radio" id="optCNPJ" name="optCPFCNPJ" value="1"><?php echo JText::_('COM_CADASTROCLIENTE_LABEL_FORM_CNPJ')  ?> 
			</label>
	            <?php foreach($fields as $field): ?>
	                <?php if ($field->hidden): ?>
	                    <?php echo $field->input;?>
	                <?php else:?>
	                    	<?php echo $field->label; ?>
							<?php echo $field->input;?>
	                <?php endif;?>
	            <?php endforeach;?>
	    	<?php endforeach;?>
	    	<?php echo JHtml::_( 'form.token' ); ?>
	    	<input type="hidden" name="task" value='acesso.incluirSolicitacao'>
	    	<?php echo $this->loadTemplate("termodeuso"); ?><br><br>
	    	<?php echo $this->loadTemplate('captcha'); ?>
    		<div style="text-align: right"><button type="submit" class="validate btn btn-primary"><?php echo JText::_('COM_CADASTROCLIENTE_LABEL_BTN_CADASTRAR')  ?></button></div>
	</fieldset>
</form>
