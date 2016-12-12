<?php
defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.formvalidation');
?>
<style type="text/css">
	.error{
		color:red;
	}

	input.error {
	    content: "Campo Obrigatório";
	    border-color: red;
	    -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
	    -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
	    box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
	}

</style>
<div class="row-fluid">
	<div class="span4"> </div>
	<div class="span4 animated pulse" style="padding: 5%">
		<form action="" method="post" class="" id=email>
			<fieldset>
					<?php foreach ($this->formulario['email']->getFieldsets() as $fieldset): ?>
			     	  	<legend><?php echo  JText::_($fieldset->label);$fields = $this->formulario['email']->getFieldset($fieldset->name);?></legend>
			            <?php echo  str_replace("%nome%", $this->nome, Jtext::_("COM_CADASTROCLIENTE_LABEL_USUARIOFORM"));?><br><br>
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
			    	<input type="hidden" name="task" value='perfil.alterarSenha'><?php echo JText::_('COM_CADASTROCLIENTE_LABEL_MENSAGEM_TROCASENHAFORM'); ?>
		    		<div style="text-align:right; "><button type="submit" class="validate btn btn-primary"><?php echo JText::_('COM_CADASTROCLIENTE_LABEL_BTN_SALVAR')  ?></button></div>
			</fieldset>
		</form>
	</div>
	<div class="span4"> </div>
</div>

<script type="text/javascript">
var acesso = jQuery.noConflict();

	acesso.validator.addMethod("regx", function(value, element, regexpr) {          
    	return regexpr.test(value);
	}, "<?php echo Jtext::_('COM_CADASTROCLIENTE_LABEL_MENSAGEM_ERRO_SENHALETRAENUMERO'); ?>");

	acesso.validator.addMethod("forcasenha", function(value, element, regexpr) {          
    	senhainvalidas = ["01234567890", "abcdefghijklmnoprstuvxyzw", "11111111", "22222222", "33333333", "44444444", "55555555", "66666666", "77777777", "88888888", "00000000", "99999999","09876543210", "qwerty", "wzyxvutsrponmlkjihgfedcba"];
    	retorno = true;
    	acesso.each( senhainvalidas, function( i, val ) {
    		if( val.indexOf(value.replace(/[^\d]+/g,''))!= -1)
    			retorno = false;
    		if( val.indexOf(value)!= -1)
    			retorno = false;
		});
    		

    	return this.optional(element) || retorno;
	}, "<?php echo Jtext::_('COM_CADASTROCLIENTE_LABEL_MENSAGEM_ERRO_SENHAFRACA'); ?>");


	acesso("#email").validate({
       rules : {
            "email[senha]":{
                    required:true,
                    minlength:6,
                    maxlength:8,
                    forcasenha: true,
                    regx: /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{4,}$/
             },

             "email[confirmarsenha]": {
              		required:true,
                    minlength:6,
                    maxlength:8,
                    equalTo: "#email_senha"
             },                            
       },
       messages:{
       	    "email[senha]":{
                    required:"Campo Obrigatório",
                    minlength:"<?php echo Jtext::_('COM_CADASTROCLIENTE_LABEL_FORM_SENHATAMANHO'); ?>",
                    maxlength:"<?php echo Jtext::_('COM_CADASTROCLIENTE_LABEL_FORM_SENHATAMANHO'); ?>",

             },
            "email[confirmarsenha]":{
                    required:"Campo Obrigatório",
                    minlength:"<?php echo Jtext::_('COM_CADASTROCLIENTE_LABEL_FORM_SENHATAMANHO'); ?>",
                    maxlength:"<?php echo Jtext::_('COM_CADASTROCLIENTE_LABEL_FORM_SENHATAMANHO'); ?>",
                    equalTo: "<?php echo Jtext::_('COM_CADASTROCLIENTE_LABEL_MENSAGEM_ERRO_SENHADIFERENTES'); ?>",
                    regx:"<?php echo Jtext::_('COM_CADASTROCLIENTE_LABEL_MENSAGEM_ERRO_SENHALETRAENUMERO'); ?>"

             }
 
       }
	});


</script>




