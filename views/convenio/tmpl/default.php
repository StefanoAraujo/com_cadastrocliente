<?php
defined('_JEXEC') or die('Acesso Restrito!');
jimport('joomla.filter.output');
JHtml::_('behavior.formvalidation');
JHtml::_('behavior.keepalive');
JHtml::_('behavior.tooltip');
$conteudo = $this->getModel()->getConteudo();
?>
<div class="row-fluid">
	<div class="span12" style="padding:20px">
		<h3><?php echo $conteudo->title; ?></h3>
		<p><?php echo $conteudo->introtext; ?></p>
	</div>
</div>
<div class="row-fluid">
	<div class="span3">
		
	</div>
	<div class="span6">
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
			    	<?php echo JHtml::_( 'form.token' ); ?>
			    	<input type="hidden" name="task" value='convenio.listarConveniado'>
		    		<button type="submit" class="validate btn btn-primary"><?php echo JText::_('Consultar'); ?></button></center>
			</fieldset>
		</form>
	</div>

	<div class="span3">
		
	</div>
</div>



