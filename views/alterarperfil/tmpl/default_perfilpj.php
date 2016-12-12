<?php
defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.formvalidation');
$this->formulario["perfilpj"]->setValue('cpfcnpj', null, $this->SessaoUsuario->cpfcnpj);
$this->formulario["perfilpj"]->setValue('nome', null, $this->SessaoUsuario->nome);
$this->formulario["perfilpj"]->setValue('inscricaoEstadual', null, $this->SessaoUsuario->inscricaoEstadual);
$this->formulario["perfilpj"]->setValue('email', null, $this->SessaoUsuario->email);
?>
<form action="" method="post" class="form-validate" id="perfilpj">
	<fieldset>
			<?php foreach ($this->formulario['perfilpj']->getFieldsets() as $fieldset): ?>
	     	  	<legend><?php echo  JText::_($fieldset->label);$fields = $this->formulario["perfilpj"]->getFieldset($fieldset->name);?></legend>
	            <?php foreach($fields as $field): ?>
	                <?php if ($field->hidden): ?>
	                    <?php echo $field->input;?>
	                <?php else:?>
	                    	<?php echo $field->label; ?>
							<?php echo $field->input;?>
							<span class="help-block" style="margin-bottom: 15px"></span>
	                <?php endif;?>
	            <?php endforeach;?>
	    	<?php endforeach;?>
	    	<?php echo JHtml::_( 'form.token' ); ?>
	    	<input type="hidden" name="task" value='perfil.alterarCadastro'>
    		<div style="text-align:right; "><button type="submit" class="validate btn btn-primary"><?php echo JText::_('COM_CADASTROCLIENTE_LABEL_BTN_SALVAR')  ?></button></div>
	</fieldset>
</form>
<script type="text/javascript">
var acesso = jQuery.noConflict();

	acesso.validator.addMethod("cpf", function(value, element) {
	    cpf = value.replace(/[^\d]+/g,'');
	    var tamanho = cpf.length;
		var retorno = true;
		if(tamanho = 11)
		{
				if(cpf == '') retorno = false;
				// Elimina CPFs invalidos conhecidos
				if (cpf.length != 11 || cpf == "00000000000" || cpf == "11111111111" || cpf == "22222222222" || cpf == "33333333333" || cpf == "44444444444" || cpf == "55555555555" || cpf == "66666666666" || cpf == "77777777777" || cpf == "88888888888" || cpf == "99999999999")
					retorno = false;
				// Valida 1o digito
				add = 0;
				for (i=0; i < 9; i ++)
					add += parseInt(cpf.charAt(i)) * (10 - i);
				rev = 11 - (add % 11);
				if (rev == 10 || rev == 11)
					rev = 0;
				if (rev != parseInt(cpf.charAt(9)))
					retorno = false;
				// Valida 2o digito
				add = 0;
				for (i = 0; i < 10; i ++)
					add += parseInt(cpf.charAt(i)) * (11 - i);
				rev = 11 - (add % 11);
				if (rev == 10 || rev == 11)
					rev = 0;
				if (rev != parseInt(cpf.charAt(10)))
					retorno = false;
		}
		else
		if(tamanho = 14)
		{
			if(cnpj == '') retorno = false;
			// Elimina CNPJs invalidos conhecidos
			if (cnpj.length != 14 || cnpj == "00000000000000" || cnpj == "11111111111111" || cnpj == "22222222222222" || cnpj == "33333333333333" || cnpj == "44444444444444" || cnpj == "55555555555555" || cnpj == "66666666666666" || cnpj == "77777777777777" || cnpj == "88888888888888" || cnpj == "99999999999999")
				retorno = false;
			// Valida DVs
			tamanho = cnpj.length - 2
			numeros = cnpj.substring(0,tamanho);
			digitos = cnpj.substring(tamanho);
			soma = 0;
			pos = tamanho - 7;
			for (i = tamanho; i >= 1; i--) {
			  soma += numeros.charAt(tamanho - i) * pos--;
			  if (pos < 2)
					pos = 9;
			}
			resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
			if (resultado != digitos.charAt(0))
				retorno = false;
			tamanho = tamanho + 1;
			numeros = cnpj.substring(0,tamanho);
			soma = 0;
			pos = tamanho - 7;
			for (i = tamanho; i >= 1; i--) {
			  soma += numeros.charAt(tamanho - i) * pos--;
			  if (pos < 2)
					pos = 9;
			}
			resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
			if (resultado != digitos.charAt(1))
				  retorno = false;
		}
		else{
			retorno = false
		}
	    return this.optional(element) || retorno;

	}, "Informe um CPF ou um CNPJ válido" );


	acesso.validator.addMethod("cpfcadastrado", function(value, element) {
	    cpfcnpj = value.replace(/[^\d]+/g,'');
		retorno = true;
		acesso.ajax({
            url: '<?php echo JRoute::_('index.php?option=com_cadastrocliente&view=acesso&task=servicos.consultarCPFCNPJ') ?>',
            dataType: "json",
            async : false,
            contentType: "application/json; charset=utf-8",
            type: "GET",
            data: { "cpfcnpj": cpfcnpj },
            success: function (data) {
            	console.log( "webservice2:", data );
        		retorno = data.success;
            },
            error: function (error) {
            	retorno = false;
            }
        });
        return this.optional(element) || retorno;

	}, "CPF/CNPJ não esta Cadastrado" );


	acesso.validator.addMethod("cpfjacadastrado", function(value, element) {
	    cpfcnpj = value.replace(/[^\d]+/g,'');
		retorno = true;
		acesso.ajax({
            url: '<?php echo JRoute::_('index.php?option=com_cadastrocliente&view=acesso&task=servicos.consultarCPFCNPJ') ?>',
            dataType: "json",
            async : false,
            contentType: "application/json; charset=utf-8",
            type: "GET",
            data: { "cpfcnpj": cpfcnpj },
            success: function (data) {
            	console.log( "webservice2:", data );
        		if (data.success == true) {
        			retorno = false;
        		} else {
        			retorno = true;
        		}
            },
            error: function (error) {
            	retorno = false;
            }
        });
        return this.optional(element) || retorno;

	}, "CPF/CNPJ já Cadastrado" );


	acesso.validator.addMethod("regx", function(value, element, regexpr) {          
    	return regexpr.test(value);
	}, "Entre com um valor válido.");

	acesso.validator.addMethod("emaildominio", function(value, element) {
	    email = value;
		retorno = true;
		acesso.ajax({
            url: '<?php echo JRoute::_('index.php?option=com_cadastrocliente&view=acesso&task=servicos.validarEmail') ?>',
            dataType: "json",
            async : false,
            contentType: "application/json; charset=utf-8",
            type: "GET",
            data: { "email": email },
            success: function (data) {
            	console.log( "webservice2:", data );
            	console.log( "webservice3:", data );
        		if (data.success == true) {
        			retorno = true;
        		} else {
        			retorno = false;
        		}
            },
            error: function (error) {
            	retorno = false;
            }
        });
        return this.optional(element) || retorno;

	}, "Email Invalido" );

	acesso("#perfilpj").validate({
       rules : {
             "perfilpj[nome]":{
                    required:true,
                    regx: /^[a-zA-Zà-úÀ-Ú]+$/
             },
             "perfilpj[email]":{
                    required:true,
                    email: true,
                    emaildominio:true,
             }, 

            "perfilpj[inscricaoEstadual]":{
                    required:true,
                    number:true,
                    max: 20,
                    mim: 3,
             }, 

             
       },
       messages:{
       		
       	 	"perfilpj[nome]":{
                    required:"Campo Obrigatório",
                    regx: "Este campo somente aceita letras"
             },
             "perfilpj[inscricaoEstadual]":{
                    required:"Campo Obrigatório",
                    regx: "Data Inválida",
                    number: "Este campo aceita somente caracteres numérico",
                    max: "Maxímo",
                    mim: 3
             },
             "perfilpj[email]":{
                    required:"Campo Obrigatório",
                    email: "Email inválido",

             },
       }
	});
	
	acesso(document).ready(function() {
		acesso("#perfilpj_datanascimento").mask('00/00/0000');
	});

</script>

