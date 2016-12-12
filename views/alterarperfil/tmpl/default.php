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

	.form-input > fieldset > input {
		height: 30px

	}


</style>
<div class="row-fluid">
	<div class="span3"> </div>
	<div class="span6 animated pulse" style="padding: 5%">
	<?php
		if(strlen($this->SessaoUsuario->cpfCnpj)==11)
		{
			echo $this->loadTemplate('perfilpf');
		} 
		else	
		{
			echo $this->loadTemplate('perfilpj');
		}
	?>
	</div>
	<div class="span3"> </div>
</div>