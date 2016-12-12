<?php defined('_JEXEC') or die;
JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidation');
JHtml::_('behavior.tooltip');
?>
<div class="contact-form">
	<form id="contact_form" action="<?php //echo JRoute::_('index.php'); ?>" method="post" class="form-validate form-inline">
		<fieldset>
			<legend><?php echo JText::_($this->document->title); ?></legend>
		     	<center><?php foreach ($this->form->getFieldsets() as $fieldset): ?>
		     	  	<?php $fields = $this->form->getFieldset($fieldset->name);?>
		            <?php foreach($fields as $field): ?>
		                <?php if ($field->hidden): ?>
		                    <?php echo $field->input;?>
		                <?php else:?>
		                    	<?php echo $field->label; ?>
		                        <?php if (!$field->required && $field->type != "Spacer"): ?>
		                            <span class="optional"><?php echo JText::_('COM_CONTACT_OPTIONAL');?></span>
		                        <?php endif; ?>
								<?php echo $field->input;?>
		                <?php endif;?>
		            <?php endforeach;?>
		    	<?php endforeach;?>
	    		<button type="submit" class="validate"><?php echo JText::_('Consultar'); ?></button></center>
		</fieldset>
	</form>
</div>

