<?php
defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.formvalidation');
?>
<div class="row-fluid">
	<div class="span4"> </div>
	<div class="span4 animated pulse" style="padding: 5%">
		<form action="" method="post" class="form-validate">
			<fieldset>
					<?php foreach ($this->formulario['perfilpf']->getFieldsets() as $fieldset): ?>
			     	  	<legend><?php echo  JText::_($fieldset->label);$fields = $this->formulario['perfilpf']->getFieldset($fieldset->name);?></legend>
			            <?php echo  JText::_('COM_CADASTROCLIENTE_LABEL_USUARIOFORM');?><br><br>
			            <?php foreach($fields as $field): ?>
			                <?php if ($field->hidden): ?>
			                    <?php echo $field->input;?>
			                <?php else:?>
			                    	<?php echo $field->label; ?>
									<?php echo $field->input;?>
									<span class="help-block" style="margin-bottom: 15px"><?php echo JText::_('COM_CADASTROCLIENTE_LABEL_FORM_SENHATAMANHO')  ?></span>
			                <?php endif;?>
			            <?php endforeach;?>
			    	<?php endforeach;?>
			    	<?php echo JHtml::_( 'form.token' ); ?>
			    	<input type="hidden" name="task" value='convenio.listarConveniado'><?php echo JText::_('COM_CADASTROCLIENTE_LABEL_MENSAGEM_TROCASENHAFORM'); ?>
		    		<div style="text-align:right; "><button type="submit" class="validate btn btn-primary"><?php echo JText::_('COM_CADASTROCLIENTE_LABEL_BTN_SALVAR')  ?></button></div>
			</fieldset>
		</form>
	</div>
	<div class="span4"> </div>
</div>
<div id="lista"></div>