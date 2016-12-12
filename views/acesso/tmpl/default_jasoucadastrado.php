<?php
defined('_JEXEC') or die('Acesso Restrito!');
jimport('joomla.filter.output');
JHtml::_('behavior.formvalidation');
JHtml::_('behavior.keepalive');
JHtml::_('behavior.tooltip');
?>
<form action="" method="post" id="acessoprincipal" class="">
	<fieldset>
			<?php foreach ($this->formulario['acessoprincipal']->getFieldsets() as $fieldset): ?>
	     	  	<legend class="animated pulse"><?php echo  JText::_($fieldset->label);$fields = $this->formulario['acessoprincipal']->getFieldset($fieldset->name);?></legend>
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
	    	<input type="hidden" name="task" value='acesso.efetuarlogin'>
	    	
    		<div style="text-align: right"><button type="submit" class="validate btn btn-primary"><?php echo JText::_('COM_CADASTROCLIENTE_LABEL_BTN_ENTRAR')  ?></button></div>
	</fieldset>
</form>
<?php echo $this->loadTemplate("esqueciminhasenha"); ?>
