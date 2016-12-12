<?php
defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.formvalidation');
$modalpopup = CadastroClienteHelperUtilitarios::pegarSessao("modalpopup");
CadastroClienteHelperUtilitarios::deletarSessao("modalpopup");
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

	.form-validate > fieldset > input {
		height: 30px

	}

	#_string_termo-lbl{
		margin-bottom: -26px;
		margin-left: 15px;
	}

</style>

<div class="row-fluid">
	<div class="span6 " style="padding: 5%">
		<?php echo $this->loadTemplate('jasoucadastrado'); ?>
	</div>
	<div class="span6" style="padding: 5%">
		<?php echo $this->loadTemplate('naotenhocadastro'); ?>
	</div>
</div>

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


	acesso.validator.addMethod("regx", function(value, element, regexpr) {          
    	return regexpr.test(value);
	}, "Entre com um valor válido.");


	acesso("#acessoprincipal").validate({
       rules : {
             "acessoprincipal[cpfCnpj]":{
                    required:true,
                    cpf: true,
                    cpfcadastrado: true
             },
             "acessoprincipal[senha]":{
                    required:true,
                    minlength:6,
             }                             
       },
       messages:{
             "acessoprincipal[cpfCnpj]":{
                    required:"Campo Obrigatório",
                    minlength:"Este campo dever ter pelo menos 11 caracteres",
             },
             "acessoprincipal[senha]":{
                    required:"Campo Obrigatório",
                    minlength:"Este campo dever ter pelo menos 6 caracteres",
             }
 
       }
	});



	acesso("#acessoinicial").validate({
       rules : {
             "acessoinicial[cpfCnpj]":{
                    required:true,
                    cpf: true,
                    cpfjacadastrado: true,
             },
             "acessoinicial[nome]":{
                    required:true,
                    regx: /^[a-zA-Zà-úÀ-Ú\s]+$/
             },
             "acessoinicial[dataNascimento]":{
                    required:true,
                    regx: /^(?=\d)(?:(?:31(?!.(?:0?[2469]|11))|(?:30|29)(?!.0?2)|29(?=.0?2.(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00)))(?:\x20|$))|(?:2[0-8]|1\d|0?[1-9]))([-.\/])(?:1[012]|0?[1-9])\1(?:1[6-9]|[2-9]\d)?\d\d(?:(?=\x20\d)\x20|$))?(((0?[1-9]|1[012])(:[0-5]\d){0,2}(\x20[AP]M))|([01]\d|2[0-3])(:[0-5]\d){1,2})?$/,
             },
             "acessoinicial[email]":{
                    required:true,
                    emaildominio:true,
                    email: true,
             }, 
             "acessoinicial[razaoSocial]":{
                    required:true,
             },
             "acessoinicial[inscricaoEstadual]":{
                    required:true,
             } ,    

            "acessoinicial[termo]": {
                required: true,
                maxlength: 2
            },
       },
       messages:{
       		 "acessoinicial[cpfCnpj]":{
                    required:"Campo Obrigatório",
                    minlength:"Este campo dever ter pelo menos 11 caracteres",
             },
       	 	"acessoinicial[nome]":{
                    required:"Campo Obrigatório",
                    regx: "Este campo somente aceita letras"
             },
             "acessoinicial[dataNascimento]":{
                    required:"Campo Obrigatório",
                    regx: "Data Inválida"
             },
             "acessoinicial[email]":{
                    required:"Campo Obrigatório",
                    email: "Email inválido",

             },
             "acessoinicial[razaoSocial]":{
                    required:"Campo Obrigatório",
             },
             "acessoinicial[inscricaoEstadual]":{
                    required:"Campo Obrigatório",
             },
             "acessoinicial[termo]": {
                required: "Campo Obrigatório",
                maxlength: "Termo de uso deve ser aceito."
            }
 
       }
	});

	acesso("#acessoredefinir").validate({
       rules : {
             "acessoredefinir[email]":{
                    required:true,
                    email: true,
                    emaildominio:true,
             },
              "acessoredefinir[cpfCnpj]":{
                    required:true,
                    cpf: true,
                    cpfcadastrado: true,
             },
       },
       messages:{
             "acessoredefinir[email]":{
                    required:"Campo Obrigatório",
                    email: "Email inválido"
             },
              "acessoredefinir[cpfCnpj]":{
                    required:"Campo Obrigatório",
                    minlength:"Este campo dever ter pelo menos 11 caracteres",
             },
       }
	});

acesso('#acessoinicial').on('submit', function(e) {
  if(grecaptcha.getResponse() == "") {
    e.preventDefault();
    acesso(".recaptcha-checkbox-border").focus();
    acesso('#captcharesposta').html('');
    acesso("#captcharesposta").show();
    acesso("#captcharesposta").append("Campo Obrigatório");
    return false;
  } else {
    return true;
  }
});


acesso(document).ready(function() {
		acesso("#acessoinicial_cpfCnpj-lbl").css("display", "none");
		acesso("#acessoinicial_nome-lbl").css("display", "block");
		acesso("#acessoinicial_nome").css("display", "block");
		acesso("#acessoinicial_dataNascimento-lbl").css("display", "block");
		acesso("#acessoinicial_dataNascimento").css("display", "block");
		acesso("#acessoinicial_razaoSocial-lbl").css("display", "none");
		acesso("#acessoinicial_razaoSocial").css("display", "none");
		acesso("#acessoinicial_inscricaoEstadual-lbl").css("display", "none");
		acesso("#acessoinicial_inscricaoEstadual").css("display", "none");
		acesso("#acessoinicial_nome").addClass("required");
		acesso("#acessoinicial_datanascimento").prop("required", true);
		acesso("#acessoinicial_razaoSocial").prop("required", null);
		acesso("#acessoinicial_datanascimento").addClass("required");
		acesso("#acessoinicial_razaoSocial").removeClass( "required" );
		acesso("#acessoinicial_inscricaoEstadual").removeClass( "required" );
		acesso("#acessoinicial_cpfCnpj").mask("999.999.999-99");
		acesso("#acessoinicial_dataNascimento").mask('00/00/0000');

	acesso("#optCPF").click(function (){
		acesso("#acessoinicial_nome-lbl").css("display", "block");
		acesso("#acessoinicial_nome").css("display", "block");
		acesso("#acessoinicial_dataNascimento-lbl").css("display", "block");
		acesso("#acessoinicial_dataNascimento").css("display", "block");
		acesso("#acessoinicial_razaoSocial-lbl").css("display", "none");
		acesso("#acessoinicial_razaoSocial").css("display", "none");
		acesso("#acessoinicial_inscricaoEstadual-lbl").css("display", "none");
		acesso("#acessoinicial_inscricaoEstadual").css("display", "none");
		acesso("#acessoinicial_nome").prop("required", true);
		acesso("#acessoinicial_dataNascimento").prop("required", true);
		acesso("#acessoinicial_razaoSocial").prop("required", null);
		acesso("#acessoinicial_inscricaoEstadual").prop("required", null);
		acesso("#acessoinicial_nome").addClass("required");
		acesso("#acessoinicial_datanascimento").addClass("required");
		acesso("#acessoinicial_razaoSocial").removeClass( "required" );
		acesso("#acessoinicial_inscricaoEstadual").removeClass( "required" );
		acesso('#acessoinicial_razaoSocial').val("");
		acesso('#acessoinicial_cpfCnpj').val("");
		acesso('#acessoinicial_inscricaoEstadual').val("");
		acesso("#acessoinicial_cpfCnpj").unmask();
		acesso("#acessoinicial_cpfCnpj").mask("999.999.999-99");
	});
    
    acesso("#optCNPJ").click(function (){
		acesso("#acessoinicial_nome").css("display", "none");
		acesso("#acessoinicial_dataNascimento").css("display", "none");
		acesso("#acessoinicial_razaoSocial").css("display", "block");
		acesso("#acessoinicial_inscricaoEstadual").css("display", "block");
		acesso("#acessoinicial_nome-lbl").css("display", "none");
		acesso("#acessoinicial_dataNascimento-lbl").css("display", "none");
		acesso("#acessoinicial_razaoSocial-lbl").css("display", "block");
		acesso("#acessoinicial_inscricaoEstadual-lbl").css("display", "block");
		acesso("#acessoinicial_nome").prop("required", null);
		acesso("#acessoinicial_dataNascimento").prop("required", null);
		acesso("#acessoinicial_razaoSocial").prop("required", true);
		acesso("#acessoinicial_inscricaoEstadual").prop("required", true);
		acesso("#acessoinicial_nome").removeClass("required");
		acesso("#acessoinicial_dataNascimento").removeClass("required");
		acesso("#acessoinicial_razaoSocial").addClass( "required" );
		acesso("#acessoinicial_inscricaoEstadual").addClass( "required" );
		acesso('#acessoinicial_nome').val("");
		acesso('#acessoinicial_dataNascimento').val("");
		acesso('#acessoinicial_cpfCnpj').val("");
		acesso("#acessoinicial_cpfCnpj").unmask();
		acesso("#acessoinicial_cpfCnpj").mask("99.999.999/9999-99");
	});

	acesso("#acessoprincipal_cpfCnpj").click(function(){
		acesso("#acessoprincipal_cpfCnpj").unmask();
        acesso("#acessoprincipal_cpfCnpj").mask("99999999999999");
	});

	acesso("#acessoprincipal_cpfCnpj").focus(function(){
		acesso("#acessoprincipal_cpfCnpj").unmask();
        acesso("#acessoprincipal_cpfCnpj").mask("99999999999999");
	});

	acesso("#acessoprincipal_cpfCnpj").blur(function(){
	    var tamanho = acesso("#acessoprincipal_cpfCnpj").val().length;
		if(tamanho < 11){
			acesso("#acessoprincipal_cpfCnpj").unmask();
	        acesso("#acessoprincipal_cpfCnpj").mask("99999999999999");
	    } 

	    if(tamanho == 11){
	    	acesso("#acessoprincipal_cpfCnpj").unmask();
	        acesso("#acessoprincipal_cpfCnpj").mask("999.999.999-99");
	    } 

	    if(tamanho > 11){
	    	acesso("#acessoprincipal_cpfCnpj").unmask();
	        acesso("#acessoprincipal_cpfCnpj").mask("99.999.999/9999-99");
	    }                   
	});

	acesso("#acessoredefinir_cpfCnpj").click(function(){
		acesso("#acessoredefinir_cpfCnpj").unmask();
        acesso("#acessoredefinir_cpfCnpj").mask("99999999999999");
	});

	acesso("#acessoredefinir_cpfCnpj").focus(function(){
		acesso("#acessoredefinir_cpfCnpj").unmask();
        acesso("#acessoredefinir_cpfCnpj").mask("99999999999999");
	});

	acesso("#acessoredefinir_cpfCnpj").blur(function(){
	    var tamanho = acesso("#acessoredefinir_cpfCnpj").val().length;
		if(tamanho < 11){
			acesso("#acessoredefinir_cpfCnpj").unmask();
	        acesso("#acessoredefinir_cpfCnpj").mask("99999999999999");
	    } 

	    if(tamanho == 11){
	    	acesso("#acessoredefinir_cpfCnpj").unmask();
	        acesso("#acessoredefinir_cpfCnpj").mask("999.999.999-99");
	    } 

	    if(tamanho > 11){
	    	acesso("#acessoredefinir_cpfCnpj").unmask();
	        acesso("#acessoredefinir_cpfCnpj").mask("99.999.999/9999-99");
	    }                   
	});
});

</script>