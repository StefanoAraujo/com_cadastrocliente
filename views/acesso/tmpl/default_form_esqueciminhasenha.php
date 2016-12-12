<?php
defined('_JEXEC') or die('Acesso Restrito!');
jimport('joomla.filter.output');
JHtml::_('behavior.formvalidation');
JHtml::_('behavior.keepalive');
JHtml::_('behavior.tooltip');
?>
<form action="" id="acessoredefinir" method="post" class="">
	<fieldset>
			<?php foreach ($this->formulario['acessoredefinir']->getFieldsets() as $fieldset): ?>
	     	  	<?php echo  JText::_($fieldset->label);$fields = $this->formulario['acessoredefinir']->getFieldset($fieldset->name);?><br><br>
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
	    	<input type="hidden" name="task" value='acesso.solicitarsenha'>
    		<div style="text-align:right; "><button type="submit" class="validate btn btn-primary"><?php echo JText::_('COM_CADASTROCLIENTE_LABEL_BTN_CONTINUAR')  ?></button></div>
	</fieldset>
</form>
